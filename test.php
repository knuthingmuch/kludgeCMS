<?php
$pos=strpos("Helloworld","woqrld");
if($pos)
	echo $pos."__".substr("Helloworld",0,$pos);

echo str_replace("/"," ",date('d/M/Y'));
echo " at ".date('h:i a')."\n";
echo htmlspecialchars("fzgfdgAKDKJCBH239049857_",ENT_QUOTES);

require_once 'lib/mysql-lib.php';

$CONN=db_sysconnect();
$result = mysqli_query($CONN,"SELECT collegecode FROM colleges;");
db_sysclose($CONN);

while($row=mysqli_fetch_array($result))
{
	echo $row['collegecode']." ";
}

echo hash('sha256', 'pass');
echo "<hr/>";

echo substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 16);
echo "<br/>----------------------<br/>"
?>
<?php
require_once('PHPMailer/class.phpmailer.php');
$mail = new PHPMailer(true);

if(True){
    $mail->IsSMTP(); 
    $mail->SMTPAuth = true; 
//     $mail->SMTPSecure = "ssl"; 
    $mail->Host = "localhost"; //"202.0.103.209"; 
    $mail->Port = 25; 
    $mail->Username = "sitebot@nssgoa.com"; 
    $mail->Password = "NSSGU@Xav3";
}

//Typical mail data
$mail->AddAddress("nikefalcon@gmail.com", "Akshay");
$mail->SetFrom("sitebot@nssgoa.com", "NSS-Goa");
$mail->Subject = "test-sub";
$mail->Body = "---test-content--";

try{
    $mail->Send();
    echo "Success!";
} catch(Exception $e){
    //Something went bad
    echo "Fail :(";
}

?>