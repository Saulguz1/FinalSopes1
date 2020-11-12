<?php
session_start();
include_once "header.php";

?>
        
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
         
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-area mr-1"></i>
                                Grafica de COVID19 <?php echo $_SESSION['pais']; ?>
                            </div>
                            <div class="card-body">
                                <canvas id="canvas" name="canvas"width="100%" height="30"></canvas></div>
                                <?php

                                $labels = "['";
                                for($i =0 ;$i<sizeof($_SESSION['labels']);$i++){
                                    if($i+1 == sizeof($_SESSION['labels'])){
                                        $labels = $labels.$_SESSION['labels'][$i];
                                        break;
                                    }
                                    $labels = $labels.$_SESSION['labels'][$i]."','";
                                }
                                $labels = $labels ."']";
                                $values = "[";
                                for($i =0 ;$i<sizeof($_SESSION['values']);$i++){
                                    if($i+1 == sizeof($_SESSION['values'])){
                                        $values = $values.$_SESSION['values'][$i];
                                        break;
                                    }
                                    $values = $values.$_SESSION['values'][$i].",";
                                }
                                $values = $values ."]";

                                $valuesm = "[";
                                for($i =0 ;$i<sizeof($_SESSION['valuesm']);$i++){
                                    if($i+1 == sizeof($_SESSION['valuesm'])){
                                        $valuesm = $valuesm.$_SESSION['valuesm'][$i];
                                        break;
                                    }
                                    $valuesm = $valuesm.$_SESSION['valuesm'][$i].",";
                                }
                                $valuesm = $valuesm ."]";

                                $valuesr = "[";
                                for($i =0 ;$i<sizeof($_SESSION['valuesr']);$i++){
                                    if($i+1 == sizeof($_SESSION['valuesr'])){
                                        $valuesr = $valuesr.$_SESSION['valuesr'][$i];
                                        break;
                                    }
                                    $valuesr = $valuesr.$_SESSION['valuesr'][$i].",";
                                }
                                $valuesr = $valuesr ."]";
                                
                                echo"<script>
                                var config = {
                                    type: 'line',
                                    data: {
                                        labels: ".$labels.",
                                        datasets: [{
                                            label: 'Confirmados',
                                            backgroundColor: '#FFFFFF',
                                            borderColor: 'green',
                                            data: ".$values.",
                                            fill: false,
                                        },{
                                            label: 'Muertos',
                                            backgroundColor: '#FFFFFF',
                                            borderColor: 'red',
                                            data: ".$valuesm.",
                                            fill: false,
                                        },{
                                            label: 'Recuperados',
                                            backgroundColor: '#FFFFFF',
                                            borderColor: 'blue',
                                            data: ".$valuesr.",
                                            fill: false,
                                        }]
                                    },
                                    options: {
                                        responsive: true,

                                        tooltips: {
                                            mode: 'index',
                                            intersect: false,
                                        },
                                        hover: {
                                            mode: 'nearest',
                                            intersect: true
                                        },
                                        scales: {
                                            xAxes: [{
                                                display: true,
                                                scaleLabel: {
                                                    display: true,
                                                    labelString:'Fecha'
                                                }
                                            }],
                                            yAxes: [{
                                                display: true,
                                                scaleLabel: {
                                                    display: true,
                                                    labelString: 'Casos'
                                                }
                                            }]
                                        }
                                    }
                                };

                                window.onload = function() {
                                    var ctx = document.getElementById('canvas').getContext('2d');
                                    window.myLine = new Chart(ctx, config);
                                };
                            </script>"
                            ?>
                        </div>
                        </div>
                        <form method="post" action="chatbotactualiza.php" enctype="multipart/form-data">
                                    <div class="form-group mt-4 mb-0">
                                        <button class="btn btn-primary btn-block" type="submit" name="submit" id="submit" value="Submit">Regresar</button>
                                    </div>
                        </form>
                    </div>
                </main>
            </div>
        


<?php
include "footer.php"
?>