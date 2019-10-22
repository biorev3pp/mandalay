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
        $(document).find('.tabDivSection').each(function(i,obj){
            if($(obj).attr('id')===tab){
                $(obj).removeClass('disp_none');
            }else{
                $(obj).addClass('disp_none');
            }
        });
        let homeid = localStorage.getItem('home_id');
        $(document).find('.home_image_full').each(function(i,obj){
            if($(obj).attr('id')===homeid){
                $(obj).removeClass('disp_none');
            }else{
                $(obj).addClass('disp_none');
            }
        });
        $(document).find('.floor_image_view').addClass('disp_none');
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

                $(container).find('.manageToggle').each(function($e) {
                    let currentEle = $(this);
                    let dependency = $(this).attr('data-dependency');
                    let togetherness = $(this).attr('data-togetherness');
                    

                    if(dependency) {
                        dependency =  JSON.parse(dependency);

                        for (var i = 0; i < dependency.length; i++) {
                            let value= dependency[i];
                            $('.dependency_'+value).prop('disabled',true);
                            $('.dependency_'+value).next('i').addClass('disabled');
                        }
                    }
                    if(togetherness) {
                        togetherness =  JSON.parse(togetherness);

                        for (var i = 0; i < togetherness.length; i++) {
                            let value= togetherness[i];
                            $('.togetherness_'+value).prop('disabled',true);
                        }
                    }
                })
            }
        });
    });

    $(document).on('click','.featureBtn', function(e){
        
        let featureId = $(this).attr('id');
        if($(this).is(':checked')){
            let featureInput = '<input name="feature_id[]" type="hidden" value="'+featureId+'">';
            $("input[name='home_id']").after(featureInput);
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
                let featureImage = '<img src="'+response.image+'" id="'+featureId+'" class="img-fluid feature-img">'
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

    $(document).on('change','.manageToggle',function(event) {
        let postData = [];
        let currentValue = $(this).find('input').attr('id');
        let curretContainer = $(this).parents('ul');
        let conficts = ($(this).attr('data-conflicts').trim() != "") ? JSON.parse($(this).attr('data-conflicts')) : [];
        let dependency = ($(this).attr('data-dependency').trim() != "") ? JSON.parse($(this).attr('data-dependency')) : [];
        let togetherness = ($(this).attr('data-togetherness').trim() != "" ) ? JSON.parse($(this).attr('data-togetherness')) : [];
        let checked = $(this).find('input').is(':checked');
        let dependencyFlag = false;
        let togethernessFlag = false;
        let container = $(this).parents('ul');
        $(document).find('.floor_image_view img').each(function(i,obj){
            if($(obj).attr('id')){
                $(obj).remove();
            }
        });
        if(conficts.length == 0) 
        {
            // we need to match data-conficts attribute
            document.querySelectorAll('label[data-conflicts]').forEach(function (conflicts, index) { 
            if(conflicts.getAttribute('data-conflicts')) { 
            
            let conflictsProp = (conflicts.getAttribute('data-conflicts').trim() != "") ? JSON.parse(conflicts.getAttribute('data-conflicts')) : [];
            let dependencyProp = (conflicts.getAttribute('data-dependency').trim() != "") ? JSON.parse(conflicts.getAttribute('data-dependency')) : [];
            let togethernessProp = (conflicts.getAttribute('data-togetherness').trim() != "" ) ? JSON.parse(conflicts.getAttribute('data-togetherness')) : [];

            const currentEle = conflicts.getAttribute('data-self');
            if(conflictsProp.indexOf(currentValue) > -1 ) {
                if(checked) {
                    setupForTogetherness(togethernessProp,false);
                    postData.push(currentValue);
                    $('.self_'+currentEle).prop('checked',false);
                }
                // else {
                //     let data = setupForTogetherness(togethernessProp,true);
                //     $('.self_'+currentEle).prop('checked',true);
                //     postData.push(data);
                //     postData.push(currentEle);
                    
                // }
              }
              else if (dependencyProp.indexOf(currentValue) > -1 ) {
                if(checked) { 
                    postData.push(currentValue);
                }
                // set values for selected options
                $(container).find('.manageToggle').each(function($e) {
                    const id = $(this).find('input:checked').attr('id');
                    if(id){
                        postData.push(id);
                    }
                });
              }
              else {
                if(checked) { 
                    postData.push(currentValue);
                }
                $(container).find('.manageToggle').each(function($e) {
                    const id = $(this).find('input:checked').attr('id');
                    if(id){
                        postData.push(id);
                    }
                });
              }


            }
            });
        }
        else
        {
            if(checked) {
                postData.push(currentValue);
                for (var i = 0; i < conficts.length; i++) {
                    let values= conficts[i];
                    $('.conflicts_'+values).prop('checked',false);
                }
                dependencyFlag = true;
                togethernessFlag = true;

            }else {
                
                $(curretContainer).find('.manageToggle').each(function($e) {
                    let currentEle = $(this);
                console.log(currentEle)

                    let dependency = $(this).attr('data-dependency');
                    let togetherness = $(this).attr('data-togetherness');
                    if(dependency) {
                        dependency =  JSON.parse(dependency);
                        for (var i = 0; i < dependency.length; i++) {
                            let value= dependency[i];
                            $('.dependency_'+value).prop('disabled',true);
                            $('.dependency_'+value).next('i').addClass('disabled');
                        }
                    }
                    if(togetherness) {
                        togetherness =  JSON.parse(togetherness);

                        for (var i = 0; i < togetherness.length; i++) {
                            let value= togetherness[i];
                            $('.togetherness_'+value).prop('disabled',true);
                        }
                    }
                });
            }
        }

        if(dependencyFlag) {
            for (var i = 0; i < dependency.length; i++) {
                let value= dependency[i];
                $('.dependency_'+value).prop('disabled',false);
                $('.dependency_'+value).next('i').removeClass('disabled');
            }    
        }
        
        for (var i = 0; i < togetherness.length; i++) {
            let togethernessValue= togetherness[i];
            $('.togetherness_'+togethernessValue).prop('disabled',false);
            $('.togetherness_'+togethernessValue).prop('checked',togethernessFlag);
            $('.togetherness_'+togethernessValue).prop('disabled',true);
            
            if(togethernessFlag){
                postData.push(togethernessValue);
                $('.togetherness_'+togethernessValue).next('i').removeClass('disabled');
            }
        }    
        
        if(postData.length) {
            
            postData = unique(postData);
            $.ajax({
            url         : app_base_url+'/get-feature-data',
            type        : "post",
            data        : {'featureid':postData},
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
                $.each(response, function( index, value )
                {
                   let featureImage = '<img src="'+value.image+'" id="'+value.id+'" class="img-fluid feature-img">'
                    $(document).find('.floor_image_view').append(featureImage);
                });
               
            }
        });
        }
        
        
    })
    
    function setupForTogetherness(togetherness,flag) {
        var postData = [];
        for (var i = 0; i < togetherness.length; i++) {
            let togethernessValue= togetherness[i];
            $('.togetherness_'+togethernessValue).prop('disabled',false);
            $('.togetherness_'+togethernessValue).prop('checked',flag);
            $('.togetherness_'+togethernessValue).prop('disabled',true);
            postData.push(togethernessValue);
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
    // function setupForTogetherness(togetherness,flag) {
    //     for (var i = 0; i < togetherness.length; i++) {
    //         let togethernessValue= togetherness[i];
    //         $('.togetherness_'+togethernessValue).prop('checked',flag);
    //         $('.togetherness_'+togethernessValue).prop('disabled',flag);
    //         postData.push(togethernessValue);
    //     }
    // }
});
