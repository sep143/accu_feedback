<!Doctype html>
<html lang="en">


<!-- Mirrored from www.upplanet.com/bighero/keylead-demo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 24 Sep 2018 13:02:46 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Material Design App Landing Template">
    <meta name="author" content="BigHero">
    <title>Accu Feedback </title>
    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">
    <!-- CSS Files -->
    <link href="<?= base_url(); ?>web/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>web/css/font-awesome.min.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>web/css/material-kit.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>web/css/owl.carousel.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>web/css/animate.min.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>web/css/style.css" rel="stylesheet" />
    <!-- favicon -->
    <link rel="icon" href="<?= base_url(); ?>image/app_logo.ico">
    
 <link href="<?= base_url(); ?>web/css/popup.css" rel="stylesheet" />   
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
    
    
    
    <!-- Colors -->
     <!--<link rel="stylesheet" href="<?= base_url(); ?>web/css/colors/green.css">--> 
    <!-- Skin switcher -->
    <!-- Manually link your desire skin -->
    <style type="text/css">
        
    .skins {
        position: fixed;
        top: 190px;
        left: -120px;
        transition: .3s ease-in-out;
        z-index: 1000;
    }
    
    .skins:hover {
        left: 0;
    }
    
    .skin-colors {
        list-style: none;
        padding: 20px;
        margin: 0;
        background-color: #fff;
        width: 120px;
        border: 1px solid #e7e7e7;
    }
    
    .skin-colors li {
        position: relative;
        display: inline-block;
        width: 32px;
        height: 32px;
        cursor: pointer;
        margin: -3px;
        line-height: 0;
        transition: .3s ease-in-out;
    }
    
    .skin-colors li:hover {
        opacity: .7;
    }
    
    .skin-colors li.active::before {
        content: "\f00c";
        font-family: FontAwesome;
        font-size: 20px;
        width: 32px;
        line-height: 32px;
        text-align: center;
        position: absolute;
        color: #fff;
    }
    
    .skin-toggler {
        position: absolute;
        display: inline-block;
        width: 50px;
        height: 50px;
        right: -49px;
        top: 0;
        background-color: #fff;
        font-size: 30px;
        text-align: center;
        line-height: 50px;
        color: #888;
        border: 1px solid #e7e7e7;
        border-left: 0;
    }
    
    .skin-toggler .fa {
        transform: rotate(30deg);
        -webkit-transition: 2s;
        -moz-transition: 2s;
        -ms-transition: 2s;
        -o-transition: 2s;
        transition: 2s;
        animation: gear 1s infinite;
    }

    .carousel-mac img {
        width: 620px;
        margin-left: 20px;
    }
    
    @keyframes gear {
        0% {
            transform: rotate(0deg)
        }
        100% {
            transform: rotate(360deg)
        }
    }
	
	.carousel-fade .item{
  opacity: 1;
  animation-name: cf3FadeInOut;
//  -webkit-transition: opacity 2s ease-in-out;
//  -moz-transition: opacity 2s ease-in-out;
//  -ms-transition: opacity 2s ease-in-out;
//  -o-transition: opacity 2s ease-in-out;
//  transition: opacity 2s ease-in-out;
//  left: 0 !important;
  animation-timing-function: ease-in-out;
animation-iteration-count: infinite;
//animation-duration: 5s;
-webkit-transition: animation-duration: 5s;
-moz-transition: animation-duration: 5s;
-o-transition: animation-duration: 5s;
/*animation-direction: alternate;*/
/*animation: MoveUpDown 10s linear infinite;*/
animation: fade2 5s linear infinite;
}

@keyframes MoveUpDown {
0% {
    bottom: -240px;
  }
  10% {
    bottom: 25px;
  }
}


@keyframes fade2
{
  0%   {opacity:0}
  /*33.333% { opacity: 1}
  66.666% { opacity: 1.5 }*/
  25% { opacity: 1.0}
  50% { opacity: 1.0 }
  75% { opacity: 1.0 }
  100% { opacity: 0}
}

.carousel-fade1 .item{
  opacity: 1;
  animation-name: cf3FadeInOut;
//  -webkit-transition: opacity 2s ease-in-out;
//  -moz-transition: opacity 2s ease-in-out;
//  -ms-transition: opacity 2s ease-in-out;
//  -o-transition: opacity 2s ease-in-out;
//  transition: opacity 2s ease-in-out;
//  left: 0 !important;
  animation-timing-function: ease-in-out;
animation-iteration-count: infinite;
//animation-duration: 5s;
-webkit-transition: animation-duration: 5s;
-moz-transition: animation-duration: 5s;
-o-transition: animation-duration: 5s;
//animation-direction: alternate;
animation: MoveUpDown1 10s linear infinite;
}

@keyframes MoveUpDown1 {
0% {
    bottom: -50px;
  }
  10% {
    bottom: 45px;
  }
}

</style>
</head>

<body id="up">
    <!-- Preloader -->
    <div id="preloader">
        <div class="spinner"></div>
    </div>
    <!-- Page hero -->
    <div class="" id="headers">
        <!--  Header -->
        <div class="header">
            <nav id="sticky-nav" class="navbar navbar navbar-custom sticky">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="" href="#up">
                            <img src="<?= base_url(); ?>image/web_logo.png" alt="logo" class="img-responsive navbar-brand" style="height: 54px; width: 240px;">
                            <!-- <h4 style="width:210px"><strong class="white" style="color:white; font-size: 22px;">Accu Feedback</strong></h4> -->
                            <!--<img src="<?= base_url(); ?>web/img/logo.png" alt="logo" class="img-responsive navbar-brand">-->
                        </a>
                    </div>
                    <div class="collapse navbar-collapse" id="navigation-example">
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="#about">About</a>
                            </li>
                            <li>
                                <a href="#features">Features</a>
                            </li>
                            <li>
                                <a href="#screenshots">Screenshots</a>
                            </li>
                            <li>
                                <a href="#price">Price</a>
                            </li>
<!--                            <li>
                                <a href="#team">Team</a>
                            </li>
                            <li>
                                <a href="#clients">Clients</a>
                            </li>-->
                            <li>
                                <a href="#contact">Contact</a>
                            </li>
                            <li>
                                <a href="<?= site_url('login'); ?>">Login</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div id="home" class="page-hero header-filter">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 wow slideInLeft">
                            <h1 class="title"> </h1>
                            <h1 class="title up-type-title">Capture feedback at <br>your <span class="animated-text"></span></h1>
                            <p class="p-details">
                                Powerful software to capture reviews through tablets, iPads and smart phones.<br>
                                Cloud dashboard with graphical reports, data analytics and alerts to track customer sentiments.
                            </p>
                            <div class="header-app-icons">
                                <ul style="margin-left: 10%;">
                                    <li><a href="#link" class="btn"><i class="fa fa-apple"></i></a></li>
                                    <li><a href="#link" class="btn"><i class="fa fa-android"></i></a></li>
                                    <!--<li><a href="#link" class="btn"><i class="fa fa-windows"></i></a></li>-->
                                </ul>
                            </div>
                            <a href="#btn" class="btn btn-info btn-md">
                                <i class="fa fa-paper-plane-o"></i> Start Now
                            </a>
                            <a class="btn btn-success btn-md" href="#contact"><i class="fa fa-bolt"></i> Sign up</a>
                            <!--<button type="button" class="btn btn-success btn-md" data-popup-open="popup-1" ><i class="fa fa-bolt"></i> Sign up</button>-->
<!--                            <a href="#" class="btn btn-success btn-md">
                                <i class="fa fa-bolt"></i> Sign up
                            </a>-->
                        </div>
                        <div class="col-md-6 text-center wow zoomIn">
                            <img src="<?= base_url(); ?>web/img/header-iphone.png" alt="phone" class="header-phone img-responsive">
                        </div>
                        
                        
                        <!--Start of Popup box view on page -->
    
                        <div class="popup card" data-popup="popup-1">
                            <div class="popup-inner">

                                <?php echo form_open(base_url('register'), 'class="form-horizontal"'); ?> 
                                <div class="card-contact">
                                    <!--<form id="contactForm" method="post" novalidate>-->
                                    <div class="header header-raised header-primary text-center">
                                        <h4 class="card-title">Create Account</h4>
                                    </div>
                                    <div class="card-layer"></div>
                                    <div class="content">
                                        <div id="success"></div>
                                        <div class="form-group label-floating">
                                            <label class="control-label">First name <i class="help-block text-danger"></i></label>
                                            <input type="text" name="fname" id="name" class="form-control" required data-validation-required-message="Please enter your name.">
                                        </div>
                                        <div class="form-group label-floating">
                                            <label class="control-label">Last name <i class="help-block text-danger"></i></label>
                                            <input type="text" name="lname" id="name" class="form-control" required data-validation-required-message="Please enter your name.">
                                        </div>
                                        <div class="form-group label-floating">
                                            <label class="control-label">Email ID <i class="help-block text-danger"></i></label>
                                            <input type="email" name="email" id="email" class="form-control" required data-validation-required-message="Please enter your email address." />
                                        </div>
                                        <div class="form-group label-floating">
                                            <label class="control-label">Mobile No. <i class="help-block text-danger"></i></label>
                                            <input type="number" name="mobile" id="email" class="form-control" required data-validation-required-message="Please enter your email address." />
                                        </div>
                                        <div class="form-group label-floating">
                                            <label class="control-label">Password<i class="help-block text-danger"></i></label>
                                            <input type="password" name="password" id="email" class="form-control" required data-validation-required-message="Please enter your email address." />
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                            <div class="">
                                                <?php if(!empty($this->session->flashdata('msg'))) {?>
                                                <label style="color:green;">
                                                    <?= $this->session->flashdata('msg'); ?>
                                                    
                                                    <!--<input type="checkbox" name="optionsCheckboxes"> I'm not a robot-->
                                                </label>
                                                <?php } 
                                                if(validation_errors()) { ?>
                                                <div class="alert alert-danger">
                                                    <?php echo validation_errors(); ?>
                                                </div>
                                                <?php } ?>
                                            </div>
                                            </div>
                                            <div class="col-md-6">
                                                <button type="submit" class="btn btn-primary pull-right">Submit</button>
                                                <button type="button" data-popup-close="popup-1" class="btn btn-danger pull-right">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!--</form>-->
                                </div>
                                <?php echo form_close(); ?>
                                <!--p><a data-popup-close="popup-1" href="#">Close</a></p-->
                                <a class="popup-close" data-popup-close="popup-1" href="#">x</a>
                            </div>
                        </div>
        </div>

    <!--End of Popup box view on page -->
                        
                        
                        
                    </div>
                </div>
                
            </div>
        </div>
        <!-- End Header -->
    </div>
    <!-- About -->
    <section class="section" id="about">
        <div class="container">
            <div class="section-heading text-center">
                <h2 class="title">About Accu Feedback</h2>
                <h5 class="description">Accu Feedback lets you capture responses to surveys from your customers or visitors from a tablet, iPad or smart phone. Surveys are created online and appears automatically on all connected devices. The collected data is synced and you get graphical reports and insights in real-time..</h5>
            </div>
        </div>
    </section>
    <!-- End about -->
    <!-- Features -->
    <section class="section features bg-gray" id="features">
        <div class="container">
            <div class="section-heading text-center">
                <h2 class="title text-center">Making feedback collection a pleasure</h2>
                <br><p>Accu Feedback is designed to make it easier for you to collect and analyze feedback.</p>
                <br>
            </div>
            <div>
                <div class="tab-content tab-space">
                    <!-- tab mobile -->
                    <div class="tab-pane active" id="/mobile">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="info info-horizontal">
                                    <div class="icon icon-primary">
                                        <i class="fa fa-dashboard"></i>
                                    </div>
                                    <div class="description">
                                        <h4 class="info-title">Stunning Design</h4>
                                        <p>Impress your customers with a beautiful and easy to use application</p>
                                    </div>
                                </div>
                                <div class="info info-horizontal">
                                    <div class="icon icon-primary">
                                        <i class="fa fa-sliders"></i>
                                    </div>
                                    <div class="description">
                                        <h4 class="info-title">Easy Setup</h4>
                                        <p>Setting up devices and surveys is as easy as it can get</p>
                                    </div>
                                </div>
                                <div class="info info-horizontal">
                                    <div class="icon icon-primary">
                                        <i class="fa fa-pie-chart"></i>
                                    </div>
                                    <div class="description">
                                        <h4 class="info-title">Designed For Usability</h4>
                                        <p>Our UX experts have worked hard on building a product that is powerful and easy to use.</p>
                                    </div>
                                </div>
                                <div class="info info-horizontal">
                                    <div class="icon icon-primary">
                                        <i class="fa fa-line-chart"></i>
                                    </div>
                                    <div class="description">
                                        <h4 class="info-title">Detailed Reporting</h4>
                                        <p>Analyze customer responses quickly with our instant reporting tools. You can also view individual responses and comments.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info info-horizontal">
                                    <div class="icon icon-primary">
                                        <i class="fa fa-cogs"></i>
                                    </div>
                                    <div class="description">
                                        <h4 class="info-title">Centralized Management</h4>
                                        <p>Manage all your devices and surveys from a single admin panel</p>
                                    </div>
                                </div>
                                <div class="info info-horizontal">
                                    <div class="icon icon-primary">
                                        <i class="fa fa-desktop"></i>
                                    </div>
                                    <div class="description">
                                        <h4 class="info-title">Custom Branding</h4>
                                        <p>Customize the application to show your brand and match your corporate theme.</p>
                                    </div>
                                </div>
                                <div class="info info-horizontal">
                                    <div class="icon icon-primary">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <div class="description">
                                        <h4 class="info-title">Instant Notifications</h4>
                                        <p>Set up instant email notifications when a customer response matches predefined criterions.</p>
                                    </div>
                                </div>
                                <div class="info info-horizontal">
                                    <div class="icon icon-primary">
                                        <i class="fa fa-commenting-o"></i>
                                    </div>
                                    <div class="description">
                                        <h4 class="info-title">Comments</h4>
                                        <p>Let your customers tell you how they loved the experience or how you can improve it</p>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-md-4">
                                
                                <div class="info info-horizontal">
                                    <div class="icon icon-primary">
                                        <i class="fa fa-signal"></i>
                                    </div>
                                    <div class="description">
                                        <h4 class="info-title">Works Offline</h4>
                                        <p>The feedback collection app works even when there is no active internet connection</p>
                                    </div>
                                </div>
                                <div class="info info-horizontal">
                                    <div class="icon icon-primary">
                                        <i class="fa  fa-file-text"></i>
                                    </div>
                                    <div class="description">
                                        <h4 class="info-title">Multiple question types</h4>
                                        <p>Build your survey the way it should be. With a wide range of question types, we have you covered for all your needs.</p>
                                    </div>
                                </div>
                                <div class="info info-horizontal">
                                    <div class="icon icon-primary">
                                        <i class="fa fa-tablet"></i>
                                    </div>
                                    <div class="description">
                                        <h4 class="info-title">Supports Android & iOS</h4>
                                        <p>Our application works seamlessly on Android and iOS tablets and supports unlimited number of devices.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end tab mobile -->
                                       
                    <!-- end tab desktop -->
                </div>
            </div>
        </div>
        <!-- End container -->
    </section>
    <!--Tablet and Desktop view --><hr>
    <section class="section features bg-gray" id="screenshots">
        <div class="container">
            <div class="col-md-11 ection-heading text-center">
                <h2 class="title text-center">Craftsmanship at its best. Built to please.</h2>
                <ul class="nav nav-pills nav-pills-primary">
                    <li class="active"><a href="#tablet" data-toggle="tab">Tablet</a></li>
                    <li><a href="#admin" data-toggle="tab">Admin Panel</a></li>
                </ul>
                <br>
            </div>
            <div>
                <div class="tab-content tab-space">
                    <!-- tab mobile -->
                    <div class="tab-pane active" id="tablet">
                        <div class="row">
                            <div class="col-md-12 center-block" style="max-height: 470px; height: auto;">
                                <div class="" data-ride="carousel" data-interval="3000" style="background-image: url('<?= base_url() ?>web/img/admin/tab/tab3.PNG'); background-repeat: no-repeat; margin-left: 150px; margin-top: 65px;">
                                    <div class="carousel slide carousel-fade carousel-inner" style="">
                                        <div class="item active" >
                                            <img src="<?= base_url(); ?>web/img/admin/tab/1.png" alt="" style="margin-top: -13%; margin-left: -10%;">
                                        </div>
                                        <div class="item" >
                                            <img src="<?= base_url(); ?>web/img/admin/tab/2.png" alt="" style="margin-top: -13%; margin-left: -10%;">
                                        </div>
										<div class="item" >
                                            <img src="<?= base_url(); ?>web/img/admin/tab/3.png" alt="" style="margin-top: -13%; margin-left: -10%;">
                                        </div>
										<div class="item" >
                                            <img src="<?= base_url(); ?>web/img/admin/tab/4.png" alt="" style="margin-top: -13%; margin-left: -10%;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end tab mobile -->
                    <!-- tab tablet -->
                    <div class="tab-pane" id="admin">
                        <div class="row">
                        
                            <div class="col-md-12">
                                <div class="">
								<div class="img-responsive feature-img" data-ride="carousel" data-interval="3000" style="background-image: url('<?= base_url() ?>web/img/adminLapy.PNG'); background-repeat: no-repeat; width:96%; padding-top:2.5%;padding-bottom:20%;">    

                                <div class="carousel slide carousel-fade carousel-inner carousel-mac" style="padding-left:250px; padding: 20px; margin-left: 15%">
                                    <div class="item active" style="margin-top:12%">
                                        <img src="<?= base_url(); ?>web/img/admin/1.png" alt="" >
                                    </div> 
                                    <div class="item" style="margin-top:12%">
                                        <img src="<?= base_url(); ?>web/img/admin/2.png" alt="" >
                                    </div>
                                    <div class="item" style="margin-top:12%">
                                        <img src="<?= base_url(); ?>web/img/admin/3.png" alt="" >
                                    </div>
                                    <div class="item" style="margin-top:12%">
                                        <img src="<?= base_url(); ?>web/img/admin/4.png" alt="">
                                    </div>
                                    <div class="item" style="margin-top:12%">
                                        <img src="<?= base_url(); ?>web/img/admin/5.png" alt="" >
                                    </div>
                                    <div class="item" style="margin-top:12%">
                                        <img src="<?= base_url(); ?>web/img/admin/6.png" alt="">
                                    </div>
                                    <div class="item" style="margin-top:12%">
                                        <img src="<?= base_url(); ?>web/img/admin/7.png" alt="">
                                    </div>
									<div class="item" style="margin-top:12%">
                                        <img src="<?= base_url(); ?>web/img/admin/8.png" alt="">
                                    </div>
									<div class="item" style="margin-top:12%">
                                        <img src="<?= base_url(); ?>web/img/admin/9.png" alt="">
                                    </div>
									<div class="item" style="margin-top:12%">
                                        <img src="<?= base_url(); ?>web/img/admin/10.png" alt="">
                                    </div>
                                    <div class="item" style="margin-top:12%">
                                        <img src="<?= base_url(); ?>web/img/admin/11.png" alt="">
                                    </div>
                                    <div class="item" style="margin-top:12%">
                                        <img src="<?= base_url(); ?>web/img/admin/12.png" alt="">
                                    </div>
                                    <div class="item" style="margin-top:12%">
                                        <img src="<?= base_url(); ?>web/img/admin/13.png" alt="">
                                    </div>

                                </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End container -->
    </section>
    <!-- End features -->
    <!-- Price -->
    <section class="section" id="price">
        <div class="pricing section-image">
            <div class="container">
                <div class="section-heading text-center">
                    <h2 class="title">Select Your Perfect Plan</h2>
                    <h5 class="description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio blanditiis similique deleniti qui error in.</h5>
                </div>
                <div class="section-space"></div>
                <div class="row">
                    <!-- price 1 -->
                    <div class="col-sm-4 text-center">
                        <div class="card card-pricing">
                            <div class="content">
                                <h6 class="category">Free</h6>
                                <h2 class="card-title"><small><i class="fa fa-rupee"></i></small>&nbsp;0<small>/mo</small></h2>
                                <ul>
                                    <li><b>30</b> Days Active</li>
                                    <li>One Device</li>
                                    <li>Unlimited Responses</li>
                                    <li>Centralized Reporting</li>
                                    <li>Custom Branding</li>
                                    <li>Data Export</li>
                                    <li>&nbsp;</li>
                                </ul>
                                <a href="#contact" class="btn btn-primary btn-round btn-get-start">
                                Get Started
                            </a>
                            </div>
                        </div>
                    </div>
                    <!-- End price 1 -->
                    <!-- price 2 -->
                    <div class="col-sm-4 text-center">
                        <div class="card card-pricing card-raised">
                            <div class="content content-primary best-price">
                                <h6 class="category text-info">Standard</h6>
                                <h2 class="card-title"><small><i class="fa fa-rupee"></i></small>&nbsp;1000<small>/mo</small></h2>
                                <ul>
                                    <li><b>30</b> Days Active</li>
                                    <li>One Device</li>
                                    <li>Unlimited Responses</li>
                                    <li>Centralized Reporting</li>
                                    <li>Custom Branding</li>
                                    <li>Custom Survey Form</li>
                                    <li>Data Export</li>
                                </ul>
                                <a href="#contact" class="btn btn-white btn-round btn-get-start">
                                Get Started
                            </a>
                            </div>
                        </div>
                    </div>
                    <!-- End price 2-->
                    <!-- price 3 -->
                    <div class="col-sm-4 text-center">
                        <div class="card card-pricing">
                            <div class="content">
                                <h6 class="category text-info">Premium</h6>
                                <h2 class="card-title"><small><i class="fa fa-rupee"></i></small>&nbsp;1500<small>/mo</small></h2>
                                <ul>
                                    <li><b>30</b> Days Active</li>
                                    <li>Multiple Devices</li>
                                    <li>Unlimited Responses</li>
                                    <li>Centralized Reporting</li>
                                    <li>Custom Branding</li>
                                    <li>Custom Survey Form</li>
                                    <li>Data Export</li>
                                </ul>
                                <a href="#contact" class="btn btn-success btn-round btn-get-start">
                                Get Started
                            </a>
                            </div>
                        </div>
                    </div>
                    <!--  End price 3 -->
                </div>
            </div>
        </div>
    </section>
    <!-- End price -->
    <!-- Contact -->
    <section class="section section-image" id="contact">
        <div class="contact-us">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <h2 class="title">Get in Touch</h2>
                        <p class="description">
                            We will reply to each and every email. If you have projects feel free to call us anytime .
                        </p>
                        <div class="info info-horizontal">
                            <div class="icon icon-primary">
                                <i class="fa fa-map-marker"></i>
                            </div>
                            <div class="description">
                                <h4 class="info-title">Find our office</h4>
                                <p>
                                    733, 7th floor, 
                                    <br>Mangalam Fun Square, 
                                    <br>Durga Nursery Road, Udaipur,
                                    <br>Rajasthan(IND) 313001
                                </p>
                            </div>
                        </div>
                        <div class="info info-horizontal">
                            <div class="icon icon-primary">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="description">
                                <h4 class="info-title">Contact us</h4>
                                <p> 
                                    +91 - (759) 734-9954 , (988) 776-8393
                                    <br> appspundit2014@gmail.com
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-md-offset-2">
                        <div class="card card-contact">
                           <?php echo form_open(base_url('mail'), 'class="form-horizontal"'); ?> 
                            
                                <div class="header header-raised header-primary text-center">
                                    <h4 class="card-title">Contact Us</h4>
                                </div>
                                <div class="card-layer"></div>
                                <?php if(validation_errors()){ ?>
                                    <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <?= validation_errors(); ?>
                                    </div>
                                    <?php }?>
                                <div class="content">
                                    <div id="success"></div>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Name<i class="help-block text-danger"></i></label>
                                        <input type="text" name="name" id="name" class="form-control" required data-validation-required-message="Please enter your name.">
                                    </div>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Email address <i class="help-block text-danger"></i></label>
                                        <input type="email" name="email" id="email" class="form-control" required data-validation-required-message="Please enter your email address." />
                                    </div>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Mobile No. <i class="help-block text-danger"></i></label>
                                        <input type="number" name="mobile" id="mobile" class="form-control" required data-validation-required-message="Please enter your Mobile No." />
                                    </div>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Your message <i class="help-block text-danger"></i></label>
                                        <textarea name="message" class="form-control" rows="6" id="message" required data-validation-required-message="Please enter a message."></textarea>
                                    </div>
                                    <?php if(!empty($this->session->flashdata('mail_msg'))){ ?>
                                    <div class="alert alert-success flash-msg alert-dismissible">
                                        <?= $this->session->flashdata('mail_msg'); ?>
                                    </div>
                                    <?php } ?>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="optionsCheckboxes"> I'm not a robot
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="submit" class="btn btn-primary pull-right">Send Message</button>
                                        </div>
                                    </div>
                                </div>
                            <!--</form>-->
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End contact -->
    
    <!-- Footer -->
    <!-- <footer class="footer section"> -->
    <footer class="footer">
        <div class="container footer-widget">
           
            <p class="copyright"><i class=""></i> &copy; Accu Feedback 2018</p>
        </div>
    </footer>
    <!-- ./Footer section -->
    <!-- End footer -->
    <!--   Core JS Files   -->
    <script src="<?= base_url(); ?>web/js/jquery.min.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>web/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>web/js/material.min.js"></script>
    <!-- Jquery easing -->
    <script type="text/javascript" src="<?= base_url(); ?>web/js/jquery.easing.1.3.min.js"></script>
    <!-- Plugin For Google Maps -->
    <!-- Typing text -->
    <script src="<?= base_url(); ?>web/js/typed.min.js" type="text/javascript"></script>
    <!-- sticky -->
    <script src="<?= base_url(); ?>web/js/jquery.sticky.js" type="text/javascript"></script>
    <!-- owl  carousel -->
    <script src="<?= base_url(); ?>web/js/owl.carousel.min.js" type="text/javascript"></script>
    <!-- contact form -->
    <script type="text/javascript" src="<?= base_url(); ?>web/js/jqBootstrapValidation.js"></script>
    <!-- WOw js -->
    <script type="text/javascript" src="<?= base_url(); ?>web/js/wow.min.js"></script>
    <!-- <script src="<?= base_url(); ?>web/js/modernizr.js" type="text/javascript"></script> -->
    <script src="<?= base_url(); ?>web/js/main.js" type="text/javascript"></script>
    <!-- Color Switcher -->
    <script type="text/javascript">
    $(function() {

        $("head").append('<link id="skin-css" rel="stylesheet">');

        $('.skin-colors li').on('click', function() {
            $('.skins li').removeClass('active');
            $(this).addClass('active');
            $('#skin-css').attr('href', '<?= base_url(); ?>web/css/colors/' + $(this).data('skin') + '.css');
        });

    });
    </script>
    
<script>
    $(function() {
    //----- OPEN
    $('[data-popup-open]').on('click', function(e) {
    var targeted_popup_class = jQuery(this).attr('data-popup-open');
    $('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);
    e.preventDefault();
    });
    //----- CLOSE
    $('[data-popup-close]').on('click', function(e) {
    var targeted_popup_class = jQuery(this).attr('data-popup-close');
    $('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);
    e.preventDefault();
    });
    });
    
</script>

<!--AJAX to post data and save and call function use Contact US page-->
<script>
    $(function(){
        $("a.btn-get-start").on('click',function(){
            // $("input#name").focus();
            $('input[name="name"]').get(0).focus();
        });



        $(".alert-success").fadeOut("slow");

        $('#ContactSubmit').submit(function(){
            dataString = $("#ContactSubmit").serialize();
            //var name = $('#name').val();
            alert(dataString);
            $.ajax({
                url:'<?= site_url('mail'); ?>',
                type:'post',
                data:{dataString},
                success:function(data){
                    alert('update');
                }
            });
            
        });
    });
</script>
    <!-- END Skin switcher -->
</body>

</html>
