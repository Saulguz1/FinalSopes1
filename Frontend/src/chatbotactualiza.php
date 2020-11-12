<?php
session_start();
$url = 'https://8gbehvb71e.execute-api.us-east-2.amazonaws.com/Prueba1/datoscovid';
$datosamigo = $_SESSION['datoschatactual'] ;
$mensaje = $_POST['inputmensaje'];
$mensaje = $mensaje;
$tipo = $_SESSION['numberchatbot'];
print($tipo);
$_SESSION['labels']=[];
$_SESSION['values']=[];
$_SESSION['valuesr']=[];
$_SESSION['valuesm']=[];
$_SESSION['msgchat'] =$_SESSION['msgchat']."\t\t\t\t\t\t\t\t\t\t".$mensaje."\n";

if($mensaje == "casos" || $tipo== 11 ||$tipo==12 ||$tipo==13 ||$tipo == 14){
    if($tipo == 0){
        $_SESSION['numberchatbot']=11;
        $_SESSION['msgchat'] =$_SESSION['msgchat']."Pais? *con letra capital \n";
    }elseif($tipo == 11){
        $_SESSION['numberchatbot']=12;
        $_SESSION['pais']=$mensaje;
        $_SESSION['msgchat'] =$_SESSION['msgchat']."Fecha? *('YYYY-MM-DD')  \n";
    }elseif($tipo == 12){
        $_SESSION['numberchatbot']=13;
        $_SESSION['fechaini']=$mensaje;
        $_SESSION['msgchat'] =$_SESSION['msgchat']."Tipo de caso *minusculas (confirmados,recuperados,muertes o todos)?  \n";
    }elseif($tipo == 13){
        $_SESSION['numberchatbot']=14;
        $_SESSION['tipocaso']=$mensaje; 
        //AQUI HACE LA CONSULTA
        
        $data = array('chat'=> '1','pais'=> $_SESSION['pais'],'fechaini'=>$_SESSION['fechaini'], 'fechaf'=> "" );
        print_r($data);
        $ch = curl_init( $url );
        $payload = json_encode( $data );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $result = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($result,true);
        print_r($result);
        if(sizeof($result) != 0){
            if($_SESSION['tipocaso'] == "confirmados"){
                $_SESSION['msgchat'] =$_SESSION['msgchat'].$_SESSION['pais']." el día ".$_SESSION['fechaini']."\n- ".$result['confirmados']." confirmados\n";
            }elseif($_SESSION['tipocaso'] == "recuperados"){
                $_SESSION['msgchat'] =$_SESSION['msgchat'].$_SESSION['pais']." el día ".$_SESSION['fechaini']."\n- ".$result['recuperados']." recuperados\n";
            }elseif($_SESSION['tipocaso'] == "muertes"){
                $_SESSION['msgchat'] =$_SESSION['msgchat'].$_SESSION['pais']." el día ".$_SESSION['fechaini']."\n- ".$result['muertes']." muertes\n";
            }elseif($_SESSION['tipocaso'] == "todos"){
                $_SESSION['msgchat'] =$_SESSION['msgchat'].$_SESSION['pais']." el día ".$_SESSION['fechaini']."\n- ".$result['confirmados']." confirmados\n- ".$result['recuperados']." recuperados\n- ".$result['muertes']." muertes\n";       
            }else{
                $_SESSION['msgchat'] =$_SESSION['msgchat']." Tipo de caso no existe \n";
            }
            
        }else{
            $_SESSION['msgchat'] =$_SESSION['msgchat']." No hay datos de este pais \n";
        }
        
    }else{
        $_SESSION['numberchatbot']=0;
        $_SESSION['pais']='';
        $_SESSION['fechaini']='';
        $_SESSION['fechaf']='';
        $_SESSION['tipocaso']='';
        $_SESSION['msgchat'] ="Hola ".$_SESSION['username']." ! \nBienvenido al Chatbot COVID19. \nEscribe alguno de estos comandos en minusculas para empezar \n ( 'casos' , 'grafica de casos' )\n";
    }

}elseif($mensaje == "grafica de casos"|| $tipo == 22||$tipo ==23|| $tipo ==24 ||$tipo == 25){
    if($tipo == 0){
        $_SESSION['numberchatbot']=22;
        $_SESSION['msgchat'] =$_SESSION['msgchat']."Pais? *con letra capital \n";
    }elseif($tipo == 22){
        $_SESSION['numberchatbot']=23;
        $_SESSION['pais']=$mensaje;
        $_SESSION['msgchat'] =$_SESSION['msgchat']."Rango de fechas:\nFecha Inicio? *('YYYY-MM-DD')  \n";
    }elseif($tipo == 23){
        $_SESSION['numberchatbot']=24;
        $_SESSION['fechaini']=$mensaje;
        $_SESSION['msgchat'] =$_SESSION['msgchat']."Fecha Final? *('YYYY-MM-DD') ?  \n";
    }elseif($tipo == 24){
        $_SESSION['numberchatbot']=25;
        $_SESSION['fechaf']=$mensaje;
        //AQUI HACE LA CONSULTA
        
        $data = array('chat'=> '2','pais'=> $_SESSION['pais'],'fechaini'=>$_SESSION['fechaini'], 'fechaf'=> $_SESSION['fechaf'] );
        print_r($data);
        $ch = curl_init( $url );
        $payload = json_encode( $data );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $result = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($result,true);
        print_r($result);
        if(sizeof($result) != 0){
            $_SESSION['labels']=$result['fechas'];
            $_SESSION['values']=$result['casos'];
            $_SESSION['valuesr']=$result['casosr'];
            $_SESSION['valuesm']=$result['casosm'];
            header("Location: graficachat.php");
            exit;
            
        }else{
            $_SESSION['msgchat'] =$_SESSION['msgchat']." No hay datos de este pais \n";
        }
        
    }else{
        $_SESSION['numberchatbot']=0;
        $_SESSION['pais']='';
        $_SESSION['fechaini']='';
        $_SESSION['fechaf']='';
        $_SESSION['tipocaso']='';
        $_SESSION['msgchat'] ="Hola ".$_SESSION['username']." ! \nBienvenido al Chatbot COVID19. \nEscribe alguno de estos comandos en minusuclas para empezar \n ( 'casos' , 'grafica de casos' )\n";
    }
}else{
$_SESSION['msgchat'] =$_SESSION['msgchat']."Comando invalido :( , Intenta de Nuevo: \n";
}

header("Location: chatbotnormal.php");
exit;

?>