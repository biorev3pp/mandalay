       
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
                                <label for="email">Email Address <span class="text-danger">*</span> </label>
                                <input type="email" class="form-control" id="lemail" required placeholder="Enter Email">
                            </div>
                            <div class="form-group">
                                <label for="last_name">Password<span class="text-danger">*</span> </label>
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
                                <label for="name">Full Name <span class="text-danger">*</span> </label>
                                <input type="text" class="form-control" id="nname" required placeholder="Enter Full Name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address <span class="text-danger">*</span> </label>
                                <input type="email" class="form-control" id="nemail" required placeholder="Enter Email">
                            </div>
                            <div class="form-group">
                                <label for="mobile">Contact Number</label>
                                <input type="mobile" class="form-control" id="nmobile" required placeholder="Enter Contact Number">
                            </div>
                            <div class="form-group">
                                <label for="last_name">Password<span class="text-danger">*</span> </label>
                                <input type="password" class="form-control" id="npassword" required placeholder="Enter Password">
                            </div> 
                            <div class="form-group" id="regdiv">
                                <button type="submit" class="btn btn-block btn-primary">Sign Up</button>
                            </div>   
                        </form>
                    </div>
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <form action="javascript:void(0)" id="forgotPasswordForm" method="post">
                            <div class="form-group">
                                <label for="email">Email Address <span class="text-danger">*</span> </label>
                                <input type="email" class="form-control" id="email" required placeholder="Enter Email">
                            </div>
                            <div class="form-group">
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

    $('#forgotPasswordForm').submit(function() {
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
                $("#preloader").show();
            },
            complete: function () 
            {
                //$(document).find('#finishPage_form').submit();
            },
            success: function (response) 
            {
                
            }
        });
    });
});
</script>
