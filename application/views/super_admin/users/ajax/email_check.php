<?php
if($email){
    foreach ($email as $count):
        echo '<i style="color:red">Not Available</i>';
    endforeach;
}else{
    echo '<i style="color:green">Available</i>';
}
?>