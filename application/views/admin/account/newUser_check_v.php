<?php

    if($email){
    foreach ($email as $row):
?>

<span style="color: red;"><font size="2">This Email Id Already Register.</font></span>

<?php
    endforeach;
    }else{
 ?>

<span style="color: green;"><font size="2">Available</font></span>

<?php
} 
 