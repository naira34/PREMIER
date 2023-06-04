<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


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
        
        echo "<td>" . $row['id_etude'] . "</td>";
        
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
        echo "<h1>Arborescence des dossiers</h1>";
        echo "<style>
            ul {
                list-style: none;
                padding-left: 20px;
            }
            
            ul li {
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
        </style>";
        
        echo "<ul>";
        afficherArborescence($cheminBase);
        echo "</ul>";
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



<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>SAE | Doc </title>
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
    <!-- forms CSS
		============================================ -->
    <link rel="stylesheet" href="css/form/all-type-forms.css">
    <!-- style CSS
		============================================ -->
    <link rel="stylesheet" href="style.css">
    <!-- responsive CSS
		============================================ -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- modernizr JS
		============================================ -->
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
    <!-- Start Left menu area -->
   
            <!-- Mobile Menu end -->
            <div class="breadcome-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="breadcome-list single-page-breadcome">
                                <div class="row">
                                    
                                        <ul class="breadcome-menu">
                                            <li><a href="#">La liste des études</a> <span class="bread-slash">/</span>
                                            </li>
                                            <li><span class="bread-blod">Détails de l'etude </span>
                                            </li>
                                        </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Single pro tab review Start-->
        <div class="single-pro-review-area mt-t-30 mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-payment-inner-st">
                            <ul id="myTabedu1" class="tab-review-design">
                                <li class="active"><a href="#description">Details étude</a></li>

                            </ul>
                            <div id="myTabContent" class="tab-content custom-product-edit">
                                <div class="product-tab-list tab-pane fade active in" id="description">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="review-content-section">
                                                <form method="post" id="add-department"  class="add-department" action="" >
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                            
                                                            <div class="form-group">
                                                                <label>Titre</label>
                                                                <?php echo $row['titre']; ?>
                                                                
                                                            </div> 
                                                            <div class="form-group">
                                                                <label>Phase</label>
                                                                <?php echo $row['phase']; ?>
                                                               
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Direction</label>
                                                                <?php echo $row['direction']; ?>
                                                               
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Date realisation</label>
                                                                <?php echo $row['date_realisation']; ?>
                                                               

                                                            </div>
                                                            <div class="form-group">
                                                                <label>Date acquisition</label>
                                                                <?php echo  $row['date_acquisition']; ?>
                                                                
                                                          
</div>
                                                            
                                                            
                                                           
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Codification</label>
                                                                <?php echo $row['codification'];; ?>
                                                                
                                                               
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Num CD</label>
                                                                <?php echo $row['num_cd'];?>
                                                              
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                                <label>Type</label>
                                                                <?php echo $row['type'];?>
                                                                
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Wilaya</label>
                                                                <?php echo $row['wilaya'];?>
                                                                
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Commun</label>
                                                                <?php echo $row['commun'];?>
                                                                
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                  
                                                    
                                                  
                                                </form>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
                                                            </div>
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
    <!-- morrisjs JS
		============================================ -->
    <script src="js/sparkline/jquery.sparkline.min.js"></script>
    <script src="js/sparkline/jquery.charts-sparkline.js"></script>
    <!-- calendar JS
		============================================ -->
    <script src="js/calendar/moment.min.js"></script>
    <script src="js/calendar/fullcalendar.min.js"></script>
    <script src="js/calendar/fullcalendar-active.js"></script>
    <!-- form validate JS
		============================================ -->
    <script src="js/form-validation/jquery.form.min.js"></script>
    <script src="js/form-validation/jquery.validate.min.js"></script>
    <script src="js/form-validation/form-active.js"></script>
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