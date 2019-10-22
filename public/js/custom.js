$(document).ready(function (){
    // Load delete record id to delete modal
    $(document).on('click','.delete_record_btn',function(){
        let id = $(this).attr('id');
        $(document).find('#delete_id').val(id);
    });

    // Display Image name on Choose file text
    $(document).on('change','.image-file', function(e){
        var fileName = e.target.files[0].name;
        $(this).next().text(fileName);
        $(document).find('.image-preview').hide();
        $(document).find('#image_update').val('');
    });

    //To remove error class from form elements
    $(document).on('focus','input,select', function(e){
        $(this).removeClass('is-invalid');
    });

    $(document).on('click','.clonetrBtn', function(){
      let floorid = $(this).attr('data-floor-id');
      var rowCount = $(document).find('.aclTable tr').length;
      $.ajax({
        url         : app_base_url+'/admin/features/get_acl_form',
        type        : "post",
        data        : {'floorid':floorid,'index':rowCount},
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
          // $(document).find('.js-example-basic-single').select2();
          $(document).find('.aclTable').append(response);
          $(document).find("select.js-example-basic-single").select2();
          // console.log(response);
        }
      });
    });
    // event to clone tr and setting for acl floor
    // const j = jQuery(document);

    // j.on('click','.clonetr',function() {

      // var $tr =   $(this).closest('tr').prev();
      // $tr.find(".js-example-basic-single").select2("destroy");
      // var $clone = $tr.clone();
      // $clone.find(':text').val('');
      // $clone.find('.conflict').attr('id','conflict'+parseInt(j.find('.tr_clone').length)+1);
      // $clone.find('.togetherness').attr('id','togetherness'+parseInt(j.find('.tr_clone').length)+1);
      // $clone.find('.dependency').attr('id','dependency'+parseInt(j.find('.tr_clone').length)+1);
      // $tr.after($clone);
      // $("select.js-example-basic-single").select2();
    // });

    // function inputDataIndex() {
    //   j.find('.tr_clone').each(function(index) {
    //     $(this).find('.main_option').attr('name','main_option['+index+']');
    //     $(this).find('.conflict').attr('name','conflict['+index+'][]');
    //     $(this).find('.togetherness').attr('name','togetherness['+index+'][]');
    //     $(this).find('.dependency').attr('name','dependency['+index+'][]');
    //   });

    // }
    // inputDataIndex();

});
