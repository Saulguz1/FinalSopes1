<?php
$url = 'http://apipython:5000/addUser';
$imagenad = '';
$name = '';
$user = '';
$pass = '';
$rpass='';
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
    $name = $_POST['inputName'];
}
if (isset($_POST['inputUser'])) {
    $user = $_POST['inputUser'];
}
if (isset($_POST['inputPassword'])) {
    $pass = $_POST['inputPassword'];
}
if (isset($_POST['inputRpassword'])) {
    $rpass = $_POST['inputRpassword'];
}

$data = array('nombre'=>$name,'user'=> $user,'password'=>$pass, 'rpassword'=> $rpass ,'imagen'=> $base64im);

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

$result = json_decode($result,true);
if($result['message'] == 1){

	$url3 = 'http://apipython:5000/login';
	$url2 = 'http://apipython:5000/cambiarid';
	$data = array('user'=> $user,'password'=>$pass);
	$ch = curl_init( $url3 );
	$payload = json_encode( $data );
	curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
	curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	$result = curl_exec($ch);
	curl_close($ch);
	$result=json_decode($result,true);
	print_r($result);
	if(sizeof($result) != 0){
		$data = array('user'=> $user,'id'=>$result[0]['_id']['$oid']);
		$ch = curl_init( $url2 );
		$payload = json_encode( $data );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		$result = curl_exec($ch);
		curl_close($ch);
		header("Location: login.php");
		exit;
	}else{
		header("Location: registro.php");
   		exit;
	}
    
}else{
   header("Location: registro.php");
   exit;
}
