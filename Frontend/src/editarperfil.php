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
                                <div class="card-header"><h3 class="text-center font-weight-light my-4">BIENVENIDO <?php echo "   ".$_SESSION['user']."";?></h3></div>

                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Mi Informacion Personal</h3></div>
                                    <div class="card-body">
                                        <form method="post" action="editarperfil.php" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputName">Nombre Completo:</label>
                                                        <label class="small mb-1" for="inputName"> <?php echo "   ".$_SESSION['name']."";?></label>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputName">Usuario:</label>
                                                        <label class="small mb-1" for="inputName"> <?php echo "   ".$_SESSION['user']."";?></label>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputName">Email:</label>
                                                        <label class="small mb-1" for="inputName"> <?php echo "   ".$_SESSION['email']."";?></label>
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
