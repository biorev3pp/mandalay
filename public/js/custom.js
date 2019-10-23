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
          $(document).find('.aclTable').append(response);
          $(document).find("select.js-example-basic-single").select2();
          // remove main option from dropdown list which are already added if already added
          let main_option_count = $(document).find('select.main_option').length;
          let x = 1;
          let main_option_selected = [];
          $(document).find('select.main_option').each(function(i,obj){
            if(x < main_option_count){
              let selected_value = $(obj).children("option:selected").val();
              main_option_selected.push(selected_value);
            }
            x = x+1;
          });
          $.each(main_option_selected, function( index, value ) {
            $(document).find("select.main_option:last option[value='"+value+"']").remove();
          });
        }
      });
    });
    
    // Remove option from all dropdowns in current row which is once selected in main option
    $(document).on('change','.main_option', function(){
      let tr = $(this).closest('tr');
      let value = $(this).children("option:selected").val();
      tr.find("select.conflict option[value='"+value+"']").remove();
      tr.find("select.togetherness option[value='"+value+"']").remove();
      tr.find("select.dependency option[value='"+value+"']").remove();  
    });
    // Remove option from all dropdowns in current row which is once selected in conflict
    $(document).on('change','.conflict', function(){
      let tr = $(this).closest('tr');
      $(this).children("option:selected").each(function(i,obj){
        let value = $(obj).val();
        tr.find("select.togetherness option[value='"+value+"']").remove();
        tr.find("select.dependency option[value='"+value+"']").remove();  
      });
    });
    // Remove option from all dropdowns in current row which is once selected in togetherness
    $(document).on('change','.togetherness', function(){
      let tr = $(this).closest('tr');
      $(this).children("option:selected").each(function(i,obj){
        let value = $(obj).val();
        tr.find("select.conflict option[value='"+value+"']").remove();
        tr.find("select.dependency option[value='"+value+"']").remove();  
      });
    });
    // Remove option from all dropdowns in current row which is once selected in dependency
    $(document).on('change','.dependency', function(){
      let tr = $(this).closest('tr');
      $(this).children("option:selected").each(function(i,obj){
        let value = $(obj).val();
        tr.find("select.conflict option[value='"+value+"']").remove();
        tr.find("select.togetherness option[value='"+value+"']").remove();  
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
