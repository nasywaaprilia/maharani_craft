<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Log in - Sistem Enterprise Maharani Batik dan Tenun</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSS AdminLTE -->
  <link rel="stylesheet" href="<?php echo base_url('themes/plugins'); ?>/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?php echo base_url('themes/dist'); ?>/css/adminlte.min.css">

  <!-- Custom CSS -->
  <style>
    /* Background Gradient Pink */
    body {
        background: linear-gradient(135deg, #F0F8FF	 , #6495ED	 	) !important;
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
        color: #6495ED ;
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

    /* Button Login */
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
      <a href="<?php echo base_url('auth/login'); ?>"><b>Maharani</b> <br />Batik n' Tenun</a>
    </div>
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>
        
        <?php 
        $errors = session()->getFlashdata('errors');
        if(!empty($errors)){ ?>
          <div class="alert alert-danger" role="alert">
            <strong>Whoops!</strong> Ada kesalahan saat input data:
            <ul>
              <?php foreach ($errors as $error) { ?>
              <li><?php echo esc($error); ?></li>
              <?php } ?>
            </ul>
          </div>
        <?php } ?>

        <?php 
        $error_login = session()->getFlashdata('error_login');
        if(!empty($error_login)){ ?>
          <div class="alert alert-danger text-center">
            <?php echo $error_login; ?>
          </div>
        <?php } ?>

        <?php if($success_register = session()->getFlashdata('success_register')){ ?>
          <div class="alert alert-success text-center">
            <?php echo $success_register; ?>
          </div>
        <?php } ?>

        <?php 
        $inputs = session()->getFlashdata('inputs'); 
        echo form_open(base_url('auth/proses_login')); 
        ?>

        <div class="input-group mb-3">
          <?php
           $username = [
            'type'  => 'text',
            'name'  => 'username',
            'id'    => 'username',
            'value' => $inputs,
            'class' => 'form-control',
            'placeholder' => 'Username'
          ];
          echo form_input($username); 
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
            'value' => $inputs,
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

        <div class="row">
          <div class="col-8">
            <p class="mb-0">
              <a href="<?php echo base_url('auth/register'); ?>">Register</a>
            </p>
          </div>  
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
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
