<?php
session_start();
$url = 'http://apinode:9000/login';
$user = '';
$pass = '';
$email = '';

if (isset($_POST['inputUser'])) {
    $user = $_POST['inputUser'];
    $email = $_POST['inputUser'];
}
if (isset($_POST['inputPassword'])) {
    $pass = $_POST['inputPassword'];
}

$data = array('user'=> $user,'password'=>$pass,'email'=>$email);

$ch = curl_init( $url );
# Setup request to send json via POST.
$payload = json_encode( $data );
curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
# Return response instead of printing.
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
# Send request.
$result = curl_exec($ch);
curl_close($ch);
 
$result=json_decode($result,true);

if(sizeof($result) != 0){
    $_SESSION['user']= $result['id_usuario']['S'];
    $_SESSION['name']= $result['nombre']['S'];
    $_SESSION['email']= $result['email']['S'];
   header("Location: editarperfil.php");
   exit;
    
}else{
   header("Location: login.php");
   exit;
}

?>

