<?php
session_start();
include_once "header.php";
$id_usuario = $_SESSION['id_user'];
$cadena_etiqueta = "";
if (isset($_GET['etiqueta'])) {
    $etiqueta = $_GET['etiqueta'];
} else {
    $etiqueta = "Todas";
}
$cadena_etiqueta = "&etiqueta=" . $etiqueta;
$publicaciones = json_decode(file_get_contents('http://apipython:5000/postsAmigos?id_usuario=' . $id_usuario . $cadena_etiqueta));
$etiquetas = json_decode(file_get_contents('http://apipython:5000/etiquetas'));

?>

<style>
    #upload {
        opacity: 0;
    }

    #upload-label {
        position: absolute;
        top: 50%;
        left: 1rem;
        transform: translateY(-50%);
    }

    .image-area {
        border: 2px dashed rgba(255, 255, 255, 0.7);
        padding: 1rem;
        position: relative;
    }

    .image-area::before {
        content: 'Uploaded image result';
        color: #fff;
        font-weight: bold;
        text-transform: uppercase;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 0.8rem;
        z-index: 1;
    }

    .image-area img {
        z-index: 2;
        position: relative;
    }
</style>

<div class="row">
    <br />
    <div class="col">Categorias</div>
    <div class="col-10" style="background-color: Lavender;">
        <div class="container">
            <div class="row">
                <div class="col">
                    <br />
                    <br />
                    <div class="card">
                        <div class="card-body">
                            <div style="float: left;max-height:90px;max-width:90px"><img style="height:100%;width:100%" src=<?php echo "'https://pro2-semi-g15.s3.us-east-2.amazonaws.com/" . $_SESSION['imagenuser'] . "'" ?> /></div>
                            <div style="margin-left: 100px;">
                                <button style="text-align: left;height:70px;width:100%" type="button" class="btn btn-light" data-toggle="modal" data-target="#exampleModal">¿Qué estás pensando?</button>
                            </div>
                        </div>
                    </div>

                    <br />
                    <div class="dropdown" style="float:right">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo $etiqueta ?>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" type="submit" href="./publicaciones.php?etiqueta=Todas">Todas</a>
                            <?php foreach ($etiquetas as $etq) { ?>
                                <a class="dropdown-item" type="submit" href="./publicaciones.php?etiqueta=<?php echo $etq->nombre ?>"><?php echo $etq->nombre ?></a>
                            <?php } ?>
                        </div>
                    </div>
                    <br />
                    <br />

                    <?php foreach ($publicaciones as $publicacion) { ?>
                        <div class="card text-center">
                            <div class="card-header">
                                <div style="float: left;background-color:white;max-height:90px;max-width:90px"><img style="height:100%;width:100%" src=<?php echo "'https://pro2-semi-g15.s3.us-east-2.amazonaws.com/" . $publicacion->imagen_usuario . "'" ?> /></div>
                                <div style="margin-left: 100px;text-align: left;">
                                    <h3 style="font-weight: bold;font-size: 150%"><?php echo $publicacion->usuario ?></h3>
                                    <p style="color:gray"><?php echo $publicacion->fecha ?></p>
                                </div>
                            </div>
                            <div class="card-body" style="text-align: left;">
                                <p>Etiqueta: <?php echo $publicacion->etiqueta ?></p>
                                <h5 class="card-title"><?php echo $publicacion->texto ?></h5>
                                <?php if(! $publicacion->espanol){ ?>
                                    <button type="button" class="btn btn-link" onclick="mostrar('trad<?php echo $publicacion->id_publicacion ?>')">Traducir</button>
                                    <h5 id="trad<?php echo $publicacion->id_publicacion ?>" style="display:none;" class="card-title"><?php echo $publicacion->traduccion ?></h5>
                                    <br/>
                                <?php } ?>
                                <img style="height:80%;width:80%;float:center;" src=<?php echo "'https://pro2-semi-g15.s3.us-east-2.amazonaws.com/publicaciones/" . $publicacion->imagen . ".jpg'" ?> />
                                <br />
                            </div>
                        </div>

                        <script>
                            function mostrar(identificador){
                                document.getElementById(identificador).style.display = "";
                            }
                        </script>

                        <br />
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col"></div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" action="./requests/nuevaPublicacion.php" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear publicación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div style="float: left;max-height:30px;max-width:40px"><img style="height:100%;width:100%" src=<?php echo "'https://pro2-semi-g15.s3.us-east-2.amazonaws.com/" . $_SESSION['imagenuser'] . "'" ?> /></div>
                    <div style="margin-left: 45px;text-align: left;">
                        <h6><?php echo $_SESSION['name']; ?></h6>
                    </div>
                    <br />
                    <textarea class="form-control" id="texto" name="texto" rows="3"></textarea>
                    <!-- Upload image input-->
                    <input id="upload" type="file" onchange="readURL(this);" class="form-control border-0">
                    <div class="input-group-append">
                        <label for="upload" class="btn btn-light m-0 rounded-pill px-4"> <i class="fas fa-upload"></i><small class="text-uppercase font-weight-bold text-muted"> Subir imagen</small></label>
                    </div>

                    <!-- Uploaded image area-->
                    <div class="image-area mt-4"><img id="imageResult" src="#" alt="" class="img-fluid rounded shadow-sm mx-auto d-block"></div>
                    <input type="hidden" name="imagen" id="imagen" />

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button class="btn btn-primary" type="submit" name="submit" id="submit" value="Submit">Publicar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    /*  ==========================================
    SHOW UPLOADED IMAGE
* ========================================== */
    var file64 = "error";

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#imageResult')
                    .attr('src', e.target.result);
                file64 = e.target.result.split(",")[1];
                document.getElementById('imagen').value = file64;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(function() {
        $('#upload').on('change', function() {
            readURL(input);
        });
    });




    /*  ==========================================
        SHOW UPLOADED IMAGE NAME
    * ========================================== */
    var input = document.getElementById('upload');
    var infoArea = document.getElementById('upload-label');

    input.addEventListener('change', showFileName);

    function showFileName(event) {
        var input = event.srcElement;
        var fileName = input.files[0].name;
        infoArea.textContent = 'File name: ' + fileName;
    }
</script>

<?php
include "footer.php"
?>