<?php

$var_seg= md5(uniqid(time()));

echo "<img src=\"captcha/securimage_show.php?sid=$var_seg\" style=\"float: left; display: block\" alt=\"\" border=\"0\">";

?>