<?php
session_start();
include_once "header.php";
?>
                    <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Personas que quizas Conozcas.
                            </div>
                            <div class="card-body">
                            <form method="post" action="addAmigosrequest.php" enctype="multipart/form-data">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nombre</th>
                                                <th>Usuario</th>
                                                <th>Foto</th>
                                                <th> </th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nombre</th>
                                                <th>Usuario</th>
                                                <th>Foto</th>
                                                <th> </th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                        <?php
                                            foreach ($_SESSION['noamigos'] as $item) {
                                                echo "
                                                <tr>
                                                <td align='center'>".$item['id_user']."</td>
                                                <td align='center'>".$item['nombre']."</td>
                                                <td align='center'>".$item['user']."</td>
                                                <td align='center'><img src='https://pro2-semi-g15.s3.us-east-2.amazonaws.com/".$item['imagen']."'  width='100' height='100'></td>
                                                <td align='center'>
                                                <button class='btn btn-primary btn-block'  type='submit' name='submit' id='submit' value='".$item['id_user']."'>Agregar</button>
                                                </td>
                                                 </tr>
                                                ";
                                            }
                                        ?>                                        
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                             </div>
                </div>



                <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Tus Amigos.
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nombre</th>
                                                <th>Usuario</th>
                                                <th>Foto</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nombre</th>
                                                <th>Usuario</th>
                                                <th>Foto</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                        <?php
                                            foreach ($_SESSION['datosamigos'] as $item) {
                                                echo "
                                                <tr>
                                                <td align='center'>".$item['id_user']."</td>
                                                <td align='center'>".$item['nombre']."</td>
                                                <td align='center'>".$item['user']."</td>
                                                <td align='center'><img src='https://pro2-semi-g15.s3.us-east-2.amazonaws.com/".$item['imagen']."'  width='100' height='100'></td>
                                                 </tr>
                                                ";
                                            }
                                        ?>  
                                          
                                          
                                        </tbody>
                                    </table>
                                </div>
                             </div>
                </div>
<?php
include "footer.php"
?>
