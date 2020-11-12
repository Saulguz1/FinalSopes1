<?php
session_start();
if (isset($_POST['imagen'])) {
    $imagen = $_POST['imagen'];
}
if (isset($_POST['texto'])) {
    $texto = $_POST['texto'];
}
$usuario = $_SESSION['username'];
$id_usuario = $_SESSION['id_user'];

$data = array('id_usuario'=> $id_usuario,'imagen' => $imagen, 'usuario' => $usuario, 'texto' => $texto);

$url = 'http://apipython:5000/publicar';
/*
$options = array(
    'http' => array(
        'header'  => "Content-type: application/json",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
*/

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


if (true) {
    //Verificar que se pudo subir
?>
    <script type="text/javascript">
        location.href = "../publicaciones.php";
    </script>
<?php
}
?>