<?php
session_start();
$url = 'http://apipython:5000/addamigo';
$idamigo = '';

if (isset($_POST['submit'])) {
    $idamigo = $_POST['submit'];
}
if($idamigo != ""){
    if (!in_array($idamigo, $_SESSION['amigos'])) {
    $data = array('id_user'=> $_SESSION['id_user'],'id_amigo'=>$idamigo);
    $ch = curl_init( $url );
    $payload = json_encode( $data );
    curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
    curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    $result = curl_exec($ch);
    curl_close($ch);
    $_SESSION['amigos'][] = $idamigo; //Si no esta, lo agrega....
  }
header("Location: getamigosrequest.php");
exit;
}

/*header("Location: getamigosrequest.php");
exit;*/
?>
