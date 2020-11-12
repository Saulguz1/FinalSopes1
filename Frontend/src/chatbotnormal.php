<?php
session_start();
$datos = $_SESSION['datoschatactual'];
include_once "header.php";

?>

<div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header">
                                    <img src=<?php echo"'https://pro2-semi-g15.s3.us-east-2.amazonaws.com/".$datos['imagen']."'"?>  width="100" height="100">                
                                    <label style="color:blue;font-size:50px;"><?php echo $datos['user']." (Bot) "; ?></label><br>
                                    <label style="color:green;font-size:10px;">Modo Bot Covid</label>                                    
                                </div>
                                    <div class="card-body">
                                                    <div class="form-group">
                                                    <textarea id="txtareachat" name="txtareachat" readonly style=" overflow-y: scroll; height: 200px; width: 100%;resize: none; "  onclick="document.getElementById('txtareachat').scrollTop = document.getElementById('txtareachat').scrollHeight; " ><?php echo $_SESSION['msgchat'] ?>
                                                   </textarea>

                                                    </div>
                                                    
                                                <form method="post" action="chatbotactualiza.php" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <input class="form-control py-4" onclick="document.getElementById('txtareachat').scrollTop = document.getElementById('txtareachat').scrollHeight; " id="inputmensaje" name="inputmensaje" type="text" placeholder="Mensaje..." />
                                                    </div>
                                                <div class="form-group mt-4 mb-0">
                                                    <button class="btn btn-primary btn-block" type="submit" name="submit" id="submit" value="Submit">Enviar</button>
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