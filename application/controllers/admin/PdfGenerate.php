<?php

defined('BASEPATH')OR exit('No direct script access allowed');



class PdfGenerate extends CI_Controller{

    function __construct()

    { 

        parent::__construct();

        $this->pay_tax['for'] = 5;

        $this->load->library('pdf');

        $this->load->model('admin/Paymentgateway_model', 'Paymentgateway_model');

    } 

    

    function index() {

    $this->load->library('Pdf');

    $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);

    $pdf->SetTitle('Pdf Example');

    $pdf->SetHeaderMargin(30);

    $pdf->SetTopMargin(20);

    $pdf->setFooterMargin(20);

    $pdf->SetAutoPageBreak(true);

    $pdf->SetAuthor('Author');

    $pdf->SetDisplayMode('real', 'default');

    $pdf->Write(5, 'CodeIgniter TCPDF Integration');

    $pdf->Output('pdfexample.pdf', 'I'); 

    

    $j_date = $this->session->userdata('joining_date');

        $duration_check = $this->session->userdata('duration');

        $current = (new DateTime())->format('Y-m-d');

        //echo "<script>alert('check);</script>".$now_date = date('Y-m-d', strtotime($j_date.'+15 days'));

        if($duration_check == 'demo'){

            $now_date = date('Y-m-d', strtotime($j_date.'+15 days'));

        }elseif($duration_check == 'month'){

            $now_date = date('Y-m-d', strtotime($j_date.'+30 days'));

        }elseif($duration_check == 'annual'){

            $now_date = date('Y-m-d', strtotime($j_date.'+365 days'));

        }

        if($current < $now_date){



        }else{

            redirect(site_url('admin/dashboard'));

        }

    }

    

 

 function pdf($id = 0){

     if(($this->session->userdata('role_id')==2) or ($this->session->userdata('m_role_id')==11) ){

         $admin_id = $this->session->userdata('admin_id');

     $order_data = $this->Paymentgateway_model->get_details($id, $admin_id);

     if($order_data){

         $tax = ($order_data->TXN_AMOUNT*$this->pay_tax['for'])/100;

         $price = $order_data->TXN_AMOUNT - $tax;

         $discount = $order_data->discount;

         $gross_amt = $tax+$price+$discount;

            // set some language-dependent strings (optional)

            $pdf = new Pdf('P','A4', TRUE, 'UTF-8', false);

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

       // set document information

       $pdf->SetCreator(PDF_CREATOR);

       $pdf->SetAuthor('Nicola Asuni');

       $pdf->SetTitle('Accu Feedback');

       $pdf->SetSubject('TCPDF Tutorial');

       $pdf->SetKeywords('TCPDF, PDF, example, test, guide');



       //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));

       $pdf->setFooterData(array(0,64,0), array(0,64,128));



       // set header and footer fonts

       $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

       $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));



       // set default monospaced font

       $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);



       // set margins

       //$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

       //$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);

       $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);



       // set auto page breaks

       $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);



       // set image scale factor

       $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);



       // set some language-dependent strings (optional)

       if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {

           require_once(dirname(__FILE__).'/lang/eng.php');

           $pdf->setLanguageArray($l);

       }

           //$pdf->AddPage('P', 'A4');

           $pdf->AddPage();



           //$pdf->Cell(0, 0, 'A4 PORTRAIT', 1, 1, 'C');

           // $subtable = '<table border="1" cellspacing="6" cellpadding="4"><tr><td>a</td><td>b</td></tr><tr><td>c</td><td>d</td></tr></table>';

           $html = '<table WIDTH="600" height="100%" cellspacing="0">

                        <tr><td></td></tr>

                        <tr>

                            <td width="400">&nbsp;&nbsp;&nbsp;<img src="image/app_logo.png" style="width:auto; height:100px;"></td>

                            <td width="200" align="center"><h3><b>Invoice</b></h3>

                               <table border="0" cellspacing="2" cellpadding="0" align="left" style="font-size:13px;">

                                <tbody align="">

                                    <tr><td>Invoice No.</td><td> : '.$order_data->ORDER_ID .'</td></tr>

                                    <tr><td>Invoice Date</td><td> : '. date('d-M-Y', strtotime($order_data->TXNDATE)).'</td></tr>

                                    <tr><td>Payment Mode</td><td> : '.$order_data->mode.'</td></tr>

                                </tbody>

                            </table> 

                            </td>

                        </tr>

                    </table>&nbsp;<br><br>

                    <table border="1" cellspacing="0" cellpadding="5">

                        <thead>

                            <tr style="background-color:gray; color:white;" align="">

                                <th>Our Info : </th>

                                <th>Customer : </th>

                            </tr>

                        </thead>

                        <tbody>

                            <tr style="color:#565656; font-weight: lighter; font-size: 13px;">

                                <td><h4 >Accu Feedback</h4>

                                    <p>733, 7th floor, 

                                    Mangalam Fun Square, 

                                    Durga Nursery Road, Udaipur, 

                                    <br>Rajasthan(IN) 313001</p>

                                    <lable>Email : appspundit2014@gmail.com</lable>

                                    <lable><br>Mobile : +91 - (759) 734-9954 , (988) 776-8393 </lable>

                                </td>

                                <td><h4>'.$order_data->name.'</h4>

                                    <lable>Owner Name : '.$order_data->first_name.' '.$order_data->last_name.'</lable>

                                    <p>'.$order_data->r_address.'<br>'.$order_data->r_city.', '.$order_data->r_state.'<br>'.$order_data->r_country.' - '.$order_data->r_pin_code.'</p>

                                    <lable>Email : '.$order_data->email.'</lable>

                                    <lable><br>Mobile : '.$order_data->mobile.'</lable>

                                </td>

                            </tr>

                        </tbody>

                    </table>&nbsp;<br><br>

                    <table width="670" border="0" cellspacing="0" cellpadding="5" style="background-color:#f4f4f4">

                        <thead>

                            <tr style="background-color:gray; color:white;" align="">

                                <th width="320">Description</th>

                                <th width="80">Price</th>

                                <th width="80">TAX</th>

                                <th width="80">Discount</th>

                                <th width="110">Total</th>

                            </tr>

                        </thead>

                        <tbody>

                            <tr style="color:#272727; font-weight: lighter; font-size: 13px;">

                                <td width="320">Account Update Bill is : '.$order_data->productinfo.'</td>

                                <td width="80">'.$price.'</td>

                                <td width="80">'.$tax.'</td>

                                <td width="80">'.$discount.'</td>

                                <td width="110">'.$gross_amt.'.00</td>

                            </tr>

                        </tbody>

                    </table>&nbsp;<br>

                    <table style="border: 1px solid #ccc8c8">

                        <tr>

                            <td></td>

                            <td>

                                <table cellspacing="0" cellpadding="4" style="background-color:#f4f4f4; color:#272727; font-weight: lighter; font-size: 13px;">

                                    <tbody>

                                        <tr>

                                            <td>Summary : </td><td></td>

                                        </tr>

                                        <tr>

                                            <td>Sub Total :</td><td>'.$price.'</td>

                                        </tr>

                                        <tr>

                                            <td>Tax :</td><td>'.$tax.'</td>

                                        </tr>

                                        <tr>

                                            <td>Discount :</td><td>'.$discount.'</td>

                                        </tr>

                                        <tr style="background-color:gray; color:white; ">

                                            <td>Total Amount :</td><td>'.$gross_amt.'.00</td>

                                        </tr>

                                    </tbody>

                                </table>

                            </td>

                        </tr>

                    </table>

                    <table style="color:#272727; font-weight: lighter; font-size: 13px;">

                        <tr>

                            <td></td>

                            <td align="center">

                                <h4>Authorized person</h4>

                                <img src="image/app_logo.png" style="width:auto; height:70px;">

                                <lable><br>(Accu Feedback)</lable>

                                <lable><br>Sales Person</lable>

                            </td>

                        </tr>

                    </table><hr>

                    <table style="color:#565656; font-weight: lighter; font-size: 13px;">

                        <tr>

                            <td>

                                <p><b>Terms:<br>Payment Due On Receipt<br>1. Prices And Payment</b>

                                Payments are to be made in U.S funds. Unless otherwise specified all invoices are due net 30 days from

date of Shipment.

                                </p>

                            </td>

                        </tr>

                    </table>

                    

';



           $pdf->WriteHTML($html, true, false, true, false, '');

           // Print some HTML Cells



       //$html = '<span color="red">Term & Condition</span> ';



       $pdf->SetFillColor(255,255,0);



       //$pdf->writeHTMLCell(0, 0, '', '', $html, 'LRTB', 1, 0, true, 'L', true);

       //$pdf->writeHTMLCell(0, 0, '', '', $html, 'LRTB', 1, 1, true, 'C', true);

       //$pdf->writeHTMLCell(0, 0, '', '', $html, 'LRTB', 1, 0, true, 'R', true);

           //ob_clean();

           ob_end_clean();

           $pdf->Output('pdfexample1.pdf', 'I'); 

       }//if condition check

       else{

           redirect();

       }

     }else{ //this condition check to if use only admin user

         redirect(site_url('admin/dashboard'));

     }

     

    }

    

//super_admin Using to get pdf generate

    function super_pdf($id=0){

     if($this->session->userdata('is_super_admin_login')){

     //$admin_id = $this->session->userdata('admin_id');

     $order_data = $this->Paymentgateway_model->get_details_for_super_admin($id);

     if($order_data){

         $tax = ($order_data->TXN_AMOUNT*$this->pay_tax['for'])/100;

         $price = $order_data->TXN_AMOUNT - $tax;

         $discount = $order_data->discount;

         $gross_amt = $tax+$price+$discount;

            // set some language-dependent strings (optional)

            //$pdf = new Pdf('P','A4', TRUE, 'UTF-8', false);

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

       // set document information

       $pdf->SetCreator(PDF_CREATOR);

       $pdf->SetAuthor('Nicola Asuni');

       $pdf->SetTitle('Accu Feedback');

       $pdf->SetSubject('TCPDF Tutorial');

       $pdf->SetKeywords('TCPDF, PDF, example, test, guide');



       //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));

       $pdf->setFooterData(array(0,64,0), array(0,64,128));



       // set header and footer fonts

       $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

       $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));



       // set default monospaced font

       $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);



       // set margins

      // $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

      // $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);

       $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);



       // set auto page breaks

       $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);



       // set image scale factor

       $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);



       // set some language-dependent strings (optional)

       if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {

           require_once(dirname(__FILE__).'/lang/eng.php');

           $pdf->setLanguageArray($l);

       }

           //$pdf->AddPage('P', 'A4');

           $pdf->AddPage();



           //$pdf->Cell(0, 0, 'A4 PORTRAIT', 1, 1, 'C');

            //$subtable = '<table border="1" cellspacing="6" cellpadding="4"><tr><td>a</td><td>b</td></tr><tr><td>c</td><td>d</td></tr></table>';

           $html = '<table WIDTH="600" height="100%" cellspacing="0">

                        <tr><td></td></tr>

                        <tr>

                            <td width="400">&nbsp;&nbsp;&nbsp;<img src="image/app_logo.png" style="width:auto; height:100px;"></td>

                            <td width="200" align="center"><h3><b>Invoice</b></h3>

                               <table border="0" cellspacing="2" cellpadding="0" align="left" style="font-size:13px;">

                                <tbody align="">

                                    <tr><td>Invoice No.</td><td> : '.$order_data->ORDER_ID .'</td></tr>

                                    <tr><td>Invoice Date</td><td> : '. date('d-M-Y', strtotime($order_data->TXNDATE)).'</td></tr>

                                    <tr><td>Payment Mode</td><td> : '.$order_data->mode.'</td></tr>

                                </tbody>

                            </table> 

                            </td>

                        </tr>

                    </table>&nbsp;<br><br>

                    <table border="1" cellspacing="0" cellpadding="5">

                        <thead>

                            <tr style="background-color:gray; color:white;" align="">

                                <th>Our Info : </th>

                                <th>Customer : </th>

                            </tr>

                        </thead>

                        <tbody>

                            <tr style="color:#565656; font-weight: lighter; font-size: 13px;">

                                <td><h4 >Accu Feedback</h4>

                                    <p>733, 7th floor, 

                                    Mangalam Fun Square, 

                                    Durga Nursery Road, Udaipur, 

                                    <br>Rajasthan(IN) 313001</p>

                                    <lable>Email : appspundit2014@gmail.com</lable>

                                    <lable><br>Mobile : +91 - (759) 734-9954 , (988) 776-8393 </lable>

                                </td>

                                <td><h4>'.$order_data->name.'</h4>

                                    <lable>Owner Name : '.$order_data->first_name.' '.$order_data->last_name.'</lable>

                                    <p>'.$order_data->r_address.'<br>'.$order_data->r_city.', '.$order_data->r_state.'<br>'.$order_data->r_country.' - '.$order_data->r_pin_code.'</p>

                                    <lable>Email : '.$order_data->email.'</lable>

                                    <lable><br>Mobile : '.$order_data->mobile.'</lable>

                                </td>

                            </tr>

                        </tbody>

                    </table>&nbsp;<br><br>

                    <table width="670" border="0" cellspacing="0" cellpadding="5" style="background-color:#f4f4f4">

                        <thead>

                            <tr style="background-color:gray; color:white;" align="">

                                <th width="320">Description</th>

                                <th width="80">Price</th>

                                <th width="80">TAX</th>

                                <th width="80">Discount</th>

                                <th width="110">Total</th>

                            </tr>

                        </thead>

                        <tbody>

                            <tr style="color:#272727; font-weight: lighter; font-size: 13px;">

                                <td width="320">Account Update Bill is : '.$order_data->productinfo.'</td>

                                <td width="80">'.$price.'</td>

                                <td width="80">'.$tax.'</td>

                                <td width="80">'.$discount.'</td>

                                <td width="110">'.$gross_amt.'.00</td>

                            </tr>

                        </tbody>

                    </table>&nbsp;<br>

                    <table style="border: 1px solid #ccc8c8">

                        <tr>

                            <td></td>

                            <td>

                                <table cellspacing="0" cellpadding="4" style="background-color:#f4f4f4; color:#272727; font-weight: lighter; font-size: 13px;">

                                    <tbody>

                                        <tr>

                                            <td>Summary : </td><td></td>

                                        </tr>

                                        <tr>

                                            <td>Sub Total :</td><td>'.$price.'</td>

                                        </tr>

                                        <tr>

                                            <td>Tax :</td><td>'.$tax.'</td>

                                        </tr>

                                        <tr>

                                            <td>Discount :</td><td>'.$discount.'</td>

                                        </tr>

                                        <tr style="background-color:gray; color:white; ">

                                            <td>Total Amount :</td><td>'.$gross_amt.'.00</td>

                                        </tr>

                                    </tbody>

                                </table>

                            </td>

                        </tr>

                    </table>

                    <table style="color:#272727; font-weight: lighter; font-size: 13px;">

                        <tr>

                            <td></td>

                            <td align="center">

                                <h4>Authorized person</h4>

                                <img src="image/app_logo.png" style="width:auto; height:70px;">

                                <lable><br>(Accu Feedback)</lable>

                                <lable><br>Sales Person</lable>

                            </td>

                        </tr>

                    </table><hr>

                    <table style="color:#565656; font-weight: lighter; font-size: 13px;">

                        <tr>

                            <td>

                                <p><b>Terms:<br>Payment Due On Receipt<br>1. Prices And Payment</b>

                                Payments are to be made in U.S funds. Unless otherwise specified all invoices are due net 30 days from

date of Shipment.

                                </p>

                            </td>

                        </tr>

                    </table>';



           $pdf->WriteHTML($html, true, false, true, false, '');

           // Print some HTML Cells



     //  $html = '<span color="red">Term & Condition</span> ';



       $pdf->SetFillColor(255,255,0);



      // $pdf->writeHTMLCell(0, 0, '', '', $html, 'LRTB', 1, 0, true, 'L', true);

       //$pdf->writeHTMLCell(0, 0, '', '', $html, 'LRTB', 1, 1, true, 'C', true);

       //$pdf->writeHTMLCell(0, 0, '', '', $html, 'LRTB', 1, 0, true, 'R', true);

           //ob_clean();

           ob_end_clean();

           $pdf->Output('pdfexample1.pdf', 'I'); 

       }//if condition check

       else{

           redirect();

       }

    }else{

        echo "<script> alert(confirm ('Please Login Account !!!')); </script>";

        redirect(site_url('login'));

    }

  }

    

}