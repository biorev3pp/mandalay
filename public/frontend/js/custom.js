$(document).ready(function (){
    //set local storage default values
    localStorage.setItem('home_id',1);
    localStorage.setItem('floor_id',1);
    localStorage.setItem('feature_id',1);

    $(document).on('click','.home_list', function(e){
        let homeid = $(this).attr('id');
        $("input[name='home_id']").val(homeid);
        localStorage.setItem('home_id',homeid);
        let homeEnId = $(this).attr('data-home-id');
        $(document).find('.floor_image_view').addClass('disp_none');
        // Show Full Home Image
        $(document).find('.home_image_full').each(function(i,obj){
            if($(obj).attr('id')===homeid){
                $(obj).removeClass('disp_none');
            }else{
                $(obj).addClass('disp_none');
            }
        });
        $(document).find('.home_image_title').each(function(i,obj){
            if($(obj).attr('id')===homeid){
                $(obj).removeClass('disp_none');
            }else{
                $(obj).addClass('disp_none');
            }
        });
        $(document).find('.home_image_footer').each(function(i,obj){
            if($(obj).attr('id')===homeid){
                $(obj).removeClass('disp_none');
            }else{
                $(obj).addClass('disp_none');
            }
        });
        //Set Floors of current home
        $(document).find('.home_floors').each(function(i,obj){
            if($(obj).attr('data-floor-home-id')===homeid){
                $(obj).removeClass('disp_none');
            }else{
                $(obj).addClass('disp_none');
            }
        });
    });

    $(document).on('click','.tabDiv', function(e){
        let tab = $(this).attr('id');
        // To show div content of current tab
        $(document).find('.tabDivSection').each(function(i,obj){
            if($(obj).attr('id')===tab){
                $(obj).removeClass('disp_none');
            }else{
                $(obj).addClass('disp_none');
            }
        });
        if(tab=='floor'){
            $('.floorList:first').click();
        }else{
            $(document).find('.floor_image_view').addClass('disp_none');
            let homeid = localStorage.getItem('home_id');
            $(document).find('.home_image_full').each(function(i,obj){
                if($(obj).attr('id')===homeid){
                    $(obj).removeClass('disp_none');
                }else{
                    $(obj).addClass('disp_none');
                }
            });
        }


        // $(document).find('.floor_image_view').addClass('disp_none');
    });

    // $(document).on('click','.hometab', function(e){
    //     let homeid = localStorage.getItem('home_id');
    //     $(document).find('.home_image_full').each(function(i,obj){
    //         if($(obj).attr('id')===homeid){
    //             $(obj).removeClass('disp_none');
    //         }else{
    //             $(obj).addClass('disp_none');
    //         }
    //     });
    //     $(document).find('.floor_image_view').addClass('disp_none');
    // });
    // function checkDependency(){
    //     $(document).find('.manageToggle').each(function($e) {
    //         let currentEle = $(this);
    //         let dependency = $(this).attr('data-dependency');
    //         let togetherness = $(this).attr('data-togetherness');
    //         if(dependency) {
    //             dependency =  JSON.parse(dependency);

    //             for (var i = 0; i < dependency.length; i++) {
    //                 let value= dependency[i];
    //                 $('.dependency_'+value).prop('disabled',true);
    //                 $('.dependency_'+value).next('i').addClass('disabled');
    //                 $('.dependency_'+value).parents('li').hide();
    //             }
    //         }
    //         // if(togetherness) {
    //         //     togetherness =  JSON.parse(togetherness);
    //         //     for (var i = 0; i < togetherness.length; i++) {
    //         //         let value= togetherness[i];
    //         //         $('.togetherness_'+value).prop('disabled',true);
    //         //     }
    //         // }
    //     });
    // }

    // function to set depandent and together toggle off on load
    function checkDependencyToggle(){
        $(document).find('.manageToggle').each(function(){
            let dependency = ($(this).attr('data-dependency').trim() != "") ? JSON.parse($(this).attr('data-dependency')) : [];
            for (var i = 0; i < dependency.length; i++) {
                let value = dependency[i];
                $('.dependency_'+value).prop('disabled',true).next('i').addClass('disabled');
                $('.dependency_'+value).parents('li').hide();
            }
            let togetherness = ($(this).attr('data-togetherness').trim() != "") ? JSON.parse($(this).attr('data-togetherness')) : [];
            for (var i = 0; i < togetherness.length; i++) {
                let value = togetherness[i];
                $('.togetherness_'+value).parents('li').hide();
            }
        });
    }

    $(document).on('click','.floorList', function(e){
        let floorid = $(this).attr('id');
        localStorage.setItem('floor_id',floorid);
        let homeid = localStorage.getItem('home_id');
        $(document).find('.featureBtn').each(function(i,obj){
            if($(obj).is(':checked')){
                $(obj).trigger("click");
            }
        });
        let container = $('div[data-floor-home-id="'+floorid+'"]');
        $.ajax({
            url         : app_base_url+'/get-floor-data',
            type        : "post",
            data        : {'homeid':homeid,'floorid':floorid},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend  : function () {
                $("#preloader").show();
            },
            complete: function () {
                $("#preloader").hide();
            },
            success: function (response) {
                $(document).find('.home_image_full ').addClass('disp_none');
                $(document).find('.floor_image_view').removeClass('disp_none');
                $(document).find('.floor_image_view img').attr('src',response.image);
                checkDependencyToggle();
            }
        });
    });

    //get checked features and go to final page
    $(document).on('click','.finishBtn', function(e){
        let selectedfeatures = [];
        $(document).find('.featureBtn:checkbox:checked').each(function(i,obj){
            // let floorid = $(obj).attr('data-check-floor-id');
            let featureid = $(obj).attr('id');
            // selectedfeatures.push(featureid);
            let featureInput = '<input name="feature_id[]" type="hidden" value="'+featureid+'">';
            $("input[name='home_id']").after(featureInput);
        });
        $(document).find('#finishPage_form').submit();
    });

    $(document).on('click','.downloadPDFBtn', function(e){
        $(document).find('#pdf_form').submit();
    });


    $(document).on('click','.featureBtn', function(e){
        let featureId = $(this).attr('id');
        if($(this).is(':checked')){
            $.ajax({
                url         : app_base_url+'/get-feature-data',
                type        : "post",
                data        : {'featureid':featureId},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend  : function () {
                    $("#preloader").show();
                },
                complete: function () {
                    $("#preloader").hide();
                },
                success: function (response) {
                    let featureImage = '<div class="position-relative"><img src="'+response.image+'" id="'+featureId+'" class="img-fluid position-absolute"></div>'
                    $(document).find('.floor_image_view').append(featureImage);
                }
            });
        }else{
            $(document).find("input[name='feature_id[]']").each(function(i,obj){
                if($(obj).val()==featureId){
                    $(obj).remove();
                }
            });
            $(document).find('.floor_image_view img').each(function(i,obj){
                if($(obj).attr('id')===featureId){
                    $(obj).remove();
                }
            });
        }
    });

    function hideConflicts(toggleId){
        let currentElement = $(document).find('input#'+toggleId).parent('label');
        let conficts = (currentElement.attr('data-conflicts').trim() != "") ? JSON.parse(currentElement.attr('data-conflicts')) : [];
        for (var i = 0; i < conficts.length; i++) {
            let values = conficts[i];
            // Turn conflicts off
            $('.conflicts_'+values).prop('checked',false).parents('li').hide();
            // Turn related togetherness off
            hideTogetherness(values);
            // Turn related dependent off
            // hideDependency(values);
        }
    }
    function showConflicts(toggleId){
        let currentElement = $(document).find('input#'+toggleId).parent('label');
        let conficts = (currentElement.attr('data-conflicts').trim() != "") ? JSON.parse(currentElement.attr('data-conflicts')) : [];
        for (var i = 0; i < conficts.length; i++) {
            let values = conficts[i];
            // Turn conflicts off and show
            $('.conflicts_'+values).prop('checked',false).parents('li').show();
            hideTogetherness(values);
            hideDependency(values);

            // Show related togetherness off
            // let conflictElement = $('.conflicts_'+values).parent('label');
            // let conflictTogetherness = (conflictElement.attr('data-togetherness').trim() != "" ) ? JSON.parse(conflictElement.attr('data-togetherness')) : [];
            // if(conflictTogetherness.length > 0){
            //     for (var i = 0; i < conflictTogetherness.length; i++) {
            //         let togetherId = conflictTogetherness[i];
            //         $('.togetherness_'+togetherId).parents('li').show();
            //     }
            // }
            // Turn conflict related dependent visible
            // let conflictDependent = (conflictElement.attr('data-dependency').trim() != "" ) ? JSON.parse(conflictElement.attr('data-dependency')) : [];
            // if(conflictDependent.length > 0){
            //     for (var i = 0; i < conflictDependent.length; i++) {
            //         let dependentId = conflictDependent[i];
            //         $('.dependency_'+dependentId).parents('li').show();
            //     }
            // }
        }
    }

    function showTogetherness(toggleId){
        let currentElement = $(document).find('input#'+toggleId).parent('label');
        let togetherness = (currentElement.attr('data-togetherness').trim() != "" ) ? JSON.parse(currentElement.attr('data-togetherness')) : [];
        for (var i = 0; i < togetherness.length; i++) {
            let values = togetherness[i];
            $('.togetherness_'+values).parents('li').show();
            $('.togetherness_'+values).prop('checked',true);
            //Manage Conflicts
            hideConflicts(values);
            //Manage Dependency
            showDependency(values);
        }   
    }
    function hideTogetherness(toggleId){
        let currentElement = $(document).find('input#'+toggleId).parent('label');
        let togetherness = (currentElement.attr('data-togetherness').trim() != "" ) ? JSON.parse(currentElement.attr('data-togetherness')) : [];
        for (var i = 0; i < togetherness.length; i++) {
            let values = togetherness[i];
            $('.togetherness_'+values).prop('checked',false);
            $('.togetherness_'+values).parents('li').hide();
            //Manage Conflicts
            showConflicts(values);
            //Manage Dependency
            hideDependency(values);
        }   
    }
    function showDependency(toggleId){
        let currentElement = $(document).find('input#'+toggleId).parent('label');
        let dependency = (currentElement.attr('data-dependency').trim() != "") ? JSON.parse(currentElement.attr('data-dependency')) : [];
        if(dependency.length > 0){
            for (var i = 0; i < dependency.length; i++) {
                let value = dependency[i];
                $('.dependency_'+value).parents('li').show();
                $('.dependency_'+value).prop('disabled',false).next('i').removeClass('disabled');
            }
        }
    }

    function hideDependency(toggleId){
        let currentElement = $(document).find('input#'+toggleId).parent('label');
        let dependency = (currentElement.attr('data-dependency').trim() != "") ? JSON.parse(currentElement.attr('data-dependency')) : [];
        if(dependency.length > 0){
            for (var i = 0; i < dependency.length; i++) {
                let value = dependency[i];
                $('.dependency_'+value).prop('checked',false).prop('disabled',true).next('i').addClass('disabled');
                $('.dependency_'+value).parents('li').hide();
            }
        }
    }

    function checkFinalAclSettings(){
        checkDependencyToggle();
        var onOptions = [];
        $(document).find('.manageToggle').each(function(){
            let checked = $(this).find('input').is(':checked');
            if(checked){
                let toggleId = $(this).attr('data-self');
                onOptions.push(toggleId);
            }
        });
        if(onOptions.length > 0){
            for(var i = 0; i < onOptions.length; i++){
                let toggleId = onOptions[i];
                showDependency(toggleId);
            }
        }
        if(onOptions.length > 0){
            for(var i = 0; i < onOptions.length; i++){
                let toggleId = onOptions[i];
                showTogetherness(toggleId);
            }
        }
        if(onOptions.length > 0){
            for(var i = 0; i < onOptions.length; i++){
                let toggleId = onOptions[i];
                hideConflicts(toggleId);
            }
        }
    }

    // set acl toggles when a toggle is clicked
    $(document).on('change','.manageToggle',function(event) {
        //Ranjan's Code
        let toggleId = $(this).attr('data-self');
        let checked = $(this).find('input').is(':checked');
        // When toggle gets on
        if(checked){
            hideConflicts(toggleId);
            showTogetherness(toggleId);
            showDependency(toggleId);
            checkFinalAclSettings();
        }else{
            // Manage Conflicts
            showConflicts(toggleId);
            hideTogetherness(toggleId);
            hideDependency(toggleId);
            checkFinalAclSettings();
        }

        // Get all on toggles
        var checkedOptions = [];
        $(document).find('.manageToggle').each(function(){
            let checkTrue = $(this).find('input').is(':checked');
            if(checkTrue){
                let toggleId = $(this).find('input').attr('id');
                checkedOptions.push(toggleId);
            }
        });
        // Load featues image
        $.ajax({
            url         : app_base_url+'/get-feature-data',
            type        : "post",
            data        : {'featureid':checkedOptions},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend  : function () {
                $("#preloader").show();
            },
            complete: function () {
                $("#preloader").hide();
            },
            success: function (response) {
                $(document).find('.ftImage').remove();
                if(response.length > 0){
                    $.each(response, function( index, value ){
                       let featureImage = '<div class="position-relative ftImage"><img src="'+value.image+'" id="'+value.id+'" class="img-fluid position-absolute"></div>'
                        $(document).find('.floor_image_view').append(featureImage);
                    });
                }
                // let featureImage = '<div class="position-relative"><img src="'+response.image+'" id="'+featureId+'" class="img-fluid position-absolute"></div>'
                // $(document).find('.floor_image_view').append(featureImage);
            }
        });






        // let postData = [];
        // let currentValue = $(this).find('input').attr('id');
        // let curretContainer = $(this).parents('ul');
        // let conficts = ($(this).attr('data-conflicts').trim() != "") ? JSON.parse($(this).attr('data-conflicts')) : [];
        // let dependency = ($(this).attr('data-dependency').trim() != "") ? JSON.parse($(this).attr('data-dependency')) : [];
        // let togetherness = ($(this).attr('data-togetherness').trim() != "" ) ? JSON.parse($(this).attr('data-togetherness')) : [];
        // let checked = $(this).find('input').is(':checked');
        // let dependencyFlag = false;
        // let togethernessFlag = false;
        // let container = $(this).parents('ul');
        // var byPassDependacy = false;
        // // if(!checked) {
        // $(document).find('.floor_image_view img').each(function(i,obj){
        //     if($(obj).attr('id') != undefined){
        //         $(obj).remove();
        //     }
        // });
        // // }
        // // Check Conflicts
        // if(conficts.length == 0)
        // {
        //     // we need to match data-conficts attribute
        //     document.querySelectorAll('label[data-conflicts]').forEach(function (conflicts, index) {
        //       console.log("e");

        //             let conflictsProp = (conflicts.getAttribute('data-conflicts').trim() != "") ? JSON.parse(conflicts.getAttribute('data-conflicts')) : [];
        //             let dependencyProp = (conflicts.getAttribute('data-dependency').trim() != "") ? JSON.parse(conflicts.getAttribute('data-dependency')) : [];
        //             let togethernessProp = (conflicts.getAttribute('data-togetherness').trim() != "" ) ? JSON.parse(conflicts.getAttribute('data-togetherness')) : [];
        //             // console.log(conflictsProp)
        //             console.log(dependencyProp)
        //             // console.log(togethernessProp)
        //             const currentEle = conflicts.getAttribute('data-self');
        //             if(conflictsProp.indexOf(currentValue) > -1 ) {

        //                 if(checked) {
        //                     // setupForTogetherness(togethernessProp,false);
        //                     // setupForDependency(dependencyProp,false);

        //                     postData.push(currentValue);
        //                     $('.self_'+currentEle).prop('checked',false);
        //                     $('.self_'+currentEle).parents('li').hide();

        //                 }else{
        //                     $('.self_'+currentEle).parents('li').show();
        //                 }
        //                 // else {
        //                 //     let data = setupForTogetherness(togethernessProp,true);
        //                 //     $('.self_'+currentEle).prop('checked',true);
        //                 //     postData.push(data);
        //                 //     postData.push(currentEle);

        //                 // }

        //             }else if (dependencyProp.indexOf(currentValue) > -1 ) {
        //                 if(checked) {
        //                     postData.push(currentValue);
        //                 }
        //                 console.log(conflicts.getElementsByTagName('input'));
        //                 byPassDependacy = conflicts.getElementsByTagName('input')[0].checked;

        //                 // set values for selected options

        //             }else {
        //                 console.log("error")
        //                 if(checked) {
        //                     postData.push(currentValue);
        //                 }

        //             }

        //     });
        // }

        // if(checked) {
        //     postData.push(currentValue);
        //     for (var i = 0; i < conficts.length; i++) {
        //         let values= conficts[i];
        //         $('.conflicts_'+values).prop('checked',false);
        //         $('.conflicts_'+values).parents('li').hide();
        //     }
        //     dependencyFlag = true;
        //     togethernessFlag = true;
        // }else {
        //     for (var i = 0; i < conficts.length; i++) {
        //         let values= conficts[i];
        //         $('.conflicts_'+values).parents('li').show();
        //     }
        //     $(curretContainer).find('.manageToggle').each(function($e) {
        //         let currentEle = $(this);
        //         let dependency = $(this).attr('data-dependency');
        //         let togetherness = $(this).attr('data-togetherness');
        //         if(dependency) {
        //             dependency =  JSON.parse(dependency);
        //             for (var i = 0; i < dependency.length; i++) {
        //                 let value= dependency[i];
        //                 if(!byPassDependacy){
        //                   $('.dependency_'+value).prop('disabled',true);
        //                   $('.dependency_'+value).next('i').addClass('disabled');
        //                   $('.dependency_'+value).parents('li').hide();
        //                 }else{
        //                   $('.dependency_'+value).prop('disabled',false);
        //                   $('.dependency_'+value).next('i').removeClass('disabled');
        //                   $('.dependency_'+value).parents('li').show();
        //                 }
        //             }
        //         }
        //         // if(togetherness) {
        //         //     togetherness =  JSON.parse(togetherness);
        //         //     for (var i = 0; i < togetherness.length; i++) {
        //         //         let value= togetherness[i];
        //         //         $('.togetherness_'+value).prop('disabled',true);
        //         //     }
        //         // }
        //     });
        // }
        // if(dependencyFlag) {
        //     for (var i = 0; i < dependency.length; i++) {
        //         let value= dependency[i];
        //         $('.dependency_'+value).prop('disabled',false);
        //         $('.dependency_'+value).next('i').removeClass('disabled');
        //         $('.dependency_'+value).parents('li').show();
        //     }
        // }else{
        //   for (var i = 0; i < dependency.length; i++) {
        //       let value= dependency[i];
        //       if(!byPassDependacy){
        //         $('.dependency_'+value).prop('checked',false);
        //         $('.dependency_'+value).prop('disabled',true);
        //         $('.dependency_'+value).next('i').addClass('disabled');
        //         $('.dependency_'+value).parents('li').hide();
        //       }else{
        //         $('.dependency_'+value).prop('disabled',false);
        //         $('.dependency_'+value).prop('checked',false);
        //         $('.dependency_'+value).next('i').removeClass('disabled');
        //         $('.dependency_'+value).parents('li').show();
        //       }
        //   }
        // }
        // for (var i = 0; i < togetherness.length; i++) {
        //     let togethernessValue= togetherness[i];
        //     $('.togetherness_'+togethernessValue).prop('disabled',false);
        //     $('.togetherness_'+togethernessValue).prop('checked',togethernessFlag);
        //     $('.togetherness_'+togethernessValue).prop('disabled',true);
        //     if(togethernessFlag){
        //         postData.push(togethernessValue);
        //         $('.togetherness_'+togethernessValue).next('i').removeClass('disabled');
        //     }
        // }
        // // in case any dependncy is on need to show image
        //  $(container).find('.manageToggle').each(function($e) {
        //   const id = $(this).find('input:checked').attr('id');
        //       if(id){
        //           postData.push(id);
        //       }
        //   });
        // if(postData.length) {

        //     postData = unique(postData);

        //     console.log(postData);
        //     $.ajax({
        //     url         : app_base_url+'/get-feature-data',
        //     type        : "post",
        //     data        : {'featureid':postData},
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     },
        //     beforeSend  : function () {
        //         $("#preloader").show();
        //     },
        //     complete: function () {
        //         $("#preloader").hide();
        //     },
        //     success: function (response) {
        //         $.each(response, function( index, value )
        //         {
        //            let featureImage = '<div class="position-relative"><img src="'+value.image+'" id="'+value.id+'" class="img-fluid position-absolute"></div>'
        //             $(document).find('.floor_image_view').append(featureImage);
        //         });

        //     }
        // });
        // }


    })

    function setupForTogetherness(togetherness,flag) {

        var postData = [];
        if(togetherness.length) {
               togetherness.map(function(item){
                let togethernessValue= item;
                $('.dependency_'+togethernessValue).prop('disabled',false);
                $('.dependency_'+togethernessValue).prop('checked',flag);
                $('.dependency_'+togethernessValue).prop('disabled',true).next('i').addClass("disabled");
                postData.push(togethernessValue);
            })
        }
        return postData;
    }

    function setupForDependency(dependencyProp,flag) {
        var postData = [];
        if(dependencyProp.length) {
               dependencyProp.map(function(item){
                let dependencyPropValue= item;
                $('.dependency_'+dependencyPropValue).prop('disabled',false);
                $('.dependency_'+dependencyPropValue).prop('checked',flag);
                $('.dependency_'+dependencyPropValue).prop('disabled',true).next('i').addClass("disabled");
                postData.push(dependencyPropValue);
            })
        }
        return postData;
    }
    function unique(list) {
        var result = [];
        $.each(list, function(i, e) {
            if ($.inArray(e, result) == -1) result.push(e);
        });
        return result;
    }


function dragElement(elmnt) {
  var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
  if (document.getElementById(elmnt.id)) {
    /* if present, the header is where you move the DIV from:*/
    document.getElementById(elmnt.id).onmousedown = dragMouseDown;
  } else {
    /* otherwise, move the DIV from anywhere inside the DIV:*/
    elmnt.onmousedown = dragMouseDown;
  }

  function dragMouseDown(e) {
    e = e || window.event;
    e.preventDefault();
    // get the mouse cursor position at startup:
    pos3 = e.clientX;
    pos4 = e.clientY;
    document.onmouseup = closeDragElement;
    // call a function whenever the cursor moves:
    document.onmousemove = elementDrag;
  }

  function elementDrag(e) {
    e = e || window.event;
    e.preventDefault();
    // calculate the new cursor position:
    pos1 = pos3 - e.clientX;
    pos2 = pos4 - e.clientY;
    pos3 = e.clientX;
    pos4 = e.clientY;
    // set the element's new position:
    elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
    elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
  }

  function closeDragElement() {
    /* stop moving when mouse button is released:*/
    document.onmouseup = null;
    document.onmousemove = null;
  }
}

dragElement(document.getElementById("image-graggble"));

    // function setupForTogetherness(togetherness,flag) {
    //     for (var i = 0; i < togetherness.length; i++) {
    //         let togethernessValue= togetherness[i];
    //         $('.togetherness_'+togethernessValue).prop('checked',flag);
    //         $('.togetherness_'+togethernessValue).prop('disabled',flag);
    //         postData.push(togethernessValue);
    //     }
    // }
});
