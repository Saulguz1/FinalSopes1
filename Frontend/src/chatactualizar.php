<?php
session_start();
//inserta mensaje
$url = 'http://apipython:5000/addmensaje';
$datosamigo = $_SESSION['datoschatactual'] ;
$mensaje = $_POST['inputmensaje'];
$nombre = '';
$data = array('user1'=> $_SESSION['id_user'],'user2'=> $datosamigo['id_user'],'msg'=>$mensaje);
$ch = curl_init( $url );
$payload = json_encode( $data );
curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
$result = curl_exec($ch);
curl_close($ch);

//actualiza el chat visual


$url2 = 'http://apipython:5000/obtenermensajes';
$_SESSION['msgchat'] = '';
$data = array('user1'=> $_SESSION['id_user'],'user2'=>$datosamigo['id_user']);
$ch = curl_init( $url2 );
$payload = json_encode( $data );
curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
$result = curl_exec($ch);
curl_close($ch);
 
$result=json_decode($result,true);

if(sizeof($result) != 0){
    foreach ($result as $item) {
        if(($item['user1'] ==$_SESSION['id_user']  && $item['user2'] == $datosamigo['id_user']) ||($item['user2'] ==$_SESSION['id_user']  && $item['user1'] ==  $datosamigo['id_user']) ){
        $nombre = '';
        if($item['user1']== $_SESSION['id_user']){
            $nombre = $_SESSION['username'];
        }else{
            $nombre = $datosamigo['user'];
        }
        $_SESSION['msgchat']=$_SESSION['msgchat']."[".$nombre."]:   ".$item['msg']."\n";
      }
    }
   header("Location: chatnormal.php");
   exit;
}else{
    header("Location: chatnormal.php");
    exit;
}


?>