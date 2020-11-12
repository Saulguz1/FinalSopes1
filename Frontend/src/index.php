<?php
session_start();
$_SESSION['username']= ' ';
$_SESSION['id_user']= ' ';
$_SESSION['name']= ' ';
$_SESSION['password']= ' ';
$_SESSION['imagenuser']= ' ';
$_SESSION['modo'] = ' ';
$_SESSION['amigos']=[];
$_SESSION['usuarios']=[];
$_SESSION['noamigos']=[];
$_SESSION['datosamigos']=[];
$_SESSION['datoschatactual']=[];
$_SESSION['msgchat']='';
$_SESSION['numberchatbot']=0;
$_SESSION['pais']='';
$_SESSION['fechaini']='';
$_SESSION['fechaf']='';
$_SESSION['tipocaso']='';
$_SESSION['labels']=[];
$_SESSION['values']=[];
$_SESSION['valuesr']=[];
$_SESSION['valuesm']=[];
include_once "outheader.php";
?>

<h1 style="color:white"></h1>
     
<?php
include "outfooter.php"
?>

