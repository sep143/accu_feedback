<?php
    if($m_number){
        foreach ($m_number as $row):
            ?>
<span style="color: red;"><font size="2">Mobile No. Already Register.</font></span>
<?php
        endforeach;
    }else{
        ?>
<span style="color: green;"><font size="2">Available</font></span>
<?php
    }

?>