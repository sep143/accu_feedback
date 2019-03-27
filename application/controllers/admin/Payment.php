<?php
defined('BASEPATH')OR exit('No direct script access allowed');

require_once(APPPATH."libraries/lib/config_paytm.php");
require_once(APPPATH."libraries/lib/encdec_paytm.php");

class Payment extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('admin/Paymentgateway_model','Paymentgateway_model');
    }

        //Upgrade Account For payment option link
    public function upgrade(){
        if($this->session->userdata('role_id')==2){
            $admin_id= $this->session->userdata('admin_id');
            $data['singleMonth'] = $this->Paymentgateway_model->singleMonth();
            $data['singleAnnual'] = $this->Paymentgateway_model->singleAnnual();
            $data['multiMonth'] = $this->Paymentgateway_model->multiMonth();
            $data['multiAnnual'] = $this->Paymentgateway_model->multiAnnual();
            $data['access'] = $this->Paymentgateway_model->select_device($admin_id);
            $data['view'] = 'admin/account/upgrade_account';
            $this->load->view('admin/layout', $data);
        }  else {
            redirect(site_url('admin/dashboard'));
        }
    }
    

//Payu Money gateway
    public function payu_money(){
        $this->load->model('admin/User_model','User_model');
        $id = $this->session->userdata('admin_id');
        $data = $this->User_model->get_restaurant($id);
        $pay = $this->input->post('pay');
        $device = $this->input->post('device');
        //fix discount row in table to get data
        $paramList['singleMonth'] = $this->Paymentgateway_model->singleMonth();
        $paramList['singleAnnual'] = $this->Paymentgateway_model->singleAnnual();
        $paramList['multiMonth'] = $this->Paymentgateway_model->multiMonth();
        $paramList['multiAnnual'] = $this->Paymentgateway_model->multiAnnual();
        
        if($pay == 'monthly'){
            if($device == 1){
             $amount = $this->pay_month["month"]-$paramList['singleMonth']->amount;
             $discount = $paramList['singleMonth']->amount;
         }else if($device == 2){
            $amount = $this->pay_month["mmonth"]-$paramList['multiMonth']->amount;
            $discount = $paramList['multiMonth']->amount;
         }
        }else if($pay == 'annual'){
            if($device == 1){
                $amount = $this->pay_month["annul"]-$paramList['singleAnnual']->amount;
                $discount = $paramList['singleAnnual']->amount;
            }else if($device == 2){
                $amount = $this->pay_month["mannul"]-$paramList['multiAnnual']->amount;
                $discount = $paramList['multiAnnual']->amount;
            }
        } 
        $MERCHANT_KEY = "An2rmqhO";
        $SALT = "DgWVRvH9AE";

        $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
        $fname = $this->session->userdata('name');
        $email = $this->session->userdata('email');
        $grandtotal = $amount;
        $productinfo = $pay;
        $udf1=$pay; //payment duration
        $udf2=$device; //device select
        $udf3=$discount;
        $udf4='';
        $udf5='';

        $hashstring = $MERCHANT_KEY . '|' . $txnid . '|' . $grandtotal . '|' . $productinfo . '|'. $fname . '|' . $email .'|'.$udf1.'|' .$udf2.'|' .$udf3.'|'.$udf4.'|'.$udf5.'||||||'. $SALT;
        //$hashstring = $MERCHANT_KEY . '|' . $txnid . '|' . $fname . '|' . $email .'|'.$udf1.'|' .$udf2.'|' .$udf3.'|'.$udf4.'|'.$udf5.'||||||'. $SALT;

        $hash = strtolower(hash('sha512', $hashstring));
        //$data['hash'] = $hash;
        
        $orderID = rand(1000, 99999);
        $paramList['key'] = $MERCHANT_KEY;
        //$paramList['hash_string'] = $this->input->post('device');
        $paramList['hash'] = $hash;
        $paramList['txnid'] = $txnid;
        $paramList['amount'] = $amount;
        $paramList['email'] = $this->session->userdata('email');
        $paramList['phone'] = $this->session->userdata('mobile');
        $paramList['surl'] = base_url().'admin/Payment/status';
        $paramList['furl'] = base_url().'admin/Payment/status';
        $paramList['curl'] = base_url().'admin/Payment/status';
        $paramList['service_provider'] = 'payu_paisa';
        $paramList['udf1'] = $udf1;
        $paramList['udf2'] = $device;
        $paramList['udf3'] = $discount; //discount get to DB and paymewntgateway table in insert
        $paramList['udf4'] = '';
        $paramList['udf5'] = '';
        $paramList['firstname'] = $this->session->userdata('name');
        $paramList['productinfo'] = $productinfo;
        $paramList['lastname'] = $data->last_name;
        $paramList['address1'] = $data->r_address;
        $paramList['City'] = $data->r_city;
        $paramList['State'] = $data->r_state;
        $paramList['country'] = $data->r_country;
        $paramList['zipcode'] = $data->r_pin_code;
        $paramList['pay'] = $pay;
        //$paramList['mode'] = 'NB';
        
        $paramList['device'] = $this->input->post('device');
        $paramList['pay'] = $this->input->post('pay');
        //$data['pay_type'] = $this->input->post('pay_type');
        $this->load->view('admin/account/make_payment', $paramList);
        
    }
    
 // payumoney URl
 public function status(){
     $status = $this->input->post('status');
      if (empty($status)) {
            redirect('Welcome');
        }
        $firstname = $this->input->post('firstname');
        $amount = $this->input->post('amount');
        $txnid = $this->input->post('txnid');
        $posted_hash = $this->input->post('hash');
        $key = $this->input->post('key');
        $productinfo = $this->input->post('productinfo');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $pay_type = $this->input->post('udf1');
        $device = $this->input->post('udf2');
        $discount = $this->input->post('udf3');
        $PG_TYPE = $this->input->post('PG_TYPE');
        $bank_ref_num = $this->input->post('bank_ref_num');
        $payuMoneyId = $this->input->post('payuMoneyId');
        $mode = $this->input->post('mode');
        $productinfo = $this->input->post('productinfo');
      // print_r($pay_type); exit();
        $salt = "DgWVRvH9AE"; //  Your salt
        
        $add = $this->input->post('additionalCharges');
        If (isset($add)) {
            $additionalCharges = $this->input->post('additionalCharges');
            $retHashSeq = $additionalCharges . '|' . $salt . '|' . $status . '|||||||||||' . $email . '|' .$phone. '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
        } else {
            $retHashSeq = $salt . '|' . $status . '|||||||||||' . $email . '|' .$phone. '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
        }
         $data['hash'] = hash("sha512", $retHashSeq);
          $data['amount'] = $amount;
          $data['txnid'] = $txnid;
          $data['posted_hash'] = $posted_hash;
          $data['status'] = $status;
          $data['email'] = $email;
          $data['phone'] = $phone;
          $db = array(
              'ORDER_ID'=> $payuMoneyId,
              'CUST_ID'=> $this->session->userdata('admin_id'),
              'TXN_AMOUNT'=>$amount,
              'discount'=>$discount,
              'MSISDN'=> $phone,
              'TxtID'=> $txnid,
              'mode'=> $mode,
              'bank_ref_num'=> $bank_ref_num,
              'PG_TYPE'=> $PG_TYPE,
              'productinfo'=> $productinfo,
              'EMAIL'=> $email,
              'STATUS'=>$status,
              'device'=>$device,
              'TXNDATE'=> date('Y-m-d H:i:s')
          );
          $this->Paymentgateway_model->load_payment($db);
        if($status == 'success'){
            $id = $this->session->userdata('admin_id');
            $get_data = $this->Paymentgateway_model->get_restaurant($id);
            $expired_date_up = $get_data->expired_date;
            $currentDate = (new DateTime())->format('Y-m-d');
            if($pay_type=='monthly'){
                $duration = 1;
                if($currentDate <= $expired_date_up){
                    $expired_date_insert = $expired_date_up;
                }else{
                    $expired_date_insert = $currentDate;
                }
                $expiredDate = date('Y-m-d', strtotime($expired_date_insert.'+30 days'));
            }else if($pay_type=='annual'){
                $duration = 12;
                if($currentDate <= $expired_date_up){
                    $expired_date_insert = $expired_date_up;
                }else{
                    $expired_date_insert = $currentDate;
                }
                $expiredDate = date('Y-m-d', strtotime($expired_date_insert.'+360 days'));
            }
            $res_table = array(
                'expired_date'=> $expiredDate,
                'duration'=> $duration,
                'expired_role'=>1,
                'device'=>$device
            );
            $this->Paymentgateway_model->update_pay_restaurant($id,$res_table);// restaurant table in expired role and date update after success pay
            if($device == 1){ //agar device 1 hi select krta he to sare device ko inactive kr dega
                $device_data = array(
                    'status'=>0,
                );
                $this->Paymentgateway_model->device_inactive($id, $device_data);
            }
            $data['view'] = 'admin/account/payment/success';
            $this->load->view('admin/layout', $data);
            
         //after success payment then send mail
         $msg['name'] = $this->session->userdata('name');  
         $msg['invoice'] = $payuMoneyId;
         $msg['trans_id'] = $txnid;
         $msg['amount'] = $amount;
         $msg['expired'] = date('d-F-Y', strtotime($expiredDate));
         //$msg['message'] = $recive_msg;
            $message = $this->load->view('super_admin/mail_page/quick_mail.php', $msg, true);
            $config = Array(
                'protocol' => 'smtp',
                'smtp_host' => $this->host['smtp_host'],
                'smtp_port' => $this->port['port'],
                'smtp_user' => $this->mail['emailID'],//'info@appspunditinfotech.com', // change it to yours
                'smtp_pass' => $this->pwd['password'],//'appspundit16*', // change it to yours
                'mailtype' => 'html',
                'charset' => 'iso-8859-1',
                'priority' => '1',
                'wordwrap' => TRUE
            );
            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");
            $this->email->from("info@appspunditinfotech.com", "Information Mail");
            $this->email->to($this->session->userdata('email'));
            $this->email->subject('Update Account');
            $this->email->message($message);
            $this->email->set_header('MIME-Version', '1.0; charset=utf-8');
            $this->email->set_header('Content-type', 'text/html');
            $this->email->send();
           // echo $this->email->print_debugger();

           // echo "<script> alert('Send Mail.') </script>";
            
        //mail code end
         }
         else{
             $data['view'] = 'admin/account/payment/failure';
              $this->load->view('admin/layout', $data); 
         }
 }
 

//Paytm Payment getway use
    public function pay(){
        $id = $this->session->userdata('admin_id');
        $pay = $this->input->post('pay');
        $device = $this->input->post('device');
        if($pay == 'monthly'){
            if($device == 1){
             $amount = 29;
         }else if($device == 2){
            $x = $device - 1;
            $y = $x*9;
            $amount = 29 + $y;
         }
        }else if($pay == 'annual'){
            if($device == 1){
                $amount = 290;
            }else if($device == 2){
                $x = $device - 1;
                $y = $x*9;
                $amount = (29 + $y)*10;
            }
        } 
        $orderID = rand(1000, 99999);
        
        $paramList["MID"] = PAYTM_MERCHANT_MID;
        $paramList["ORDER_ID"] = "ORDER".$orderID;        
        $paramList["CUST_ID"] = $id;   /// according to your logic
        $paramList["INDUSTRY_TYPE_ID"] = 'RETIAL';
        $paramList["CHANNEL_ID"] = 'WEB';
        $paramList["TXN_AMOUNT"] = $amount;
        $paramList["WEBSITE"] = PAYTM_MERCHANT_WEBSITE;
      
        $paramList["CALLBACK_URL"] = 'http://localhost/project_1/admin/payment/callBack';
        $paramList["MSISDN"] = $this->session->userdata('mobile'); //Mobile number of customer
        $paramList["EMAIL"] = $this->session->userdata('email');
        $paramList["VERIFIED_BY"] = "EMAIL"; //
        $paramList["IS_USER_VERIFIED"] = "YES"; //
        $paramList["PAYMENT_MODE_ONLY"] = "YES"; //
        $paramList["AUTH_MODE"] = "3D"; //
        $paramList["PAYMENT_TYPE_ID"] = "DC"; //
        $paramList["CARD_TYPE"] = "MASTER"; //
      //  print_r($paramList);
        $paramList['checkSum'] = getChecksumFromArray($paramList,PAYTM_MERCHANT_KEY);
  
        $paramList['device'] = $this->input->post('device');
        $paramList['pay'] = $this->input->post('pay');
        //$data['pay_type'] = $this->input->post('pay_type');
        $this->load->view('admin/account/make_payment', $paramList);
        //$this->load->view('admin/layout');
    }
    
       
//responses 

public function callBack(){
    header("Pragma: no-cache");
    header("Cache-Control: no-cache");
    header("Expires: 0");

    // following files need to be included
    require_once (APPPATH."libraries/lib/config_paytm.php");
    require_once (APPPATH."libraries/lib/encdec_paytm.php");

    $paytmChecksum = "";
    $paramList = array();
    $isValidChecksum = "FALSE";

    $paramList = $_POST;
    
    $paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

    //Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application’s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
    $isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.
    //print_r($paramList); //exit();
    $this->Paymentgateway_model->paytmCallbackUpdate($paramList);     

    if($isValidChecksum == "TRUE") {

        if ($_POST["STATUS"] == "TXN_SUCCESS") {
            $data['status'] = "Transaction successful";     

//            $invoiceData['invoiceNumber'] = $this->Admin_model->generateInvoiceNo();
//            if($invoiceData['invoiceNumber'] == ''){
//                $invoiceData['invoiceNumber'] = '12345678';
//            }
//            else {
//                $invoiceData['invoiceNumber'] = $invoiceData['invoiceNumber'] + 1;
//            }
//            $invoiceData['issueDate'] = date('d-m-Y',strtotime($paramList['TXNDATE']));
//            $invoiceData['TXNID'] = $_POST['TXNID'];
//            $invoiceData['billTo'] = $this->Home_model->findValuefromField('Address', 'UserID = '.$this->session->userdata('UserID'), 'usermaster_tbl');
//            $invoiceData['totalAmount'] = $this->session->userdata('SMS_TOTAL');
//            $invoiceData['gst'] = ($invoiceData['totalAmount'] * 18) / 100;
//            $invoiceData['paymentDue'] = $invoiceData['totalAmount'] + $invoiceData['gst'];
//            $invoiceData['description'] = 'TEXT SMS';
//            $invoiceData['qty'] = $this->session->userdata('SMS_COUNT');
//            $invoiceData['paymentDueWords'] = getIndianCurrency($invoiceData['totalAmount'] + $invoiceData['gst']);
//            $invoice =  $this->load->view('templates/invoice', $invoiceData, true);
//
//            $this->Paymentgateway_model->updatePaymentInvoice($paramList['ORDERID'], $invoiceData['invoiceNumber']);
//            $invoiceFileName = $this->htmlToPdf($invoiceData, $invoice);
//            $this->mailInvoice($invoiceFileName, $paramList['ORDERID'], $invoiceData);

        }
        else {
            $status =  $_POST['RESPMSG'];
//            $this->mailDetails($status);
            $data['status'] = 'Transaction failed, please check your mail for more details';
        }
    }
    else {
        $data['status'] =  "An error occured, please try again";
        //Process transaction as suspicious.
    }
    $this->session->set_flashdata('paymentStatus', $data['status']);
    $this->session->set_userdata('paymentStatus', $data['status']);
    $this->load->view('admin/account/payment/payment-confirmation', $data);
    //redirect('../payment-confirmation');
    }
  
    
  
}