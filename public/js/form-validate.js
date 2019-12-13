var toastr = {
  success : function(success_message,delayTime = 5000) {
    $.toast({
          heading             : 'Success',
          text                : success_message,
          loader              : true,
          loaderBg            : '#fff',
          showHideTransition  : 'fade',
          icon                : 'success',
          hideAfter           : delayTime,
          position            : 'top-right'
      });
  },
  error : function(error_message,delayTime = 8000) {
    $.toast({
          heading             : 'Error',
          text                : error_message,
          loader              : true,
          loaderBg            : '#fff',
          showHideTransition  : 'fade',
          icon                : 'error',
          hideAfter           : delayTime,
          position            : 'top-right'
      });
  }
}
$(document).ready(function ()
{
    var minPhoneLen = 10;
    var maxPhoneLen = 15;
    $.validator.addMethod("noSpace", function(value, element,param)
    {
      return $.trim(value).length >= param;
    }, "No space please and don't leave it empty");
    $.validator.addMethod("valueNotEquals", function(value, element, param) {
      return this.optional(element) || value != param;
    }, "This field is required"),
    $.validator.addMethod('minStrict', function (value, el, param) {
      return value > param;
    },"Rate should be greater then 0.00"),
    $.validator.addMethod('notStartZero', function (value, el, param) {
      return value.search(/^0/) == -1;
    },"Number should not starts with 0.");
    $.validator.addMethod("notEqual", function(value, element, param) {
      return this.optional(element) || value != param;
    }, "This field is required"),
    $.validator.addMethod("lettersonly", function(value, element)
    {
      return this.optional(element) || /^[a-z," "]+$/i.test(value);
    }, "Numbers are not allowed in this field.");

    /**
     * Login Form Validations
     */
    $("#login_form").validate({
      errorClass   : "has-error",
      highlight    : function(element, errorClass) {
        $(element).parents('.form-group').addClass(errorClass);
      },
      unhighlight  : function(element, errorClass, validClass) {
        $(element).parents('.form-group').removeClass(errorClass);
      },
      rules:
      {
        email:
        {
          required  : true,
          noSpace   : true,
          email     : true
        },
        password:
        {
          required  : true,
          noSpace   : true,
        }
      },
      messages:
      {
        email: {
          required  : "Email is required.",
          email     : "Please enter valid email",
        },
        password: {
          required  : "Password is required.",
        },
      },
      submitHandler: function (form)
      {
        formSubmit(form);
      }
    });

    /**
     * Change Password Validations
     */
    $("#reset_password_form").validate({
        errorClass   : "has-error",
        highlight    : function(element, errorClass) {
            $(element).parents('.form-group').addClass(errorClass);
        },
        unhighlight  : function(element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass(errorClass);
        },
        rules:
            {
                password:
                {
                    required  : true,
                    noSpace   : true,
                    minlength : 8,
                },
                password_confirmation:
                {
                    required  : true,
                    noSpace   : true,
                    equalTo   : '#password',
                }
            },
        messages:
            {
                password: {
                    minlength : "Password must contain at least 8 characters.",
                },
                password_confirmation: {
                    equalTo : "Password not matched.",
                },
            },
        submitHandler: function (form)
        {
            formSubmit(form);
        }
    });


    /**
     * Webpages Form Validations
     */
    $("#floors_form").validate({
        errorClass   : "has-error",
        highlight    : function(element, errorClass) {
            $(element).parents('.form-group').addClass(errorClass);
        },
        unhighlight  : function(element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass(errorClass);
        },
        rules:{ },
        // errorPlacement: function (error, element) {
        //     if (element.attr("id") == "music_file") {
        //         error.insertAfter($(element).next());
        //     }
        // },
        submitHandler: function (form)
        {
            formSubmit(form);
        }
    });

    /**
     * Seo Form Validations
     */
    $("#menu_form").validate({
        errorClass   : "has-error",
        highlight    : function(element, errorClass) {
            $(element).parents('.form-group').addClass(errorClass);
        },
        unhighlight  : function(element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass(errorClass);
        },
        rules:{ },
        // errorPlacement: function (error, element) {
        //     if (element.attr("id") == "music_file") {
        //         error.insertAfter($(element).next());
        //     }
        // },
        submitHandler: function (form)
        {
            formSubmit(form);
        }
    });

    /**
     * Change Password Form Validations
     */
    $("#change_password_form").validate({
        errorClass   : "has-error",
        highlight    : function(element, errorClass) {
            $(element).parents('.form-group').addClass(errorClass);
        },
        unhighlight  : function(element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass(errorClass);
        },
        rules: {
            current_password:
            {
                required  : true,
                noSpace   : true,
            },
            new_password:
            {
                required  : true,
                noSpace   : true,
                minlength : 8,
            },
            confirm_password:
            {
                required  : true,
                noSpace   : true,
                equalTo   : '#new_password',
            }
        },
        messages:
        {
            new_password: {
                minlength : "Password must contain at least 8 characters.",
            },
            confirm_password: {
                equalTo : "Password not matched.",
            },
        },
        submitHandler: function (form)
        {
            formSubmit(form);
        }
    });

    /**
     * Admin Forgot Password Form Validations
     */
    $("#admin_forgot_form").validate({
        errorClass   : "has-error",
        highlight    : function(element, errorClass) {
            $(element).parents('.form-group').addClass(errorClass);
        },
        unhighlight  : function(element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass(errorClass);
        },
        rules: {
            email:
            {
                required  : true,
                noSpace   : true,
                email     : true
            },

        },
        messages:
            {

            },
        submitHandler: function (form)
        {
            formSubmit(form);
        }
    });

    /**
     * Delete Form Validations
     */
    $("#delete_form").validate({
        errorClass   : "has-error",
        highlight    : function(element, errorClass) {
            $(element).parents('.form-group').addClass(errorClass);
        },
        unhighlight  : function(element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass(errorClass);
        },
        rules:{ },
        submitHandler: function (form)
        {
            formSubmit(form);
        }
    });

    /**
     * Portfolio Form Validations
     */
    $("#portfolio_form").validate({
        errorClass   : "has-error",
        highlight    : function(element, errorClass) {
            $(element).parents('.form-group').addClass(errorClass);
        },
        unhighlight  : function(element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass(errorClass);
        },
        rules:{ },
        submitHandler: function (form)
        {
            formSubmit(form);
        }
    });

    /**
     * Portfolio Form Validations
     */
    $("#setting_form").validate({
        errorClass   : "has-error",
        highlight    : function(element, errorClass) {
            $(element).parents('.form-group').addClass(errorClass);
        },
        unhighlight  : function(element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass(errorClass);
        },
        rules:{ },
        submitHandler: function (form)
        {
            formSubmit(form);
        }
    });
    /**
     * Save acl settings Form Validations
     */
    $("#acl_setting_form").validate({
        errorClass   : "has-error",
        highlight    : function(element, errorClass) {
            $(element).parents('.form-group').addClass(errorClass);
        },
        unhighlight  : function(element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass(errorClass);
        },
        rules:{ },
        submitHandler: function (form)
        {
            var rowCount = $(document).find('.aclTable tr').length;
            $(document).find('.trRowCount').val(rowCount);
            formSubmit(form);
        }
    });
});

function formSubmit(form)
{
    $.ajax({
        url         : form.action,
        type        : form.method,
        //data        : $(form).serialize(),
        data        : new FormData(form),
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        },
        contentType : false,
        cache       : false,
        processData : false,
        dataType    : "json",
        beforeSend  : function () {
            $("input[type=submit]").attr("disabled", "disabled");
            $("#preloader").show();
        },
        complete: function () {
            $("#preloader").hide();
            $("input[type=submit]").removeAttr("disabled");
            $("button[type=submit]").removeAttr("disabled");
        },
        success: function (response) {
            $("#preloader").hide();
            $("input[type=submit]").removeAttr("disabled");
            var delayTime=0;
            $.toast().reset('all');
            if(response.delayTime){
                delayTime = response.delayTime;
            }
            if (response.success)
            {
                toastr.success(response.message,delayTime)
                if( response.updateRecord)
                {
                    $.each(response.data, function( index, value )
                    {
                        $(document).find('#tableRow_'+response.data.id).find("td[data-name='"+index+"']").html(value);
                    });
                }
                if( response.addRecord)
                {
                    $.each(response.data, function( index, value )
                    {
                        $("input[name='"+index+"']").parents('.form-group').addClass('has-error');
                        $("input[name='"+index+"']").after('<label id="'+index+'-error" class="has-error" for="'+index+'">'+value+'</label>');

                        $("select[name='"+index+"']").parents('.form-group').addClass('has-error');
                        $("select[name='"+index+"']").after('<label id="'+index+'-error" class="has-error" for="'+index+'">'+value+'</label>');
                    });
                }

                if (response.modelhide) {
                    if (response.delay)
                        setTimeout(function (){ $(response.modelhide).modal('hide') },response.delay);
                    else
                        $(response.modelhide).modal('hide');
                }
                if(response.showElement)
                {
                    var showIDs = response.showElement.split(",");
                    $.each(showIDs, function(i, val){ $(val).removeClass('d-none'); });
                }
                if(response.hideElement)
                {
                    var hideIDs = response.hideElement.split(",");
                    $.each(hideIDs, function(i, val){ $(val).addClass('d-none'); });
                }
                if(response.delete_id)
                {
                    var option = '';
                    $(document).find('.delete_record_btn').each(function(i,obj){
                        if($(obj).attr('id') == response.delete_id){
                            let tr = $(obj).closest('tr');
                            let optText = tr.find('select.main_option').children("option:selected").text();
                            let optVal  = tr.find('select.main_option').children("option:selected").val();
                            if(optVal!=0){
                                option = {
                                    id:optVal,
                                    text:optText
                                };
                            }
                            $(obj).closest('tr').remove();
                        } 
                    });
                    setMainOptionList(option);
                }

                // if(response.acl_settings) {
                //     $(document).find('.aclTable').append(response.new_option_row);
                //     $(document).find("select.js-example-basic-single").select2();
                    // var j = $(document);
                    // if($('.tr_clone:last').find('.main_option option').length == response.alerady_options.length) {
                    //     return;
                    // }
                    // var $tr =   $('.tr_clone:last');
                    // $tr.find(".js-example-basic-single").select2("destroy");
                    // var $clone = $tr.clone();
                    // $clone.find(':text').val('');
                    // $clone.find('select').val('');
                    // $clone.find('.conflict').attr('id','conflict'+parseInt(j.find('.tr_clone').length)+1);
                    // $clone.find('.togetherness').attr('id','togetherness'+parseInt(j.find('.tr_clone').length)+1);
                    // $clone.find('.dependency').attr('id','dependency'+parseInt(j.find('.tr_clone').length)+1);
                    // $clone.find('.main_option option').each(function() {
                    //     let value = parseInt($(this).val());
                    //     let valueExit = response.alerady_options.includes(value);
                    //     console.log(value , valueExit);
                    //     if(valueExit){
                    //         $(this).prop('disabled',true);
                    //     }
                    // })
                    // $tr.after($clone);
                    // $("select.js-example-basic-single").select2();
                    // j.find('.tr_clone').each(function(index) {
                    //     $(this).find('.main_option').attr('name','main_option['+index+']');
                    //     $(this).find('.conflict').attr('name','conflict['+index+'][]');
                    //     $(this).find('.togetherness').attr('name','togetherness['+index+'][]');
                    //     $(this).find('.dependency').attr('name','dependency['+index+'][]');
                    // });
                // }
            }
            else
            {
                if( response.formErrors)
                {
                    $.each(response.errors, function( index, value )
                    {
                        $("input[name='"+index+"']").parents('.form-group').addClass('has-error');
                        $("input[name='"+index+"']").after('<label id="'+index+'-error" class="has-error" for="'+index+'">'+value+'</label>');

                        $("select[name='"+index+"']").parents('.form-group').addClass('has-error');
                        $("select[name='"+index+"']").after('<label id="'+index+'-error" class="has-error" for="'+index+'">'+value+'</label>');
                    });
                    if( response.tabForm )
                    {
                        $(".setup-content").each(function()
                        {
                            if( $(this).find('.form-group').hasClass('has-error') )
                            {
                                var id = $(this).attr('id');
                                $('.setup-content').hide();
                                $('div[id$="'+id+'"]').show();
                                //$(this).find('.form-group').find('.has-error').siblings('input').focus();
                            }
                        });
                    }
                }else if(response.validation===false){
                    jQuery.each(response.message,function(index,value){
                        // $("input[name='"+index+"']").addClass('is-invalid');
                        // $("input[name='"+index+"']").after('<label id="'+index+'-error" class="has-error" for="'+index+'">'+value+'</label>');

                        // $("select[name='"+index+"']").addClass('is-invalid');
                        // $("select[name='"+index+"']").after('<label id="'+index+'-error" class="has-error" for="'+index+'">'+value+'</label>');

                        toastr.error(value,delayTime)
                    });
                }
                else
                {

                    toastr.error(response.message,delayTime)
                }
            }

            if(response.ajaxPageCallBack)
            {
                response.formid = form.id;
                ajaxPageCallBack(response);
            }

            if(response.resetform)
            {
                $('#'+form.id).trigger('reset');
            }
            if(response.submitDisabled)
            {
                $("input[type=submit]").attr("disabled", "disabled");
                $("button[type=submit]").attr("disabled", "disabled");

            }
            if(response.url)
            {
                if(response.delayTime)
                    setTimeout(function() { window.location.href=response.url;}, response.delayTime);
                else
                    window.location.href=response.url;
            }
            if (response.reload) {
                if(response.delayTime)
                    setTimeout(function(){  location.reload(); }, response.delayTime)
                else
                    location.reload();
            }

            if (response.elementShow) {
                jQuery(response.elementShow).fadeIn();
            }
        },
        error:function(response){
            console.log('Connection Error');
            // var delayTime = 2000;
            // $.toast({
            //     heading             : 'Error',
            //     text                : 'Connection error.',
            //     loader              : true,
            //     loaderBg            : '#fff',
            //     showHideTransition  : 'fade',
            //     icon                : 'error',
            //     hideAfter           : delayTime,
            //     position            : 'top-right'
            // });
        }
    });
}
