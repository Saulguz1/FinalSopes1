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
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">ChatBot COVID19</h3></div>
                                    <div class="card-body">
                                    <div float="left">
                                        <form method="post" action="chatbotreq.php" >
                                        <label for="cars">Selecciona uno de tus Amigos en modo bot:</label><br>
                                        <select name="seleccion" id="seleccion">
                                        <?php
                                         $_SESSION['disp']=[];
                                            foreach ($_SESSION['datosamigos'] as $item) {
                                                if($item['modo']==1){
                                                    array_push($_SESSION['disp'],"1");
                                                echo "
                                                <option value='".$item['id_user']."'>".$item['user']."</option>
                                                ";
                                                }
                                            }                                        
                                        ?>          
                                        </select>
                                        <br>
                                        <?php
                                            if(sizeof($_SESSION['disp'] )==0){
                                                echo "<input class='btn btn-primary btn-block' type='submit' value='Chatear' disabled>";
                                            }else{
                                                echo "<input class='btn btn-primary btn-block' type='submit' value='Chatear'>";
                                            }
                                            
                                        ?>
                                        
                                                            
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
<?php
include "footer.php"
?>
