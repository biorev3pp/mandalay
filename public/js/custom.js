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
      let lastRowMainVal = $(document).find("select.main_option:last").children("option:selected").val();
      if(lastRowMainVal!=0){
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
              if(value!=0){
                $(document).find("select.main_option:last option[value='"+value+"']").remove();
              }
            });
            addACLRowButtonHandle();
            deleteButtonHandle();
          }
        });
      }else{
        $(document).find("select.main_option:last").addClass('is-invalid');
        toastr.error('Please choose a valid option.',2000)
      }
    });
    var oldOption;
    $(document).on('focus','.main_option', function(){
      oldOption = '';
      let old_opt_text = $(this).children("option:selected").text();
      let old_opt_value = $(this).children("option:selected").val();
      if(old_opt_value!=0){
        oldOption = {
          id:old_opt_value,
          text:old_opt_text
        };
      }
      $(this).blur();
    });
    // Remove option from all dropdowns in current row which is once selected in main option
    $(document).on('change','.main_option', function(){
      let tr = $(this).closest('tr');
      let value = $(this).children("option:selected").val();
      let select_id = $(this).attr('id');
      $(document).find("select.main_option").each(function(i,obj){
        if($(obj).attr('id')!=select_id){
          $(this).find("option[value='"+value+"']").remove();
        }
      });
      tr.find("select.conflict option[value='"+value+"']").remove();
      tr.find("select.togetherness option[value='"+value+"']").remove();
      tr.find("select.dependency option[value='"+value+"']").remove();
      // append old option
      if(oldOption.hasOwnProperty('id')) {
        var newConflictOption = new Option(oldOption.text, oldOption.id, false, false);
        var newTogetherOption = new Option(oldOption.text, oldOption.id, false, false);
        var newDependencyOption = new Option(oldOption.text, oldOption.id, false, false);
        tr.find('select.conflict').append(newConflictOption).trigger('change');
        tr.find('select.togetherness').append(newTogetherOption).trigger('change');
        tr.find('select.dependency').append(newDependencyOption).trigger('change');  
      }
      
      // now we need to check if current selected option has any conficts and togetherness
      let optionInConfict = $(this).closest('tbody').find(".conflict option[value='"+value+"']").parent('select').val();
       let = isArr = Array.isArray(optionInConfict); 
      if(!isArr) {
        optionInConfict = new Array(optionInConfict);
      }
      
      listOfConficts = [];
      if(optionInConfict.includes(value)) {
        let mainOpt = $(this).closest('tbody').find(".conflict option[value='"+value+"']").closest('tr').find('.main_option').val();
        // set value to current tr confict select value
        //get slected values
        let preConficts = $(this).closest('tr').find('.conflict').val();
        if(Array.isArray(preConficts) && preConficts.length) {
          preConficts = new Array(preConficts);
        }
        if(preConficts.length) {
          $.each(preConficts,function(index, vl) {
            listOfConficts.push(vl[index]);
          });
        }
        listOfConficts.push(mainOpt);

        // set value to current tr confict select value
        //get slected values
        listOfConficts = unique(listOfConficts);
        console.log(listOfConficts)
        $(this).closest('tr').find('.conflict').val(listOfConficts);
        $(this).closest('tr').find('.conflict').trigger('change');
      }

      let optionTogetherness = $(this).closest('tbody').find(".togetherness option[value='"+value+"']").parent('select').val();
      let isTogethernessArr = Array.isArray(optionTogetherness); 
      if(!isTogethernessArr) {
        optionTogetherness = new Array(optionTogetherness);
      }
      // console.log(optionTogetherness)
      listOfTogetharness = [];
      if(optionTogetherness.includes(value)  ) {
        let mainOpt = $(this).closest('tbody').find(".togetherness option[value='"+value+"']").closest('tr').find('.main_option').val();
        // set value to current tr confict slect value
        //get slected values
        let preTogetherness = $(this).closest('tr').find('.togetherness').val();
        if(Array.isArray(preTogetherness) && preTogetherness.length) {
          preTogetherness = new Array(preTogetherness);
        }
        if(preTogetherness.length) {
          $.each(preTogetherness,function(index, vl) {
            listOfTogetharness.push(vl[index]);
          });
        }
        listOfTogetharness.push(mainOpt);
        // set value to current tr confict slect value
        //get slected values
        listOfTogetharness = unique(listOfTogetharness);
        console.log(listOfTogetharness)
        $(this).closest('tr').find('.togetherness').val(listOfTogetharness);
        $(this).closest('tr').find('.togetherness').trigger('change');
      }

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
    //remove acl row and append its selected main option to other available main option dropdowns 
    $(document).on('click','.removeACLRowBtn', function(){
      let tr = $(this).closest('tr');
      let main_opt_text = tr.find('select.main_option').children("option:selected").text();
      let main_opt_value = tr.find('select.main_option').children("option:selected").val();
      let opt = document.createElement('option');
      opt.value = main_opt_value;
      opt.text = main_opt_text; 
      if(main_opt_value != 0){
        $(document).find('select.main_option').append(opt);
      }
      addACLRowButtonHandle();
      tr.remove();
      deleteButtonHandle();
    });

    $(document).on('select2:unselect','.togetherness',function(event){
      let unselectVl = event.params.data.id;
      
    })
    // function to show/hide add row button 
    function addACLRowButtonHandle(){
      let optionsLength = $(document).find("select.main_option:last option").length - 1;
      // console.log(optionsLength);
      if(optionsLength < 2){
        $(document).find('.clonetrBtn').addClass('d-none');
      }else{
        $(document).find('.clonetrBtn').removeClass('d-none');
      }
    }

    // function to show/hide delete and save button 
    function deleteButtonHandle(){
      var rowCount = $(document).find('.aclTable tbody tr').length;
      // console.log(rowCount);
      if(rowCount > 0){
        $(document).find('.delete_acl_row').removeClass('d-none');    
        $(document).find('.saveACLBtn').removeClass('d-none');    
      }else{
        $(document).find('.delete_acl_row').addClass('d-none');
        $(document).find('.saveACLBtn').addClass('d-none');
      }
    }
    deleteButtonHandle();
  function unique(list) {
        var result = [];
        $.each(list, function(i, e) {
            if ($.inArray(e, result) == -1) result.push(e);
        });
        return result;
    }

});
