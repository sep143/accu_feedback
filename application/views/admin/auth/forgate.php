<!DOCTYPE html>

<html lang="en">

    <head>

          <title><?=isset($title)?$title:'User Management System' ?></title>

          <!-- Tell the browser to be responsive to screen width -->

          <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

          <!-- Bootstrap 3.3.6 -->

          <link rel="stylesheet" href="<?= base_url() ?>public/bootstrap/css/bootstrap.min.css">

          <!-- Theme style -->

          <link rel="stylesheet" href="<?= base_url() ?>public/dist/css/AdminLTE.min.css">

           <!-- Custom CSS -->

          <link rel="stylesheet" href="<?= base_url() ?>public/dist/css/style.css">

          <link rel="icon" href="<?= base_url(); ?>image/app_logo.ico">
           <!-- jQuery 2.2.3 -->

          <script src="<?= base_url() ?>public/plugins/jQuery/jquery-2.2.3.min.js"></script>

          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">

          <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>

    </head>

<body style="background: #e8e8ea; ">

    <div class="container">

        <div class="row">

            

            <div class="col-md-4 col-md-offset-4 ">

                <div class="login-title text-center">

                    <h3>

                        <img src="<?= base_url() ?>image/app_logo.png" class="" alt="Logo" width="60px" height="65px">

                        <span>Accu Feedback</span>Forgot Password</h3>

                </div>

                <?php if(isset($msg) || validation_errors() !== ''): ?>

                <div class="alert alert-warning alert-dismissible">

                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                    <h4><i class="icon fa fa-warning"></i> Alert!</h4>

                    <?= validation_errors();?>

                    <?= isset($msg)? $msg: ''; ?>

                </div>

                <?php endif; ?>

                <div class="form-box text-center">

                    <div class="caption">

                        <h4>Send Password Your Register Email</h4>

                    </div>

                    <?php echo form_open(base_url('admin/LoginController/forgate_password'), 'class="login-form" '); ?>

                        <div class="form-group">

                            

                            <input type="email" name="email" id="email" class="form-control" placeholder="User Name" >

                            <!--<input type="password" name="password" id="password" class="form-control" placeholder="Password" >-->

                        </div>

                        <!--div class="form-group">

                            <input type="radio" name="account" class="" >

                            <input type="radio" name="account" class="" >

                        </div-->

<!--                        <div class="form-group">

                            <select class="pull-right" name="categorie">

                                <option value="1">Admin</option>

                                <option value="2">Other</option>

                            </select>

                        </div>-->

                        <div class="">

                            <br>

                            <input type="submit" name="submit" id="submit" class="form-control" value="Submit">

                        </div>

                    <?php echo form_close(); ?>

                        <div>

                            <a href="<?= site_url('admin/LoginController/login'); ?>" class="pull-left">Login</a>

                        </div>

                </div>

            </div>

        </div>

    </div>

</body>



    <!-- Bootstrap 3.3.6 -->

    <script src="<?= base_url() ?>public/bootstrap/js/bootstrap.min.js"></script>

    

    <!-- AdminLTE App -->

    <script src="<?= base_url() ?>public/dist/js/app.min.js"></script>

  



    <style type="text/css">

    .login-title{

        padding-top: 80px;

    }

    .login-title span{

        font-size: 30px;

        line-height: 1.9;

        display: block;

        font-weight: 700;

    }

    .form-box{

        position: relative;

        background: #ffffff;

        max-width: 375px;

        width: 100%;

        border-top: 5px solid #33b5e5;

        box-shadow: 0 0 3px rgba(0, 0, 0, 0.1);

        padding: 30px;

    }



    .caption{

        margin-bottom:40px;

    }

    .login-form input[type=text], .login-form input[type=password]{

        margin-bottom:10px;

    }



    .login-form input {

        outline: none;

        display: block;

        width: 100%;

        border: 1px solid #d9d9d9;

        margin: 0 0 20px;

        padding: 10px 15px;

        box-sizing: border-box;

        border-radius: 0;

        -moz-border-radius: 0;

        -webkit-border-radius: 0;

        min-height: 40px;

        font-wieght: 400;

        -webkit-transition: 0.3s ease;

        transition: 0.3s ease;

    }



    .login-form input[type=submit]{

        cursor: pointer;

        background: #33b5e5;

        width: 100%;

        border: 0;

        padding: 8px 15px;

        color: #ffffff;

        -webkit-transition: 0.3s ease;

        transition: 0.3s ease;

        border-radius: 0;

        -moz-border-radius: 0;

        -webkit-border-radius: 0;

        min-height: 40px;

        

    }

    </style>

</html>