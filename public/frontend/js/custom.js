$(document).ready(function (){
    //set local storage default values
    localStorage.setItem('home_id',1);
    localStorage.setItem('floor_id',1);
    localStorage.setItem('feature_id',1);

    $(document).on('click','.home_list', function(e){
        let homeid = $(this).attr('id');
        localStorage.setItem('home_id',homeid);
        let homeEnId = $(this).attr('data-home-id');
        $(document).find('.floor_image_view').addClass('d-none');
        // Show Full Home Image
        $(document).find('.home_image_full').each(function(i,obj){
            if($(obj).attr('id')===homeid){
                $(obj).removeClass('d-none');
            }else{
                $(obj).addClass('d-none');
            }
        });
        //Set Floors of current home
        $(document).find('.home_floors').each(function(i,obj){
            if($(obj).attr('data-floor-home-id')===homeid){
                $(obj).removeClass('d-none');
            }else{
                $(obj).addClass('d-none');
            }
        });
    });

    $(document).on('click','.hometab', function(e){
        let homeid = localStorage.getItem('home_id');
        $(document).find('.home_image_full').each(function(i,obj){
            if($(obj).attr('id')===homeid){
                $(obj).removeClass('d-none');
            }else{
                $(obj).addClass('d-none');
            }
        });
        $(document).find('.floor_image_view').addClass('d-none');
        $(document).find('.feature_image_view').addClass('d-none');
    });

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
                $(document).find('.home_image_full ').addClass('d-none');
                $(document).find('.feature_image_view').addClass('d-none');
                $(document).find('.floor_image_view').removeClass('d-none');
                $(document).find('.floor_image_view img').attr('src',response.image);
            }
        });
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
              let featurePassId = "'"+'_feature'+featureId+"'";
              let featureHtml  = '<div class="feature-content" id="feature'+featureId+'">';
                  featureHtml += '<img class="img-fluid rounded mx-auto d-block" id="hubblepic_feature'+featureId+'" src="'+response.image+'"/>';
                  featureHtml += '<input class="m-auto custom-range" type="range" min="1" max="4" value="1" step="0.1" id="zoomer_feature'+featureId+'" oninput="deepdive('+featurePassId+')" style="position: absolute; right: 0; width: 90%; top: 0; left: 0;">'
                  featureHtml += '</div>';
              $(document).find('.floor_image_view').append(featureHtml);
            }
        });
        }else{
            // $(document).find('.floor_image_view img').each(function(i,obj){
            //     if($(obj).attr('id')===featureId){
            //         $(obj).remove();
            //     }
            // });
            $('#feature'+featureId).remove();
        }
    });
});
