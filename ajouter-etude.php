<?php
session_start();

// Vérifier si l'utilisateur est connecté en tant qu'employé
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'agent') {
    header("Location: login.php");
    exit();
}

?>
<?php
// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs du formulaire
    $titre = $_POST['titre'];
    $phase = $_POST['phase'];
    $direction = $_POST['direction'];
    $date_realisation = $_POST['date_realisation'];
    $date_acquisition = $_POST['date_acquisition'];
    $codification = $_POST['codification'];
    $num_cd = $_POST['num_cd'];
    $wilaya = $_POST['wilaya'];
    $commun = $_POST['commun'];
    $type = $_POST['type'];

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

    // Requête d'insertion
    $sql = "INSERT INTO etude (titre, phase, direction, date_realisation, date_acquisition, codification, num_cd, wilaya, commun, type)
            VALUES ('$titre', '$phase', '$direction', '$date_realisation', '$date_acquisition', '$codification', '$num_cd', '$wilaya', '$commun', '$type')";

    if ($conn->query($sql) === TRUE) {
        header("location: agent_de_saisie?add=1.php");
        

        // Construction du nom du dossier
        $dossierNom = $titre;

        // Création du dossier principal
        $dossierPrincipal = $dossierNom;
        if (!mkdir($dossierPrincipal)) {
            die("Erreur lors de la création du dossier principal.");
        }

        // Création du dossier "document ecrit"
        $dossierEcrit = $dossierPrincipal . '/document ecrit';
        if (!mkdir($dossierEcrit)) {
            die("Erreur lors de la création du dossier 'document ecrit'.");
        }

        // Création du dossier "document cartographie"
        $dossierCartographie = $dossierPrincipal . '/document cartographie';
        if (!mkdir($dossierCartographie)) {
            die("Erreur lors de la création du dossier 'document cartographie'.");
        }

        // Parcourir tous les fichiers téléchargés pour "document ecrit"
        foreach ($_FILES['documents_ecrits']['tmp_name'] as $key => $tmp_name) {
            // Nom du fichier
            $filename = $_FILES['documents_ecrits']['name'][$key];

            // Déplacer le fichier vers le répertoire de destination
            $target_file = $dossierEcrit . '/' . $filename;
            move_uploaded_file($tmp_name, $target_file);
        }

        // Parcourir tous les fichiers téléchargés pour "document cartographie"
        foreach ($_FILES['documents_cartographie']['tmp_name'] as $key => $tmp_name) {
            // Nom du fichier
            $filename = $_FILES['documents_cartographie']['name'][$key];

            // Déplacer le fichier vers le répertoire de destination
            $target_file = $dossierCartographie . '/' . $filename;
            move_uploaded_file($tmp_name, $target_file);
        }
    } else {
        echo "Erreur lors de l'ajout de l'étude : " . $conn->error;
    }

    // Fermer la connexion
    $conn->close();
}
?>



<!doctype html>
<html class="no-js" lang="en">

<head><meta charset="utf-8">
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
  <!-- modals CSS
  ============================================ -->
  <link rel="stylesheet" href="css/modals.css">
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
   

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
</head>

<body>
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
                                <li><a title="All etude" href="agent_de_saisie.php"><span class="mini-sub-pro">Liste des etudes</span></a></li>
                                <li><a title="Add etude" href="ajouter-etude.php" style="background-color:rgba(94, 92, 92, 0.043); color:rgb(79, 79, 79);"><span class="mini-sub-pro">Ajouter etude</span></a></li>                 
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
															<span class="admin-name">Agent de sasie</span>
															<i class="fa fa-angle-down edu-icon edu-down-arrow"></i>
														</a>
                                                    <ul role="menu" class="dropdown-header-top author-log dropdown-menu animated zoomIn">
                                                        <li><a href="#"><span class="edu-icon edu-settings author-log-ic"></span>Settings</a>
                                                        </li>
                                                        <li><a href="#"><span class="edu-icon edu-locked author-log-ic"></span>Log Out</a>
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
                                    <li><a href="agent_de_saisie.php">Dashboard v.1</a></li>
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
                <div class="breadcome-list">
                    <div class="row">
                        
                        
                            <ul class="breadcome-menu">
                                <li><a href="#">Les etudes</a> <span class="bread-slash">/</span>
                                </li>
                                <li><span class="bread-blod">Ajouter Etude
                                </span>
                                </li>
                            </ul>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<div class="single-pro-review-area mt-t-30 mg-b-15">
  <div class="container-fluid">
      <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="product-payment-inner-st">
                  <ul id="myTabedu1" class="tab-review-design">
                      <li class="active"><a href="#description">Ajouter etude</a></li>
                      
                  </ul>
                  <div id="myTabContent" class="tab-content custom-product-edit">
                      <div class="product-tab-list tab-pane fade active in" id="description">
                          <div class="row">
                              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                  <div class="review-content-section">
                                      <div id="dropzone1" class="pro-ad addcoursepro"> 
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
 <div class="row">
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                      
        <div class="form-group">
         <label for="titre">Titre</label>
        <input type="text" name="titre"class="form-control" placeholder="Enter le titre" id="titre" required>
        </div>
        <div class="form-group">
        <label for="phase">Phase </label>
        <input type="number" min="1" max="6"  class="form-control" placeholder="Enter num de phase" name="phase" id="phase" required>
</div>
<div class="form-group">
        <label for="direction">Direction</label>
   
        <select id="direction" name="direction"class="form-control">
                                                          <option value="none" selected="" disabled="">Selectionner la direction </option>
                                                                 <option value="DEOA">Direction des Etudes Opérationnelles et d'Architecture</option>
                                                                 <option value="DGERA">Direction des Grandes Etudes et de la Recherche Appliquée</option>
                                                                 <option value="DPFI">Direction de la Promotion Fonciére et Immobilliére</option>
                                                                 <option value="DAF">Direction de l'Administration et des Finances </option>
                                                             
                                                          </select>
</div>
<div class="form-group">
        <label for="date_realisation">Date de réalisation </label>
        <input type="date" name="date_realisation" class="form-control"  id="date_realisation" required>
</div>
<div class="form-group">
        <label for="date_acquisition">Date d'acquisition </label>
        <input type="date" name="date_acquisition" class="form-control" id="date_acquisition" required>
</div>
</div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
        <label for="codification">Codification </label>
        <input type="text" name="codification" class="form-control" placeholder="Enter la codification" id="codification" required>
</div>
        <div class="form-group">
        <label for="num_cd">Numéro du CD </label>
        <input type="text" class="form-control" placeholder="Enter le num cd" name="num_cd" id="num_cd" required>
        </div>

        <div class="form-group"> 
<label for="wilaya">Wilaya </label>
        <select name="wilaya" class="form-control" >
                                                          <?php
    // Connexion à la base de données
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "sae";
		$conn = new mysqli($servername, $username, $password, $dbname);

		// Vérifier la connexion
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		}



    // Retrieve list of wilayas from database
    $sql = "SELECT id_wilaya ,nom_wilaya FROM wilaya";
    $result = mysqli_query($conn, $sql);

    // Loop through list of wilayas and display in dropdown menu
    while ($row = mysqli_fetch_assoc($result)) {
      echo '<option value="' . $row['nom_wilaya'] . '">' . $row['nom_wilaya'] . '</option>';
    }

    $conn->close();
    ?>
</select>

        </div>
        

<div class="form-group">
        <label for="commun">Commun</label>
        <select name="commun" class="form-control" >
                                                          <?php
    // Connexion à la base de données
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "sae";
		$conn = new mysqli($servername, $username, $password, $dbname);

		// Vérifier la connexion
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		}



    // Retrieve list of wilayas from database
    $sql = "SELECT id_commun ,nom_commun FROM commun";
    $result = mysqli_query($conn, $sql);

    // Loop through list of wilayas and display in dropdown menu
    while ($row = mysqli_fetch_assoc($result)) {
      echo '<option value="' . $row['nom_commun'] . '">' . $row['nom_commun'] . '</option>';
    }

    $conn->close();
    ?>
                                                          </select>
                                                      </div>
      <div class="form-group">
        <label for="type">Type</label>
        <select name="type"  class="form-control">
                                                         <?php
   // Connexion à la base de données
       $servername = "localhost";
       $username = "root";
       $password = "";
       $dbname = "sae";
       $conn = new mysqli($servername, $username, $password, $dbname);

       // Vérifier la connexion
       if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
       }



   // Retrieve list of wilayas from database
   $sql = "SELECT id_type,nom_type FROM type";
   $result = mysqli_query($conn, $sql);

   // Loop through list of wilayas and display in dropdown menu
   while ($row = mysqli_fetch_assoc($result)) {
     echo '<option value="' . $row['nom_type'] . '">' . $row['nom_type'] . '</option>';
   }

   $conn->close();
   ?>
                                                         </select></div>
                                                         

</div>      
<label for="documents_ecrits">Documents écrits :</label>
        <input type="file" name="documents_ecrits[]" id="documents_ecrits" multiple><br>       
<label for="documents_cartographie">Documents cartographie :</label>
        <input type="file" name="documents_cartographie[]" id="documents_cartographie" multiple><br>

        
        <div class="col-lg-12">
                                                            <div class="payment-adress">
                                                            <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#exampleModalCenter">Ajouter type</button>
                                                            </div>
                                                        </div>
                                                    <!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Ajouter étude</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      Voulez-vous vraiment ajouter un étude ?
      </div>
      <div class="modal-footer">
      <input type="submit" class="btn btn-primary waves-effect waves-light" value="Ajouter">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        
      </div>
    </div>
  </div>
</div>
    </form>
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
<!-- maskedinput JS
============================================ -->
<script src="js/jquery.maskedinput.min.js"></script>
<script src="js/masking-active.js"></script>
<!-- datepicker JS
============================================ -->
<script src="js/datepicker/jquery-ui.min.js"></script>
<script src="js/datepicker/datepicker-active.js"></script>
<!-- form validate JS
============================================ -->
<script src="js/form-validation/jquery.form.min.js"></script>
<script src="js/form-validation/jquery.validate.min.js"></script>
<script src="js/form-validation/form-active.js"></script>
<!-- dropzone JS
============================================ -->
<script src="js/dropzone/dropzone.js"></script>
<!-- tab JS
============================================ -->
<script src="js/tab.js"></script>
<!-- plugins JS
============================================ -->
<script src="js/plugins.js"></script>
<!-- main JS
============================================ -->
<script src="js/main.js"></script>

</body>

</html>
