<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>uSocial</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
        
    </head>
    <style>
        body {
        background-image: url('https://i.pinimg.com/originals/03/34/a7/0334a7b02031c715c1b0f80d3cc9d47d.gif');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
        }
        </style>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="publicaciones.php">uSocial</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="publicaciones.php">Mi inicio</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="getamigosrequest.php">Amigos</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="getamigoschat.php">Chat Amigos</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="getamigoschatbot.php">ChatBot COVID</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="editarperfil.php">Editar Perfil</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="index.php">Cerrar Sesion</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Acciones</div>
                            <a class="nav-link" href="publicaciones.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Mi Inicio
                            </a>
                            <a class="nav-link" href="getamigosrequest.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Amigos
                            </a>
                            <a class="nav-link" href="getamigoschat.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Chat Amigos
                            </a>
                            <a class="nav-link" href="getamigoschatbot.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                ChatBot COVID
                            </a>
                            <div class="sb-sidenav-menu-heading">Cuenta</div>
                            <a class="nav-link" href="editarperfil.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Edital Perfil
                            </a>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Cerrar Sesion
                            </a>

                            
                           
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php echo "".$_SESSION['username']." - ".$_SESSION['id_user']." - ".$_SESSION['modo']."";?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
