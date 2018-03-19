<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login Brajamarketindo </title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url()?>assets/template/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url()?>assets/template/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url()?>assets/template/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?php echo base_url()?>assets/template/vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url()?>assets/template/build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <div class="panel panel-default">
            <div class="panel-body">
          <section class="login_content">
            <form class="form-login" action="<?php echo base_url('users/auth/cek_login');?>" method="post" enctype="multipart/form-data">
              <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>">
              <h1>Login Form</h1>
              <?php echo $this->session->flashdata('message'); ?>
              <div>
                <input type="text" name="identity" autocomplete="off" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="password" name="password" class="form-control" placeholder="Password" required="" />
              </div>

              <label class="checkbox-inline" style="margin-left: -225px;">
		                <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"'); ?> <?php echo $this->lang->line('login_remember_label'); ?> Remember
		           </label>
               <br><br>
              <div>
                <button class="btn btn-primary submit" type="submit"><i class="fa fa-lock"></i> Log in</button>
                <a class="reset_pass" href="#">Lost your password?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <!-- <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p> -->

                <div class="clearfix"></div>

                <div>
                  <h1><i class="fa fa-paw"></i> Brajamarketindo!</h1>
                  <p>©2016 All Rights Reserved. Brajamarketindo! Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div></div>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form>
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="index.html">Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
