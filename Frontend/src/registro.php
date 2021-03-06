<?php
session_start();
$_SESSION['user']= ' ';
$_SESSION['name']= ' ';
$_SESSION['email']= ' ';
$_SESSION['password']= ' ';
include_once "outheader.php";
?>

<div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Registro</h3></div>
                                    <div class="card-body">
                                        <form method="post" action="addUser.php" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label class="small mb-1" for="inputName">Nombre Completo:</label>
                                                    <input class="form-control py-4" id="inputName"  name="inputName" placeholder="Ingresa tu Nombre Completo" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputUser">Usuario</label>
                                                        <input class="form-control py-4" id="inputUser"  name="inputUser" placeholder="Ingresa tu usuario" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputemail">Email</label>
                                                        <input class="form-control py-4" id="inputemail"  name="inputemail" placeholder="Ingresa tu correo" />
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="small mb-1" for="inputPassword">Contraseña</label>
                                                                <input class="form-control py-4" id="inputPassword" name="inputPassword" type="password" placeholder="Enter password" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="small mb-1" for="inputRpassword">Confirmar Contraseña</label>
                                                                <input class="form-control py-4" id="inputRpassword" name="inputRpassword" type="password" placeholder="Confirm password" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                             <div class="form-group mt-4 mb-0">
                                             <button class="btn btn-primary btn-block" type="submit" name="submit" id="submit" value="Submit">Registrarse</button>
                                        </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="login.php">Ya tienes una cuenta? Iniciar Sesion</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>

<?php
include "outfooter.php"
?>
