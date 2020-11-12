<?php
session_start();
$url = 'http://apipython:5000/login';
$url2 = 'http://apipython:5000/cambiarid';
$user = '';
$pass = '';

if (isset($_POST['inputUser'])) {
    $user = $_POST['inputUser'];
}
if (isset($_POST['inputPassword'])) {
    $pass = $_POST['inputPassword'];
}

$data = array('user'=> $user,'password'=>$pass);

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
    $_SESSION['id_user']= $result[0]['_id']['$oid'];
    $_SESSION['name']= $result[0]['nombre'];
    $_SESSION['username']= $user;
    $_SESSION['password']= $pass;
    $_SESSION['imagenuser']= $result[0]['imagen'];
    $_SESSION['modo'] = $result[0]['modo'];
    $_SESSION['amigos']=$result[0]['amigos'];
   header("Location: editarperfil.php");
   exit;
    
}else{
   header("Location: login.php");
   exit;
}

?>

