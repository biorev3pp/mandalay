       
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" crossorigin="anonymous"></script>
<style>
    .loginModal .modal-body{padding: 0;}
    .loginModal .nav-tabs .nav-item{width: 33.3%; border: none; text-align: center;padding: 10px; color: #297fd5;}
    .loginModal .nav-tabs .nav-item.active{color: #fff; background-color: #297fd5; border-radius: 0px;}
    .loginModal .tab-content{padding: 13px 13px 40px; border-top: 2px solid  #297fd5;}
    
</style>
<div class="modal fade loginModal" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-white" style="background:#2a2c30;">
                <h5 class="modal-title" id="loginModalLabel">Please Do Login To Continue</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-signin-tab" data-toggle="tab" href="#nav-signin" role="tab" aria-controls="nav-signin" aria-selected="true">Sign In</a>
                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Sign Up</a>
                        <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Forgot Password</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-signin" role="tabpanel" aria-labelledby="nav-signin-tab">
                        <form action="javascript:void(0)" id="signInForm" method="post">
                            <div id="lerr-msg"></div>
                            <div class="form-group">
                                <label for="lemail">Email Address <span class="text-danger">*</span> </label>
                                <input type="email" class="form-control" id="lemail" required placeholder="Enter Email">
                            </div>
                            <div class="form-group">
                                <label for="lpassword">Password<span class="text-danger">*</span> </label>
                                <input type="password" class="form-control" id="lpassword" required placeholder="Enter Password">
                            </div>  
                            <div class="form-group text-center" id="logindiv">
                                <button type="submit" class="btn btn-block btn-primary">Sign In</button>
                            </div> 
                        </form>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <form action="javascript:void(0)" id="signupForm" method="post">
                            <div id="rerr-msg"></div>
                            <div class="form-group">
                                <label for="nname">Full Name <span class="text-danger">*</span> </label>
                                <input type="text" class="form-control" id="nname" required placeholder="Enter Full Name">
                            </div>
                            <div class="form-group">
                                <label for="nemail">Email Address <span class="text-danger">*</span> </label>
                                <input type="email" class="form-control" id="nemail" required placeholder="Enter Email">
                            </div>
                            <div class="form-group">
                                <label for="nmobile">Contact Number</label>
                                <input type="mobile" class="form-control" id="nmobile" required placeholder="Enter Contact Number">
                            </div>
                            <div class="form-group">
                                <label for="npassword">Password<span class="text-danger">*</span> </label>
                                <input type="password" class="form-control" id="npassword" required placeholder="Enter Password">
                            </div> 
                            <div class="form-group" id="regdiv">
                                <button type="submit" class="btn btn-block btn-primary">Sign Up</button>
                            </div>   
                        </form>
                    </div>
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <form action="javascript:void(0)" id="forgotPasswordPopForm" method="post">
                            <div id="ferr-msg"></div>
                            <div class="form-group" id="ediv">
                                <label for="femail">Email Address <span class="text-danger">*</span> </label>
                                <input type="email" class="form-control" id="femail" name="femail" placeholder="Enter Email">
                            </div>
                            <div class="form-group" style="display:none" id="vcodeDiv">
                                <label for="fvcode">Verification Code<span class="text-danger">*</span> </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="fvcode" placeholder="Enter Verification Code">
                                    <div class="input-group-append no-verify">
                                        <button class="input-group-text" id="verifyCode" type="button"> Verify </button>
                                      </div>
                                </div>
                            </div>
                            <div class="form-group" style="display:none" id="npassDiv">
                                <label for="fpassword">New Password<span class="text-danger">*</span> </label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="fpassword" placeholder="Enter Password">
                                    <div class="input-group-append">
                                        <button class="input-group-text" id="showPass" type="button"> <i class="fa fa-eye"></i> </button>
                                      </div>
                                </div>
                                <div class="form-group mt-3" id="cpPassBtnDiv">
                                    <button type="button" id="cpPassBtn" class="btn btn-block btn-primary">Change Password</button>
                                </div> 
                            </div>
                            <div class="form-group" id="forgdiv">
                                <button type="submit" class="btn btn-block btn-primary">Proceed</button>
                            </div>  
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function (){

    // Sign up Form Action
    $('#signupForm').submit(function() {
        $.ajax({
            url : app_base_url+'/api/user-register',
            type : "POST",
            data : {'name':$('#nname').val(),'email':$('#nemail').val(),'mobile':$('#nmobile').val(),'password':$('#npassword').val()},
            headers: 
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend  : function () 
            {
                $("#preloader").show();
            },
            complete: function (response) 
            {
                if(response.responseJSON.status == 'success') {
                    $(document).find('.manageToggle').each(function(){
                        let checked = $(this).find('input').is(':checked');
                        if(checked){
                            let featureid = $(this).attr('data-self');
                            let featureInput = '<input name="feature_id[]" type="hidden" value="'+featureid+'">';
                            $(document).find("input[name='home_id']").after(featureInput);
                        }
                    });
                    $(document).find('#finishPage_form').submit();
                } else {
                    $('#rerr-msg').html(response.responseJSON.message).addClass('alert alert-danger');
                    $('#regdiv').html('<button type="submit" class="btn btn-block btn-primary">Sign Up</button>');
                }
            },
            success: function (response) 
            {
                
            }
        });
    });

    // Sign in Form Action

    $('#signInForm').submit(function() {
        $('#logindiv').html('<img src="'+app_base_url+'/images/spinner.gif">');
        $.ajax({
            url : app_base_url+'/api/user-login',
            type : "POST",
            data : {'email':$('#lemail').val(),'password':$('#lpassword').val()},
            headers: 
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend  : function () 
            {
                $("#preloader").show();
            },
            complete: function (response) 
            {
                if(response.responseJSON.status == 'success') {
                    $(document).find('.manageToggle').each(function(){
                        let checked = $(this).find('input').is(':checked');
                        if(checked){
                            let featureid = $(this).attr('data-self');
                            let featureInput = '<input name="feature_id[]" type="hidden" value="'+featureid+'">';
                            $(document).find("input[name='home_id']").after(featureInput);
                        }
                    });
                    $(document).find('#finishPage_form').submit();
                } else {
                    $('#lerr-msg').html(response.responseJSON.message).addClass('alert alert-danger');
                    $('#logindiv').html('<button type="submit" class="btn btn-block btn-primary">Sign In</button>');
                }
            },
            success: function (response) 
            {
                
            }
        });
    });

    // Forgot password Form Actions - send code on email

    $('#forgotPasswordPopForm').submit(function() {
        $('#forgdiv').html('<img src="'+app_base_url+'/images/spinner.gif">');
        $.ajax({
            url : app_base_url+'/api/forgot-password',
            type : "POST",
            data : {'email':$('#femail').val()},
            headers: 
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend  : function () 
            {
                //$("#preloader").show();
            },
            complete: function (response) 
            {
                if(response.responseJSON.status == 'success') {
                    $('#ferr-msg').html(response.responseJSON.message).addClass('alert alert-success').removeClass('alert-danger');
                    $('#femail').attr('readonly', 'readonly');
                    $('#vcodeDiv').show();
                    $('#forgdiv').html('').hide();
                } else {
                    $('#ferr-msg').html(response.responseJSON.message).addClass('alert alert-danger').removeClass('alert-success');
                    $('#forgdiv').html('<button type="submit" class="btn btn-block btn-primary">Proceed</button>');
                }
            },
            success: function (response) 
            {
                
            }
        });
    });

    // verify code sent on email

    $('#verifyCode').click(function() {
        $.ajax({
            url : app_base_url+'/api/verify-code',
            type : "POST",
            data : {'email':$('#femail').val(), 'vcode':$('#fvcode').val()},
            headers: 
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend  : function () 
            {
                //$("#preloader").show();
            },
            complete: function (response) 
            {
                if(response.responseJSON.status == 'success') {
                    $('#ferr-msg').html(response.responseJSON.message).addClass('alert alert-info').removeClass('alert-danger alert-success');
                    $('#femail').attr('readonly', 'readonly');
                    $('#vcodeDiv').hide();
                    $('.no-verify').html('').hide();
                    $('#npassDiv').show();
                } else {
                    $('#ferr-msg').html(response.responseJSON.message).addClass('alert alert-danger').removeClass('alert-success  alert-info');
                }
            },
            success: function (response) 
            {
                
            }
        });
    });

    // update password
    $('#cpPassBtn').click(function() {
        $('cpPassBtnDiv').html('<img src="'+app_base_url+'/images/spinner.gif">');
        $.ajax({
            url : app_base_url+'/api/update-password',
            type : "POST",
            data : {'email':$('#femail').val(), 'vcode':$('#fvcode').val(), 'passcode': $('#fpassword').val()},
            headers: 
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend  : function () 
            {
                //$("#preloader").show();
            },
            complete: function (response) 
            {
                if(response.responseJSON.status == 'success') {
                    $(document).find('.manageToggle').each(function(){
                        let checked = $(this).find('input').is(':checked');
                        if(checked){
                            let featureid = $(this).attr('data-self');
                            let featureInput = '<input name="feature_id[]" type="hidden" value="'+featureid+'">';
                            $(document).find("input[name='home_id']").after(featureInput);
                        }
                    });
                    $(document).find('#finishPage_form').submit();
                } else {
                    $('cpPassBtnDiv').html('<button type="button" id="cpPassBtn" class="btn btn-block btn-primary">Change Password</button>');
                    $('#ferr-msg').html(response.responseJSON.message).addClass('alert alert-danger').removeClass('alert-success  alert-info');
                }
            },
            success: function (response) 
            {
                
            }
        });
        
    });

    // Show/hide password in forgot password box
    $('#showPass').mouseover(function() {
        $('#fpassword').attr('type', 'text');
    }).mouseout(function() {
        $('#fpassword').attr('type', 'password');
    });

});
</script>
