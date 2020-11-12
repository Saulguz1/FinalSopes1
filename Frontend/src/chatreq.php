<?php
session_start();
$url = 'http://apipython:5000/obtenermensajes';
$itemamigo = $_POST['seleccion'];
$datosamigos = [];
foreach ($_SESSION['datosamigos'] as $item){
    if($item['id_user']==$itemamigo){
        $_SESSION['datoschatactual'] = $item;
        $datosamigos  =$item;
    }
}

//hacer peticion de los mensajes anteriores
$_SESSION['msgchat']="";

$data = array('user1'=> $_SESSION['id_user'],'user2'=>$itemamigo);
$ch = curl_init( $url );
$payload = json_encode( $data );
curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
$result = curl_exec($ch);
curl_close($ch);
 
$result=json_decode($result,true);
if(sizeof($result) != 0){
    foreach ($result as $item) {
        if(($item['user1'] ==$_SESSION['id_user']  && $item['user2'] == $itemamigo) ||($item['user2'] ==$_SESSION['id_user']  && $item['user1'] == $itemamigo) ){
        $nombre = '';
        if($item['user1']== $_SESSION['id_user']){
            $nombre = $_SESSION['username'];
        }else{
            $nombre = $_SESSION['datoschatactual']['user'];
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