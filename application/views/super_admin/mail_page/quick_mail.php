<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Smart Survey - Reminder Mail</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>
<div id=":1r9" class="ii gt"><div id=":1r8" class="a3s aXjCH m164b2a76ed68369a"><u></u>  
        <div style="font-family:'HelveticaNeue',Helvetica,Arial,sans-serif; box-sizing:border-box; font-size:14px; width:100%!important; height:100%; line-height:1.6em; background-color:#f6f6f6; margin:0 auto; padding:10px;" bgcolor="#f6f6f6">
            <table style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; font-size:14px; width:100%; background-color:#f6f6f6; margin:0 auto; padding:5px;" align="center" bgcolor="#f6f6f6">
                <tbody>
                    <tr style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; font-size:14px; margin:0">
                        <td style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; font-size:14px; vertical-align:top; margin:0" valign="top"></td>
                        <td width="600" style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; font-size:14px; vertical-align:top; display:block!important; max-width:600px!important; clear:both!important; width:100%!important; margin:0 auto; padding:0" valign="top">
                            <div style="text-align: left;"><?= date('l, M d, Y')?></div>  
                            <div style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; font-size:14px; max-width:600px; display:block; margin:0 auto; padding:0">
                                <table width="100%" cellpadding="0" cellspacing="0" style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; font-size:14px; border-radius:3px; background-color:#fff; margin:0; border:1px solid #e9e9e9" bgcolor="#fff"><tbody>
                                        <tr style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; font-size:14px; margin:0">
                                            <td style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; font-size:20px; vertical-align:top; color:#fff; font-weight:500; text-align:center; border-radius:3px 3px 0 0; background-color:#3aaed9; margin:0; padding:20px" align="center" bgcolor="#3AAED9" valign="top">
                                                Accu Feedback  </td>
                                        </tr>
                                        <tr style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; font-size:14px; margin:0">
                                            <td style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; font-size:15px; vertical-align:top; text-transform:uppercase; color:#686868; font-weight:500; text-align:center; background-color:#ddf6ff; margin:0;padding:5px" align="center" bgcolor="#DDF6FF" valign="top">
                                                Information mail</td>
                                        </tr><tr style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; font-size:14px; margin:0"><td style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; font-size:14px; vertical-align:top; margin:0; padding:10px" valign="top">
                                                <table width="100%" cellpadding="0" cellspacing="0" style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; font-size:14px; margin:0">
                                                    <tbody>
                                                        <tr style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; font-size:14px; margin:0">
                                                            <td style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; font-size:14px; vertical-align:top; margin:0; padding:0 0 20px" valign="top">
                                                                Hello, <b>Guest</b>
                                                            </td>
                                                        </tr>
                                                        <tr style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; font-size:14px; margin:0">
                                                            <td style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; font-size:14px; vertical-align:top; margin:0; padding:0 0 20px" valign="top">
                                                                <?= $message; ?>
                                                            </td>
                                                        </tr>
                                                        
                                                        <tr style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; font-size:14px; margin:0">
                                                            <td style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; font-size:14px; vertical-align:top; margin:0; padding:0 0 20px" valign="top">
                                                                <a href="<?=base_url("login");?>" style="padding:10px 18px; border-radius:10px; background-color:#3aaed9; text-decoration:none; color:#fff" target="_blank" data-saferedirecturl="">Login to Smart Survey</a>
                                                            </td>
                                                        </tr>
                                                        <tr style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; font-size:14px; margin:0">
                                                            <td style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; font-size:14px; vertical-align:top; margin:0; padding:0 0 20px" valign="top">
                                                                &nbsp;</br>
                                                            </td>
                                                        </tr>
                                                        
                                                    </tbody>
                                                </table>

                                            </td>
                                        </tr>
                                    </tbody>
                                </table>&nbsp;</br></br>
<!--                                <div style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; width:100%; clear:both; color:#999; margin:0; padding:20px">
                                    <table width="100%" style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; margin:0">
                                        <tbody>
                                            <tr style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; font-size:8px; margin:0">
                                                <td style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; vertical-align:top; color:#999; text-align:center; margin:0; padding:0 0 20px" align="center" valign="top">You're receiving this email because you have enabled instant notification emails for this trigger.<br style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;box-sizing:border-box;font-size:14px;margin:0">For more details, please <a href="https://app.elegantsurveys.com" style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;box-sizing:border-box;font-size:12px;color:#999;text-decoration:underline;margin:0" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=https://app.elegantsurveys.com&amp;source=gmail&amp;ust=1532167527873000&amp;usg=AFQjCNG-g8j01bPruqRJ9jttqkkW6HDH4g">login to your account</a>. <br>
                                                    <a href="<?= base_url(); ?>" style="text-decoration:underline; color:#999" target="_blank" data-saferedirecturl="#">Unsubscribe</a> to stop receiving these emails.
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>-->
                            </div>
                        </td>
                        <td style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing:border-box; font-size:14px; vertical-align:top; margin:0" valign="top"></td>
                    </tr>
                </tbody>
            </table>
        </div>
           
    </div>
        
</div>
</body>
</html>