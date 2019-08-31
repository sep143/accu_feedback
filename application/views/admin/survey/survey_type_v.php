<?php if ($view) { ?>



    <?php if ($view == 1) { ?>

        <!--Star -->



        <!--<div class="box-body">-->

            <div class="form-group">

                <center><img src="<?= base_url(); ?>image/survey/star.png" alt="Star" width="60%"></center>

            </div>

        <!--</div>-->



    <?php } else if ($view == 2) { ?>

<!--        <div class="box-body">-->

            <div class="" >

                <div><div id="optionTextView<?= $t_id; ?>1" style="float: left; width: 40%;">&nbsp;</div>

                    <div style="float: left; width: 60%;"><img src="<?= base_url(); ?>image/survey/star.png" alt="Star" width="80%" align="middle"></div>

                </div>

            </div>

            

        <!--</div>-->



    <?php } else if ($view == 3) { ?>

        <!--Smile Imoji -->

        <!--<div class="box-body">-->

            <div class="form-group">

                <center><img src="<?= base_url(); ?>image/survey/smiley.png" alt="Star" width="60%"></center>

            </div>

        <!--</div>-->



    <?php } else if ($view == 4) { ?>

        <!--<div class="box-body">-->

            <div class="">

                <div><div id="optionTextView<?= $t_id; ?>1" style="float: left; width: 45%;">&nbsp;</div>

                    <!-- <div style="float: left; width: 60%;"><img src="<?= base_url(); ?>image/survey/multismiley.png" alt="MultiStar" width="70%" align="middle"></div> -->
                    
                    <div style="float: left; width: 55%;"><img src="<?= base_url(); ?>image/survey/smiley.png" alt="MultiStar" width="100%" align="middle"></div>

                </div>

            </div>

            

        <!--</div>-->

    <?php } else if ($view == 5) { ?>

        <div class="">

            <div><span id="optionTextView<?= $t_id; ?>1">&nbsp;</span></div>

            <div class=""><hr style="height:1px;border:none;color:#333;background-color:#333;" /></div>

        </div>

    <?php } else if ($view == 6) { ?>

        <!--NPS Rating-->



        <!--<div class="box-body">-->

            <div class="form-group">

                <center><img src="<?= base_url(); ?>image/survey/nps.png" alt="Star" width="95%"></center> 

            </div>

        <!--</div>-->



    <?php } else if ($view == 7) { ?>

        <style>

            .option1{

    border: 1px solid #63b37a;

    color: #63b37a;

    border-radius: 3px;

    padding: 6px;

    margin: 10px;

    width: 90%;

    float: left;

    text-align: center;

    }

        </style>

        <div class="">

            <div class="col-md-6">

                <div class="option1" style="border-color: rgb(106, 193, 131); background-color: rgb(106, 193, 131); color: rgb(255, 255, 255);" id="optionTextView<?= $t_id; ?>1">&nbsp;</div>

            </div>

        </div>

    <?php } else if ($view == 8) { ?>

        <style>

            .option1{

    border: 1px solid #63b37a;

    color: #63b37a;

    border-radius: 3px;

    padding: 6px;

    margin: 10px;

    width: 90%;

    float: left;

    text-align: center;

    }

        </style>

        <div class="">

            <div class="col-md-6">

                <div class="option1" style="border-color: rgb(106, 193, 131); background-color: rgb(106, 193, 131); color: rgb(255, 255, 255);" id="optionTextView<?= $t_id; ?>1">&nbsp;</div>

            </div>

        </div>

    <?php } else if ($view == 9) { ?>

        

         <style>

            .option9{

    border: 1px solid #63b37a;

    color: #63b37a;

    border-radius: 3px;

    padding: 6px;

    margin: 10px;

    width: 95%;

    float: left;

    text-align: center;

    }

        </style>

        <div class="">

            <div class="col-md-12">

                <div class="option9" style="border-color: rgb(106, 193, 131); background-color: rgb(106, 193, 131); color: rgb(255, 255, 255);" id="optionTextView<?= $t_id; ?>1">&nbsp;</div>

            </div>

        </div>

    <?php } else if ($view == 10) { ?>

         <style>

            .option9{

    border: 1px solid #63b37a;

    color: #63b37a;

    border-radius: 3px;

    padding: 6px;

    margin: 10px;

    width: 95%;

    float: left;

    text-align: center;

    }

        </style>

        <div class="">

            <div class="col-md-12">

                <div class="option9" style="border-color: rgb(106, 193, 131); background-color: rgb(106, 193, 131); color: rgb(255, 255, 255);" id="optionTextView<?= $t_id; ?>1">&nbsp;</div>

            </div>

        </div>

    <?php } else if ($view == 11) { ?>

        <!--Yes/No box-->

        <!--<div class="box-body">-->

            <div class="form-group"> 

                <center><img src="<?= base_url(); ?>image/survey/polar.png" alt="Star" width="30%"></center>

            </div>

        <!--</div>-->



    <?php } else if ($view == 12) { ?>

        <style>

            .option9{

    border: 1px solid #63b37a;

    color: #63b37a;

    border-radius: 3px;

    padding: 6px;

    margin: 5px;

    width: auto;

    float: left;

    text-align: center;

    }

        </style>

       <div class="">

           <div class="col-md-6">

               <span id="optionTextView<?= $t_id; ?>1"></span>

           </div>

            <div class="col-md-6">

                <!--<div class="option9 columnTextView<?= $t_id?>1" style="border-color: rgb(106, 193, 131); background-color: rgb(106, 193, 131); color: rgb(255, 255, 255);">&nbsp;<div class="mDivCol-<?= $t_id; ?>"></div></div>-->

            </div>

        </div>

    <?php } else if ($view == 13) { ?>

        <!--Comment box-->



        <!--<div class="box-body">-->

            <div class="form-group">

                <center>

                    <div class="" style="margin:15px; border: solid 1px; height: 100px; color: #63b37a; "></div>

                </center>

            </div>

        <!--</div>-->



    <?php } else if ($view == 14) { ?>

        <!--Text box-->



        <!--<div class="box-body">-->

            <div class="form-group">

                <center>

                    <div class="" style="margin:10px; border: solid 1px; height: 30px; color: #63b37a; "></div>

                </center>

            </div>

        <!--</div>-->



    <?php } else if ($view == 15) { ?>

        <!--Number box-->



        <!--<div class="box-body">-->

            <div class="form-group">

                <center>

                    <div class="" style="margin:10px; border: solid 1px; height:30px; width: 150px; color: #63b37a; "></div>

                </center>

            </div>

        <!--</div>-->



    <?php } ?>





<?php

} else {

    

}

?>