<?php
session_start();
session_register_cms('captcha_texto_session');


function randomText($length) {
    $pattern = "1234567890abcdefghijklmnopqrstuvwxyz";
    for($i=0;$i<$length;$i++) {
      $key .= $pattern{rand(0,35)};
    }
    return $key;
}

$file= rand(1,4);

$largo= rand(4,7);

$_SESSION['captcha_texto_session'] = randomText($largo);

$captcha = imagecreatefromgif("bgcaptcha$file.gif");
$colText = imagecolorallocate($captcha, 0, 0, 0);
imagestring($captcha, 30, 16, 7, $_SESSION['captcha_texto_session'], $colText);

header("Content-type: image/gif");
imagegif($captcha);
?>