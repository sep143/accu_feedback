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
    
    .carousel-parent-container {
        background-repeat: no-repeat; 
        margin-top: 65px; 
        height: 380px; 
        width: 710px; 
        margin-left:-17%;
        overflow: hidden;
    }

    .carousel-inner-style {
        top:20%!important;
        height: 380px!important; 
        width: 415px!important; 
        position: relative!important; 
        vertical-align: middle!important; 
        text-align: center!important; 
        overflow: visible!important;
    }

    img.carousel-inner-style-img {
        height: 272px!important; 
        width:372px!important; 
        /*top:5%!important; */
        left:50%!important; 
        /*left:16%;*/ 
        vertical-align: middle; 
        position: absolute;
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
//animation-direction: alternate;
animation: fade2 5s linear infinite;
/*animation: MoveLeft 10s linear infinite;*/
}

@keyframes MoveUpDown {
0% {
    bottom: -1px;
  }
  10% {
    bottom: 0px;
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
                        <a class="" href="<?=base_url()?>">
                            <img src="<?= base_url(); ?>image/web_logo.png" alt="logo" class="img-responsive navbar-brand" style="height: 54px; width: 240px;">
                            <!-- <h4 style="width:210px"><strong class="white" style="color:white; font-size: 22px;">Accu Feedback</strong></h4> -->
                            <!--<img src="<?= base_url(); ?>web/img/logo.png" alt="logo" class="img-responsive navbar-brand">-->
                        </a>
                    </div>
                    <div class="collapse navbar-collapse" id="navigation-example">
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="<?=base_url()?>#about">About</a>
                            </li>
                            <li>
                                <a href="<?=base_url()?>#features">Features</a>
                            </li>
                            <li>
                                <a href="<?=base_url()?>#screenshots">Screenshots</a>
                            </li>
                            <li>
                                <a href="<?=base_url()?>#price">Price</a>
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
                    

    <!--End of Popup box view on page -->
                        
                        
                        
                    </div>
                </div>
                
            </div>
        </div>
        <!-- End Header -->
    </div>
    <!-- About -->
    <section class="section" id="privacypolicy">
        <div class="container">
            <div class="section-heading">
                <h3 class="title">Privacy Policy</h3>
                <h6 class="description">This privacy policy has been compiled to better serve those who are concerned with how their 'Personally Identifiable Information' (PII) is being used online. PII, as described in US privacy law and information security, is information that can be used on its own or with other information to identify, contact, or locate a single person, or to identify an individual in context. Please read our privacy policy carefully to get a clear understanding of how we collect, use, protect or otherwise handle your Personally Identifiable Information in accordance with our website.</h6>

                <h5 class="title">What personal information do we collect from the people that visit our blog, website or app?</h5>
                <h6 class="description">When ordering or registering on our site, as appropriate, you may be asked to enter your name, email address, phone number or other details to help you with your experience.</h6>

                <h5 class="title">When do we collect information?</h5>
                <h6 class="description">We collect information from you when you register on our site or enter information on our site.</h6>

                <h5 class="title">How do we use your information?</h5>
                <h6 class="description">We may use the information we collect from you when you register, make a purchase, sign up for our newsletter, respond to a survey or marketing communication, surf the website, or use certain other site features in the following ways: </h6>
                <ul class="description">
                    <li>To quickly process your transactions.</li>
                </ul> 

                <h5 class="title">How do we protect your information?</h5>
                <h6 class="description">Your personal information is contained behind secured networks and is only accessible by a limited number of persons who have special access rights to such systems, and are required to keep the information confidential. In addition, all sensitive/credit information you supply is encrypted via Secure Socket Layer (SSL) technology.</h6>

                <h6 class="description">We implement a variety of security measures when a user places an order enters, submits, or accesses their information to maintain the safety of your personal information.</h6>

                <h6 class="description">All transactions are processed through a gateway provider and are not stored or processed on our servers.</h6>

                <h5 class="title">Do we use 'cookies'?</h5>
                <h6 class="description">Yes. Cookies are small files that a site or its service provider transfers to your computer's hard drive through your Web browser (if you allow) that enables the site's or service provider's systems to recognize your browser and capture and remember certain information. For instance, we use cookies to help us remember and process the items in your shopping cart. They are also used to help us understand your preferences based on previous or current site activity, which enables us to provide you with improved services. We also use cookies to help us compile aggregate data about site traffic and site interaction so that we can offer better site experiences and tools in the future.</h6>

                <h5 class="title">We use cookies to:</h5>
                <ul class="description">
                    <li>Compile aggregate data about site traffic and site interactions in order to offer better site experiences and tools in the future. We may also use trusted third-party services that track this information on our behalf.</li>
                </ul>


                <h6 class="description">You can choose to have your computer warn you each time a cookie is being sent, or you can choose to turn off all cookies. You do this through your browser settings. Since browser is a little different, look at your browser's Help Menu to learn the correct way to modify your cookies.</h6>

                <h6 class="description">If you turn cookies off, Some of the features that make your site experience more efficient may not function properly.It won't affect the user's experience that make your site experience more efficient and may not function properly.</h6>


                <h5 class="title">Third-party disclosure</h5>
                <h6 class="description">We do not sell, trade, or otherwise transfer to outside parties your Personally Identifiable Information unless we provide users with advance notice. This does not include website hosting partners and other parties who assist us in operating our website, conducting our business, or serving our users, so long as those parties agree to keep this information confidential. We may also release information when it's release is appropriate to comply with the law, enforce our site policies, or protect ours or others' rights, property or safety.</h6>

                <h6 class="description">However, non-personally identifiable visitor information may be provided to other parties for marketing, advertising, or other uses.</h6>


                <h5 class="title">Third-party links</h5>
                <h6 class="description">We do not include or offer third-party products or services on our website.</h6>

                <h5 class="title">We have implemented the following:</h5>
                <h6 class="description">We, along with third-party vendors such as Google use first-party cookies (such as the Google Analytics cookies) and third-party cookies (such as the DoubleClick cookie) or other third-party identifiers together to compile data regarding user interactions with ad impressions and other ad service functions as they relate to our website.</h6>

                <h5 class="title">Opting out:</h5>
                <h6 class="description">Users can set preferences for how Google advertises to you using the Google Ad Settings page. Alternatively, you can opt out by visiting the Network Advertising Initiative Opt Out page or by using the Google Analytics Opt Out Browser add on.</h6>

                <h5 class="title">California Online Privacy Protection Act</h5>
                <h6 class="description">CalOPPA is the first state law in the nation to require commercial websites and online services to post a privacy policy. The law's reach stretches well beyond California to require any person or company in the United States (and conceivably the world) that operates websites collecting Personally Identifiable Information from California consumers to post a conspicuous privacy policy on its website stating exactly the information being collected and those individuals or companies with whom it is being shared. - See more at: http://consumercal.org/california-online-privacy-protection-act-caloppa/#sthash.0FdRbT51.dpuf</h6>


                <h5 class="title">According to CalOPPA, we agree to the following:</h5>
                <h6 class="description">Users can visit our site anonymously.<br>
                Once this privacy policy is created, we will add a link to it on our home page or as a minimum, on the first significant page after entering our website.
                Our Privacy Policy link includes the word 'Privacy' and can easily be found on the page specified above.</h6>
                <h6 class="description">You will be notified of any Privacy Policy changes:
                    <ul>
                        <li>On our Privacy Policy Page</li>
                    </ul>
                </h6>    
                <h6 class="description">Can change your personal information:
                    <ul>
                        <li>By emailing us</li>
                    </ul>
                </h6>
                <h5 class="title">How does our site handle Do Not Track signals?</h5>
                <h6 class="description">We honor Do Not Track signals and Do Not Track, plant cookies, or use advertising when a Do Not Track (DNT) browser mechanism is in place.</h6>

                <h5 class="title">Does our site allow third-party behavioral tracking?</h5>
                <h6 class="description">It's also important to note that we do not allow third-party behavioral tracking</h6>

                <h5 class="title">Fair Information Practices</h5>
                <h6 class="description">The Fair Information Practices Principles form the backbone of privacy law in the United States and the concepts they include have played a significant role in the development of data protection laws around the globe. Understanding the Fair Information Practice Principles and how they should be implemented is critical to comply with the various privacy laws that protect personal information.</h6>

                <h5 class="title">In order to be in line with Fair Information Practices we will take the following responsive action, should a data breach occur:</h5>

                <h6 class="description">We will notify the users via in-site notification
                    <ul>
                        <li>Within 7 business days</li>
                    </ul>
                </h6>

                <h6 class="description">We also agree to the Individual Redress Principle which requires that individuals have the right to legally pursue enforceable rights against data collectors and processors who fail to adhere to the law. This principle requires not only that individuals have enforceable rights against data users, but also that individuals have recourse to courts or government agencies to investigate and/or prosecute non-compliance by data processors.</h6>

                <h5 class="title">CAN SPAM Act</h5>
                <h6 class="description">The CAN-SPAM Act is a law that sets the rules for commercial email, establishes requirements for commercial messages, gives recipients the right to have emails stopped from being sent to them, and spells out tough penalties for violations.</h6>

                <h5 class="title">We collect your email address in order to:</h5>
                <h6 class="description">
                    <ul>
                        <li>Process orders and to send information and updates pertaining to orders.</li>
                        <li>Send you additional information related to your product and/or service</li>
                    </ul>
                </h6>

                <h5 class="title">To be in accordance with CANSPAM, we agree to the following:</h5>
                <h6 class="description">
                    <ul>
                        <li>Not use false or misleading subjects or email addresses.</li>
                        <li>Identify the message as an advertisement in some reasonable way.</li>
                        <li>Include the physical address of our business or site headquarters.</li>
                        <li>Monitor third-party email marketing services for compliance, if one is used.</li>
                        <li>Honor opt-out/unsubscribe requests quickly.</li>
                        <li>Allow users to unsubscribe by using the link at the bottom of each email.</li>
                    </ul>
                </h6>

                <h5 class="title">If at any time you would like to unsubscribe from receiving future emails, you can email us at</h5>
                <h6 class="description">
                    <ul>
                        <li>Follow the instructions at the bottom of each email.</li>
                    </ul>
                    and we will promptly remove you from <b>ALL</b> correspondence. 
                </h6>

                <h5 class="title">Contacting Us</h5>
                <h6 class="description">If there are any questions regarding this privacy policy, you may contact us by emailing contact@accufeedback.com</h6>

                <h6 class="description">Last updated 01-08-2019</h6>
            </div>
        </div>
    </section>
    <!-- End about -->
    
    
    
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
           
            <p class="copyright"><i class=""></i> &copy; Accu Feedback 2019 <a class="pull-right" href="#privacypolicy">Privacy Policy</a></p>
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
    
    </script>
    
<script>
    
    
</script>

<!--AJAX to post data and save and call function use Contact US page-->
    <!-- END Skin switcher -->
</body>

</html>
