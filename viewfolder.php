<?php
session_start();

// Vérifier si l'utilisateur est connecté en tant qu'employé
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'agent') {
    header("Location: login.php");
    exit();
}

?>
    

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>SAE | agent </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <!-- Google Fonts
		============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- owl.carousel CSS
		============================================ -->
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/owl.theme.css">
    <link rel="stylesheet" href="css/owl.transitions.css">
    <!-- animate CSS
		============================================ -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="css/normalize.css">
    <!-- meanmenu icon CSS
		============================================ -->
    <link rel="stylesheet" href="css/meanmenu.min.css">
    <!-- main CSS
		============================================ -->
    <link rel="stylesheet" href="css/main.css">
    <!-- educate icon CSS
		============================================ -->
    <link rel="stylesheet" href="css/educate-custon-icon.css">
    <!-- morrisjs CSS
		============================================ -->
    <link rel="stylesheet" href="css/morrisjs/morris.css">
    <!-- mCustomScrollbar CSS
		============================================ -->
    <link rel="stylesheet" href="css/scrollbar/jquery.mCustomScrollbar.min.css">
    <!-- metisMenu CSS
		============================================ -->
    <link rel="stylesheet" href="css/metisMenu/metisMenu.min.css">
    <link rel="stylesheet" href="css/metisMenu/metisMenu-vertical.css">
    <!-- calendar CSS
		============================================ -->
    <link rel="stylesheet" href="css/calendar/fullcalendar.min.css">
    <link rel="stylesheet" href="css/calendar/fullcalendar.print.min.css">
    <!-- x-editor CSS
		============================================ -->
    <link rel="stylesheet" href="css/editor/select2.css">
    <link rel="stylesheet" href="css/editor/datetimepicker.css">
    <link rel="stylesheet" href="css/editor/bootstrap-editable.css">
    <link rel="stylesheet" href="css/editor/x-editor-style.css">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="css/data-table/bootstrap-table.css">
    <link rel="stylesheet" href="css/data-table/bootstrap-editable.css">
    <!-- style CSS
		============================================ -->
    <link rel="stylesheet" href="style.css">
    <!-- responsive CSS
		============================================ -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- modernizr JS
		============================================ -->
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

</head>

<body>
    <!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
    <!-- Start Left menu area -->
    <div class="left-sidebar-pro">
        <nav id="sidebar" class="">
            <div class="sidebar-header">
                <a href="agent_de_saisie.php"><img class="main-logo" src="img/logo/logo.png" style="width: 120px;" alt="" /></a>
                <strong><a href="agent_de_saisie.php"><img src="img/logo/logo.png" alt="" /></a></strong>
            </div>
            <br>
            <div class="left-custom-menu-adp-wrap comment-scrollbar">
                <nav class="sidebar-nav left-sidebar-menu-pro">
                    <ul class="metismenu" id="menu1">
                        <li class="active">
                            <a class="has-arrow" href="agent_de_saisie.php">
                                <span class="educate-icon educate-course icon-wrap"></span>
								   <span class="mini-click-non">Les etudes</span>
								</a>
                            <ul class="submenu-angle" aria-expanded="true">
                                <li><a title="All etude" href="agent_de_saisie.php" style="background-color:rgba(94, 92, 92, 0.043); color:rgb(79, 79, 79);"><span class="mini-sub-pro">Liste des etudes</span></a></li>
                                <li><a title="Add etude" href="ajouter-etude.php"><span class="mini-sub-pro">Ajouter etude</span></a></li>                 
                                         </ul>
                        </li>
                       
                        <li>
                            <a class="has-arrow" href="add-type.html" aria-expanded="false"><span class="educate-icon educate-department icon-wrap"></span> <span class="mini-click-non">Les types</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a title="Liste des type" href="add-type.php"><span class="mini-sub-pro">Liste des type</span></a></li>
                                <li><a title="Ajouter type " href="add-type.php"><span class="mini-sub-pro">Ajouter type </span></a></li>
                            </ul>
                        </li>
                    
                        
                       
                       
                    </ul>
                </nav>
            </div>
        </nav>
    </div>
    <!-- End Left menu area -->
    <!-- Start Welcome area -->
    <div class="all-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="logo-pro">
                        <a href="agent_de_saisie.php"><img class="main-logo" src="img/logo/logo.png"style="width: 100px;"alt="" /></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-advance-area">
            <div class="header-top-area" >
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="header-top-wraper">
                                <div class="row">
                                    <div class="col-lg-1 col-md-0 col-sm-1 col-xs-12">
                                        <div class="menu-switcher-pro">
                                            <button type="button" id="sidebarCollapse" class="btn bar-button-pro header-drl-controller-btn btn-info navbar-btn">
													<i class="educate-icon educate-nav"></i>
												</button>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-7 col-sm-6 col-xs-12" >
                                       
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                        <div class="header-right-info">
                                            <ul class="nav navbar-nav mai-top-nav header-right-menu">
                                                <li class="nav-item dropdown">
                                                    <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="educate-icon educate-message edu-chat-pro" aria-hidden="true"></i><span class="indicator-ms"></span></a>
                                                    <div role="menu" class="author-message-top dropdown-menu animated zoomIn">
                                                        <div class="message-single-top">
                                                            <h1>Message</h1>
                                                        </div>
                                                        <ul class="message-menu">
                                                           
                                                        </ul>
                                                        <div class="message-view">
                                                            <a href="#">View All Messages</a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="educate-icon educate-bell" aria-hidden="true"></i><span class="indicator-nt"></span></a>
                                                    <div role="menu" class="notification-author dropdown-menu animated zoomIn">
                                                        <div class="notification-single-top">
                                                            <h1>Notifications</h1>
                                                        </div>
                                                        <ul class="notification-menu">
                                                          
                                                        </ul>
                                                        <div class="notification-view">
                                                            <a href="#">View All Notification</a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
															<img src="img/product/pro4.jpg" alt="" />
															<span class="admin-name">agent de saisie</span>
															<i class="fa fa-angle-down edu-icon edu-down-arrow"></i>
														</a>
                                                    <ul role="menu" class="dropdown-header-top author-log dropdown-menu animated zoomIn">

                                                        <li><a href="#"><span class="edu-icon edu-settings author-log-ic"></span>Settings</a>
                                                        </li>
                                                        <li><a href="acceuil.html"><span class="edu-icon edu-locked author-log-ic"></span>Log Out</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu start -->
            <div class="mobile-menu-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="mobile-menu">
                                <nav id="dropdown">
                                    <ul class="mobile-menu-nav">
                                        <li><a data-toggle="collapse" data-target="#Charts" href="#">Home <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                            <ul class="collapse dropdown-header-top">
                                                <li><a href="index.html">Dashboard v.1</a></li>
                                                <li><a href="index-1.html">Dashboard v.2</a></li>
                                                <li><a href="index-3.html">Dashboard v.3</a></li>
                                                <li><a href="analytics.html">Analytics</a></li>
                                                <li><a href="widgets.html">Widgets</a></li>
                                            </ul>
                                        </li>
                                
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu end -->
            <div class="breadcome-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="breadcome-list single-page-breadcome">
                                <div class="row">
                                        <ul class="breadcome-menu">
                                            <li><a href="#">Les etudes</a> <span class="bread-slash">/</span>
                                            </li>
                                            <li><span class="bread-blod">La liste des etudes</span>
                                            </li>
                                        </ul>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="data-table-area mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                        
                        <div class="sparkline13-list">
                            <div class="sparkline13-graph">
                                <div class="datatable-dashv1-list custom-datatable-overright">
                                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
     ul {
            list-style: none;
            padding-left: 20px;
        }

      

     .arborescence-container ul li {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }
    

        ul li .folder-icon {
            margin-right: 10px;
        }

        ul li .file-icon {
            margin-right: 10px;
        }

        ul li a {
            text-decoration: none;
            color: #000;
        }

        ul li a:hover {
            color: #ff0000;
            font-weight: bold;
        }
    </style>
                                    <?php
    // Connexion à la base de données MySQL
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sae";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Erreur de connexion à la base de données : " . $conn->connect_error);
    }

    // Vérifier si l'identifiant d'étude est fourni
    if (isset($_GET['id_etude'])) {
        $idEtude = $_GET['id_etude'];

        // Requête pour récupérer les informations de l'étude spécifique
        $sql = "SELECT * FROM etude WHERE id_etude = $idEtude";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Affichage des informations de l'étude spécifique


            $row = $result->fetch_assoc();



            $phase = $row['phase'];
            $direction = $row['direction'];
            $date_realisation = $row['date_realisation'];
            $date_acquisition = $row['date_acquisition'];
            $codification = $row['codification'];
            $num_cd = $row['num_cd'];

            $type = $row['type'];


            echo "</table>";

            // Extraire le nom de la wilaya, de la commune et du titre de l'étude
            $wilaya = $row['wilaya'];
            $commune = $row['commun'];
            $titre = $row['titre'];

            // Construire le chemin de base pour les dossiers de l'étude
            $cheminBase = "$titre";

            // Afficher l'arborescence des dossiers spécifiques à l'étude
            echo "<h1>Arborescence des dossiers</h1><br>";
            echo "<div class=\"arborescence-container\">";
            echo "<ul>";
            afficherArborescence($cheminBase);
            echo "</ul>";
            echo "</div>";
        } else {
            echo "Aucune étude trouvée avec l'identifiant spécifié.";
        }
    } else {
        echo "L'identifiant d'étude n'a pas été spécifié.";
    }

    // Fermer la connexion
    $conn->close();

    // Fonction récursive pour afficher l'arborescence des dossiers spécifiques à l'étude
    function afficherArborescence($chemin) {
        $contenu = scandir($chemin);
        foreach ($contenu as $element) {
            if ($element != '.' && $element != '..') {
                $cheminElement = $chemin . '/' . $element;
                if (is_dir($cheminElement)) {
                    echo "<li><i class=\"fas fa-folder folder-icon\"></i> $element</li>";
                    echo "<ul>";
                    afficherArborescence($cheminElement);
                    echo "</ul>";
                } else {
                    $extension = pathinfo($element, PATHINFO_EXTENSION);
                    $iconClass = getIconClassByExtension($extension);
                    echo "<li><i class=\"$iconClass file-icon\"></i> <a href=\"$cheminElement\" target=\"_blank\">$element</a></li>";
                }
            }
        }
    }

    function getIconClassByExtension($extension) {
        $iconClass = '';
        switch ($extension) {
            case 'pdf':
                $iconClass = 'far fa-file-pdf';
                break;
            case 'doc':
            case 'docx':
                $iconClass = 'far fa-file-word';
                break;
            case 'xls':
            case 'xlsx':
                $iconClass = 'far fa-file-excel';
                break;
            case 'ppt':
            case 'pptx':
                $iconClass = 'far fa-file-powerpoint';
                break;
            default:
                $iconClass = 'far fa-file';
                break;
        }
        return $iconClass;
    }
    ?>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Static Table Start -->
        

    <!-- jquery
		============================================ -->
    <script src="js/vendor/jquery-1.12.4.min.js"></script>
    <!-- bootstrap JS
		============================================ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- wow JS
		============================================ -->
    <script src="js/wow.min.js"></script>
    <!-- price-slider JS
		============================================ -->
    <script src="js/jquery-price-slider.js"></script>
    <!-- meanmenu JS
		============================================ -->
    <script src="js/jquery.meanmenu.js"></script>
    <!-- owl.carousel JS
		============================================ -->
    <script src="js/owl.carousel.min.js"></script>
    <!-- sticky JS
		============================================ -->
    <script src="js/jquery.sticky.js"></script>
    <!-- scrollUp JS
		============================================ -->
    <script src="js/jquery.scrollUp.min.js"></script>
    <!-- mCustomScrollbar JS
		============================================ -->
    <script src="js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/scrollbar/mCustomScrollbar-active.js"></script>
    <!-- metisMenu JS
		============================================ -->
    <script src="js/metisMenu/metisMenu.min.js"></script>
    <script src="js/metisMenu/metisMenu-active.js"></script>
    <!-- data table JS
		============================================ -->
    <script src="js/data-table/bootstrap-table.js"></script>
    <script src="js/data-table/tableExport.js"></script>
    <script src="js/data-table/data-table-active.js"></script>
    <script src="js/data-table/bootstrap-table-editable.js"></script>
    <script src="js/data-table/bootstrap-editable.js"></script>
    <script src="js/data-table/bootstrap-table-resizable.js"></script>
    <script src="js/data-table/colResizable-1.5.source.js"></script>
    <script src="js/data-table/bootstrap-table-export.js"></script>
    <!--  editable JS
		============================================ -->
    <script src="js/editable/jquery.mockjax.js"></script>
    <script src="js/editable/mock-active.js"></script>
    <script src="js/editable/select2.js"></script>
    <script src="js/editable/moment.min.js"></script>
    <script src="js/editable/bootstrap-datetimepicker.js"></script>
    <script src="js/editable/bootstrap-editable.js"></script>
    <script src="js/editable/xediable-active.js"></script>
    <!-- Chart JS
		============================================ -->
    <script src="js/chart/jquery.peity.min.js"></script>
    <script src="js/peity/peity-active.js"></script>
    <!-- tab JS
		============================================ -->
    <script src="js/tab.js"></script>
    <!-- plugins JS
		============================================ -->
    <script src="js/plugins.js"></script>
    <!-- main JS
		============================================ -->
    <script src="js/main.js"></script>
    <!-- tawk chat JS
		============================================ -->
  
</body>

</html>

