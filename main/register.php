<?php
$bin = $_POST['bin'];
$dec = $_POST['dec'] ;
if (isset($bin) and isset($dec)) {
    $realDec = bindec($bin);
    if ($dec == $realDec) 
        readfile("register.html");
    else { 
        echo "Captcha erróneo!";
        header('Refresh: 2; URL=.');
    }
} else {
    header('Refresh: 0; URL=.');
}
?>