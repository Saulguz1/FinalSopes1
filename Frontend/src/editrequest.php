<?php
session_start();
$url = 'http://apipython:5000/editar';
$url2 = 'http://apipython:5000/login';
$userant = $_SESSION['username'];
$password =$_SESSION['password'];
$nombre = '';
$user = '';
$imagen = '';
$modo = '';
$rpassword = '';
$base64im= '';

$allow = array("jpg");
$todir = "";
if ( !!$_FILES['inputimage']['tmp_name'] ) // is the file uploaded yet?
{
    $info = explode('.', strtolower( $_FILES['inputimage']['name']) ); // whats the extension of the file

    if ( in_array( end($info), $allow) ) // is this file allowed
    {
    if ( move_uploaded_file( $_FILES['inputimage']['tmp_name'], $todir . basename($_FILES['inputimage']['name'] ) ) )
    {
        // the file has been moved correctly
        $img = file_get_contents($todir . basename($_FILES['inputimage']['name'] ) );
        $base64im = base64_encode($img);
    }
    }
}
if (isset($_POST['inputName'])) {
    $nombre = $_POST['inputName'];
}
if (isset($_POST['inputUser'])) {
    $user = $_POST['inputUser'];
}
if (isset($_POST['modosi'])) {
    $modo = $_POST['modosi'];
}
if (isset($_POST['modono'])) {
    $modo = $_POST['modono'];
}
if (isset($_POST['inputRpassword'])) {
    $rpassword = $_POST['inputRpassword'];
}
if($password == $rpassword){
    $data = array('userant'=> $userant,'nombre'=>$nombre,'user'=>$user,'imagen'=>$base64im,'modo'=>$modo,'password'=>$password);
    $ch = curl_init( $url );
    $payload = json_encode( $data );
    curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
    curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    $result = curl_exec($ch);
    curl_close($ch);
    
    $result=json_decode($result,true);
    if($result['mensaje'] == 1){
        $data = array('user'=> $user,'password'=>$password);
        $ch = curl_init( $url2 );
        $payload = json_encode( $data );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $result = curl_exec($ch);
        curl_close($ch);
        $result=json_decode($result,true);

        if(sizeof($result) != 0){
            $_SESSION['id_user']= $result[0]['_id']['$oid'];
            $_SESSION['name']= $result[0]['nombre'];
            $_SESSION['username']= $user;
            $_SESSION['password']= $password;
            $_SESSION['imagenuser']= $result[0]['imagen'];
            $_SESSION['modo'] = $result[0]['modo'];
        header("Location: editarperfil.php");
        exit;
        }
    }else{
        header("Location: editarperfil.php");
        exit;
    }
}else{
    header("Location: editarperfil.php");
        exit;
}
?>

