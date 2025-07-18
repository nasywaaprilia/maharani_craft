<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Register - Sistem Enterprise Maharani Batik dan Tenun</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?php echo base_url('themes/plugins'); ?>/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?php echo base_url('themes/dist'); ?>/css/adminlte.min.css">

   <!-- Custom CSS -->
   <style>
    /* Background Gradient Pink */
    body {
        background: linear-gradient(135deg, #F0F8FF	 , #6495ED) !important;
        color: #333;
        font-family: 'Poppins', sans-serif;
    }

    /* Container Login */
    .login-box {
        width: 380px;
        background-color: rgba(255, 255, 255, 0.95);
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    /* Logo Title */
    .login-logo a {
        color:  #6495ED ;
        font-weight: bold;
        text-transform: uppercase;
        font-size: 24px;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);
    }

    /* Card Style */
    .card {
        border-radius: 12px;
        border: none;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }

    /* Input Fields */
    .form-control {
        border: 2px solid #ADD8E6;
        border-radius: 8px;
        transition: 0.3s;
    }

    .form-control:focus {
        border-color: #ADD8E6;
        box-shadow: 0 0 8px rgba(255, 51, 133, 0.5);
    }

    /* Input Icons */
    .input-group-text {
        background-color: #ADD8E6;
        color: white;
        border: 2px solid #ADD8E6;
        border-radius: 8px 0 0 8px;
    }

    /* Button Register */
    .btn-primary {
        background-color: #4169E1;
        border-color: #4169E1;
        border-radius: 8px;
        transition: 0.3s;
        font-weight: bold;
    }

    .btn-primary:hover {
        background-color: #87CEEB;
        border-color: #87CEFA;
        box-shadow: 0 4px 12px #4169E1;
    }

    /* Register Link */
    a {
        color: #6495ED;
        font-weight: bold;
        transition: 0.3s;
    }

    a:hover {
        color: #4169E1;
        text-decoration: underline;
    }

    /* Alert Style */
    .alert {
        border-radius: 8px;
        font-size: 14px;
    }

    /* Responsive */
    @media (max-width: 576px) {
        .login-box {
            width: 90%;
        }
    }
  </style>
</head>
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="<?php echo base_url('auth/register'); ?>"><b>Maharani</b> <br/>Batik n' Tenun</a>
    </div>
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Register to create your account</p>
        <?php
          $errors = session()->getFlashdata('errors');
          if(!empty($errors)){
        ?>
        <div class="row">
          <div class="col-md-12">
            <div class="alert alert-danger">
              Whoops! Ada kesalahan saat input data, yaitu:
              <ul>
                <?php foreach ($errors as $error) { ?>
                <li><?php echo esc($error); ?></li>
                <?php } ?>
              </ul>
            </div>
          </div>
        </div>
        <?php } ?>
        <?php $inputs = session()->getFlashdata('inputs'); ?>
        <?php echo form_open('/auth/proses_register'); ?>
        <div class="input-group mb-3">
          <?php
            $username = [
              'type'  => 'text',
              'name'  => 'username',
              'id'    => 'username',
              'class' => 'form-control',
              'placeholder' => 'Username'
            ];
            echo form_input($username); 
          ?>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <?php
            $name = [
              'type'  => 'text',
              'name'  => 'name',
              'id'    => 'name',
              'class' => 'form-control',
              'placeholder' => 'Fullname'
            ];
            echo form_input($name); 
          ?>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <?php
            $email = [
              'type'  => 'email',
              'name'  => 'email',
              'id'    => 'email',
              'class' => 'form-control',
              'placeholder' => 'your_email@example.com'
            ];
            echo form_input($email); 
          ?>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <?php
            $password = [
              'type'  => 'password',
              'name'  => 'password',
              'id'    => 'password',
             // 'value' => 'password',
              'class' => 'form-control',
              'placeholder' => 'Password'
            ];
            echo form_input($password); 
          ?>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <?php
            $confirm_password = [
              'type'  => 'password',
              'name'  => 'confirm_password',
              'id'    => 'confirm_password',
              //'value' => 'confirm_password',
              'class' => 'form-control',
              'placeholder' => 'Konfirmasi Password'
            ];
            echo form_input($confirm_password); 
          ?>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-7">
            <p class="mb-0">
              Do you have account? <a href="<?php echo base_url('auth/login'); ?>" class="text-center">Log in</a>
            </p>
          </div>
          <div class="col-5">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
          </div>
        </div>
        <?php echo form_close(); ?>
      </div>
    </div>
  </div>
<script src="<?php echo base_url('themes/plugins'); ?>/jquery/jquery.min.js"></script>
<script src="<?php echo base_url('themes/plugins'); ?>/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url('themes/dist'); ?>/js/adminlte.min.js"></script>
</body>
</html>
