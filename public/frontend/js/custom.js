$(document).ready(function (){

    $(document).on('click','.home_list', function(e){
        let homeid = $(this).attr('id');
        let homeEnId = $(this).attr('data-home-id');
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
        
        //Set Current Home Id to Floor Tab
        // $(document).find('.floortab').attr('id',homeEnId);
    });

    // $(document).on('click','.floortab', function(e){
    //     let homeid = $(this).attr('id');
    //     if(homeid!=undefined){  
    //     console.log('here');  
    //         $.ajax({
    //             url         : app_base_url+'/get-floors/'+homeid,
    //             type        : "GET",
    //             headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    //             },
    //             contentType : false,
    //             cache       : false,
    //             processData : false,
    //             dataType    : "json",
    //             beforeSend  : function () {
    //                 $("#preloader").show();
    //             },
    //             complete: function () {
    //                 $("#preloader").hide();
    //             },
    //             success: function (response) {
    //                 console.log(response);
    //             }
    //         });
    //     }
    // });
});

