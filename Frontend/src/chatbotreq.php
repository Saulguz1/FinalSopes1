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
$_SESSION['numberchatbot']=0;
$_SESSION['msgchat']="Hola ".$_SESSION['username']." ! \nBienvenido al Chatbot COVID19. \nEscribe alguno de estos comandos en minusculas para empezar \n ( 'casos' , 'grafica de casos' )\n";
$_SESSION['pais']='';
$_SESSION['fechaini']='';
$_SESSION['fechaf']='';
$_SESSION['tipocaso']='';
header("Location: chatbotnormal.php");
exit;
?>