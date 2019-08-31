<!DOCTYPE html>

<html lang="en">

    <head>

        <title><?= isset($title) ? $title : 'User Management System' ?></title>

        <!-- Tell the browser to be responsive to screen width -->

        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <!-- Bootstrap 3.3.6 -->

        <link rel="stylesheet" href="<?= base_url() ?>public/bootstrap/css/bootstrap.min.css">

        <link rel="stylesheet" href="<?= base_url() ?>public/all_common.css">

       

        <!--Themify icons stylesheet-->

        <link rel="stylesheet" href="<?= base_url() ?>public/themify-icons/themify-icons.css">

        <link rel="stylesheet" href="<?= base_url() ?>public/themify-icons/demo-files/demo.css">

        <!-- Font Awesome -->

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">

        <!-- Ionicons -->

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

        <!-- Theme style -->

        <link rel="stylesheet" href="<?= base_url() ?>public/dist/css/AdminLTE.min.css">

        <!-- Custom CSS -->

        <link rel="stylesheet" href="<?= base_url() ?>public/dist/css/style.css">

        <!-- AdminLTE Skins. Choose a skin from the css/skins. -->

        <link rel="stylesheet" href="<?= base_url() ?>public/dist/css/skins/skin-blue.min.css">

        <!-- jQuery 2.2.3 -->
        <link rel="icon" href="<?= base_url(); ?>image/app_logo.ico">
        
        <script src="<?= base_url() ?>public/plugins/jQuery/jquery-2.2.3.min.js"></script>

        

        <!--script src="<?= base_url() ?>public/bootstrap/js/jquery-2.2.1-New.js"></script-->

        <!--Popup Box open if select delete button and open popup and confirm than delete data-->

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>

        

        <!--if select edit survey and branding page than any change and popup box-->

        <script src="<?= base_url() ?>public/jquery-are-you-sure.js"></script>

        <!-- jQuery UI 1.11.4 -->

        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>

        <!--script src="https://code.jquery.com/jquery-1.12.4.min.js"></script-->

        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->

        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>-->

     

        <!--<script src="https://code.jquery.com/jquery-2.2.1.js"></script>-->

        <!--Card Depth JS-->

        <!--  JQuery Multi Select-->
        <link rel="stylesheet" type="text/css" href="<?= base_url('public/jquery-multiselect/css/jquery.multiselect.css');?>">
        <script src="<?= base_url('public/jquery-multiselect/js/jquery.multiselect.js');?>"></script>
        <!--  JQuery Multi Select-->
        

        

<!--Start of Tawk.to Script-->

<script type="text/javascript">

    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();

    (function(){

    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];

    s1.async=true;

    s1.src='https://embed.tawk.to/5ba8c97d9d44382222fbf0e6/default';

    s1.charset='UTF-8';

    s1.setAttribute('crossorigin','*');

    s0.parentNode.insertBefore(s1,s0);

    })();

</script>

<!--End of Tawk.to Script--> 

        

       

        

<style>

.main-header{

    position: fixed;

    width: 100%;

    //margin-top: 0 0 405px 0;

    //margin-top: -20px;

}

.sidebar{

    position: fixed;

    width: 230px;

    scroll-behavior: smooth;

    

}



.content{

    margin-top: 50px;

    min-margin-top: auto;

}



@media (min-width:576px) {

 .main-header{

    //position: fixed;

    width: 100%;

   // margin-top: 0 0 405px 0;

    //margin-top: 150px;

}

.sidebar{

    position: fixed;

    width: 230px;

    scroll-behavior: smooth;

    

}



.content{

    margin-top: 150px;

    min-margin-top: auto;

}

}

@media (min-width:768px) {

    .main-header{

   // position: fixed;

    width: 100%;

    //margin-top: 0 0 405px 0;

    //margin-top: -20px;

}

.sidebar{

   // position: fixed;

    width: 230px;

    scroll-behavior: smooth;

    

}



.content{

    margin-top: 50px;

    min-margin-top: auto;

}

}

@media (min-width:992px) {

    .main-header{

   // position: fixed;

    width: 100%;

    //margin-top: 0 0 405px 0;

    //margin-top: -20px;

}

.sidebar{

   // position: fixed;

    width: 230px;

    scroll-behavior: smooth;

    

}



.content{

    margin-top: 50px;

    min-margin-top: auto;

}

}



</style>

    </head>

    <body class="hold-transition skin-blue sidebar-mini" unload="beforeunload()">

        <div class="wrapper" style="height: auto;">

            <?php if ($this->session->flashdata('msg') != ''): ?>

                <div class="alert alert-warning flash-msg alert-dismissible">

                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                    <h4> Success!</h4>

                    <?= $this->session->flashdata('msg'); ?> 

                </div>

            <?php endif; ?> 



            <section id="container">

                <!--header start-->

                <header class="header white-bg">

                    <?php include('include/navbar.php'); ?>

                </header>

                <!--header end-->

                <!--sidebar start-->

                <aside>

                    <?php include('include/sidebar.php'); ?>

                </aside>

                <!--sidebar end-->

                <!--main content start-->

                <section id="main-content">

                    <div class="content-wrapper" style="min-height: 394px; padding:15px;">

                        <!-- page start-->

                        <?php $this->load->view($view); ?>

                        <!-- page end-->

                    </div>

                </section>

                <!--main content end-->

                <!--footer start-->

                <footer class="main-footer">

                    <strong>Copyright © 2019 <a href="#">Accu Feedback</a></strong> All rights

                    reserved.

                </footer>

                <!--footer end-->

            </section>



            <!-- /.control-sidebar -->

            <?php include('include/control_sidebar.php'); ?>



        </div>	





        <!-- Bootstrap 3.3.6 -->

        <script src="<?= base_url() ?>public/bootstrap/js/bootstrap.min.js"></script>

        <!-- AdminLTE App -->

        <script src="<?= base_url() ?>public/dist/js/app.min.js"></script>

        <!-- AdminLTE for demo purposes -->

        <script src="<?= base_url() ?>public/dist/js/demo.js"></script>

        <!-- page script -->



        <script type="text/javascript">

            $(".flash-msg").fadeTo(2000, 500).slideUp(500, function () {

                $(".flash-msg").slideUp(500);

            });

        </script>	

    </body>

</html>