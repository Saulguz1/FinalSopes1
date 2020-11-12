<?php
session_start();
include_once "header.php";
?>

<div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Mi Informacion Personal</h3></div>
                                    <div class="card-body">
                                        <form method="post" action="editrequest.php" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputName">Nombre Completo:</label>
                                                        <input class="form-control py-4" id="inputName"  name="inputName" value= <?php echo "'".$_SESSION['name']."'";?> />
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputUser">Usuario</label>
                                                        <input class="form-control py-4" id="inputUser"  name="inputUser" value=<?php echo "'".$_SESSION['username']."'";?>/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputimage">Imagen Actual: </label>
                                                        <img src=<?php echo"'https://pro2-semi-g15.s3.us-east-2.amazonaws.com/".$_SESSION['imagenuser']."'"?>  width="100" height="100">                
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputimage">Seleccion de Imagen (De lo contrario se borrara la actual): </label>
                                                        <input  type="file" id="inputimage" name="inputimage">                   
                                                    </div>
                                                    <div>
                                                        <p>Modo Bot :</p>
                                                        <input type="radio" id="modosi" name="modosi" value="1" onclick="document.getElementById('modono').checked = false">
                                                        <label for="modosi">Si</label><br>
                                                        <input type="radio" id="modono" name="modono" value="0" checked = "true" onclick="document.getElementById('modosi').checked = false">
                                                        <label for="modono">No</label><br>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputRpassword">Confirmar Contraseña</label>
                                                        <input class="form-control py-4" id="inputRpassword" name="inputRpassword" type="password" placeholder="Confirm password" />
                                                    </div>

                                                <div class="form-group mt-4 mb-0">
                                                    <button class="btn btn-primary btn-block" type="submit" name="submit" id="submit" value="Submit">Guardar Informacion</button>
                                                </div>
                                        </form>
 
				
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>

<?php
include "footer.php"
?>
