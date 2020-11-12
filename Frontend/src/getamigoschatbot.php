<?php
session_start();
$_SESSION['usuarios']=[];

$url = 'http://apipython:5000/getUsuarios';
$data = array('user'=> $_SESSION['username'],'id'=>$_SESSION['id_user']);

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
    $_SESSION['usuarios']=$result;
    $_SESSION['noamigos']=[];
    $_SESSION['datosamigos']=[];
    $band =0;
    if(sizeof($_SESSION['amigos'])>0){

        foreach ($_SESSION['usuarios'] as $itemu) {
            
            foreach ($_SESSION['amigos'] as $itema) {

                if($itema == $itemu['id_user']){
                    $band =1;
                }
            }
                            
            if($band==1){
                array_push($_SESSION['datosamigos'],$itemu);
                $band=0;
            }else{
                array_push($_SESSION['noamigos'],$itemu);
            }
        
        }
        header("Location: chatbot.php");
         exit;
    }else{
    $_SESSION['noamigos']=$_SESSION['usuarios'];
    header("Location: chatbot.php");
   exit;
}
}else{
    header("Location: chatbot.php");
   exit;
}

?>