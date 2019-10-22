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
            }
        });
    });

    $(document).on('click','.featureBtn', function(e){
        return;
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
        let conficts = ($(this).attr('data-conflicts').trim() != "") ? JSON.parse($(this).attr('data-conflicts')) : [];
        let dependency = ($(this).attr('data-dependency').trim() != "") ? JSON.parse($(this).attr('data-dependency')) : [];
        let togetherness = ($(this).attr('data-togetherness').trim() != "" ) ? JSON.parse($(this).attr('data-togetherness')) : [];
        let checked = $(this).find('input').is(':checked');
        let dependencyFlag = false;
        let togethernessFlag = false;
        if(checked) {
            postData.push($(this).find('input').attr('id'));
            for (var i = 0; i < conficts.length; i++) {
                let values= conficts[i];
                $('.conflicts_'+values).prop('checked',false);
                console.log(values)
            }
            dependencyFlag = true;
            togethernessFlag = true;

        }
        console.log(dependencyFlag)
        console.log(togethernessFlag)

        for (var i = 0; i < togetherness.length; i++) {
            let togethernessValue= togetherness[i];
            $('.togetherness_'+togethernessValue).prop('checked',togethernessFlag);
            $('.togetherness_'+togethernessValue).prop('disabled',togethernessFlag);
            postData.push(togethernessValue);
        }

        if(togethernessFlag) {
            console.log(postData);
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
        }else {
            $(document).find('.floor_image_view img').each(function(i,obj){
                console.log($(obj).attr('id'));
                if($(obj).attr('id')){
                    $(obj).remove();
                }
            });
        }
        
        // for (var i = 0; i < dependency.length; i++) {
        //     let dependencyValue= dependency[i];
        //     $('.dependency_'+dependencyValue).prop('checked',true);
        // }

        
        console.log(conficts);
        console.log(dependency);
        console.log(togetherness);
    })
});

