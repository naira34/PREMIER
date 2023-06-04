<?php
session_start();

// Vérifier si l'utilisateur est connecté en tant qu'employé
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'agent') {
    header("Location: login.php");
    exit();
}

?>
<?php
// Inclure le fichier de configuration
require_once "config.php";

// Vérifier si l'ID de l'étude est passé dans l'URL
if (isset($_GET['id_etude'])) {
    // Récupérer l'ID de l'étude depuis l'URL
    $etude_id = $_GET['id_etude'];

    // Vérifier si le formulaire de mise à jour a été soumis
    if (isset($_POST['submit'])) {
        // Récupérer les données du formulaire
        $titre = mysqli_real_escape_string($link, $_POST['titre']);
        $direction = mysqli_real_escape_string($link, $_POST['direction']);
        $phase = $_POST['phase'];
        $date_realisation = mysqli_real_escape_string($link, $_POST['date_realisation']);
        $wilaya = mysqli_real_escape_string($link, $_POST['wilaya']);
        $date_acquisition = mysqli_real_escape_string($link, $_POST['date_acquisition']);
        $commun = mysqli_real_escape_string($link, $_POST['commun']);
        $num_cd = $_POST['num_cd'];
        $codification = mysqli_real_escape_string($link, $_POST['codification']);
        $type = mysqli_real_escape_string($link, $_POST['type']);

        // Mettre à jour l'étude dans la base de données
        $sql = "UPDATE etude SET titre='$titre', direction='$direction', phase='$phase', date_realisation='$date_realisation', date_acquisition='$date_acquisition', num_cd='$num_cd', codification='$codification', wilaya='$wilaya', commun='$commun', type='$type' WHERE id_etude='$etude_id'";

        if (mysqli_query($link, $sql)) {
            echo "L'étude a été mise à jour avec succès.<br>";
            // Rediriger l'utilisateur vers la page de liste des études après la mise à jour
            header("Location: agent_de_saisie.php?update=1");
            exit();
        } else {
            
            echo "Erreur lors de la mise à jour de l'étude : " . mysqli_error($link) . "<br>";
        }
    }

    // Récupérer les détails de l'étude à mettre à jour
    $sql = "SELECT * FROM etude WHERE id_etude='$etude_id'";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);

    // Fermer le résultat de la requête
    mysqli_free_result($result);
} else {
    // Rediriger l'utilisateur vers la page de liste des études si aucun ID n'est spécifié dans l'URL
    header("Location: liste_etudes.php");
    exit();
}
?>

<!DOCTYPE html>

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
<html>
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
                                <li><a title="All etude" href="agent_de_saisie.php"style="background-color:rgba(94, 92, 92, 0.043); color:rgb(79, 79, 79);"><span class="mini-sub-pro">Liste des etudes</span></a></li>
                                <li><a title="Add etude" href="ajouter-etude.php" ><span class="mini-sub-pro">Ajouter etude</span></a></li>                 
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
                                <li><span class="bread-blod">Modifier Etude
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
                      <li class="active"><a href="#description">Modifier une étude</a></li>
                      
                  </ul>
                  <div id="myTabContent" class="tab-content custom-product-edit">
                      <div class="product-tab-list tab-pane fade active in" id="description">
                          <div class="row">
                              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                  <div class="review-content-section">
                                      <div id="dropzone1" class="pro-ad addcoursepro">
   
    <form id="add-department"  class="add-department" action="" method="POST">
    <div class="row">
                                                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                      <div class="form-group">
        <label for="titre">Titre </label>
        <input type="text"  class="form-control" name="titre" value="<?php echo $row['titre']; ?>">
</div>
<div class="form-group">
        <label for="direction">Direction </label>
        <input type="text" class="form-control" name="direction" value="<?php echo $row['direction']; ?>">
</div>
        <div class="form-group">
        <label for="phase">Phase </label>
        <input type="number" class="form-control" name="phase" value="<?php echo $row['phase']; ?>">
        </div>
        <!-- Ajoutez ici les autres champs du formulaire avec les valeurs pré-remplies -->
        <div class="form-group">
        <label for="date_realisation">Date de réalisation </label>
        <input type="date"  class="form-control" name="date_realisation" value="<?php echo $row['date_realisation']; ?>">
</div>
        <div class="form-group">
        <label for="date_acquisition">Date d'acquisition </label>
        <input type="date" class="form-control" name="date_acquisition" value="<?php echo $row['date_acquisition']; ?>">
</div>
        
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
        <label for="num_cd">Numéro CD </label>
        <input type="number"  class="form-control" name="num_cd" value="<?php echo $row['num_cd']; ?>">
        </div>
  
        <div class="form-group">
        <label for="codification">Codification </label>
        <input type="text"  class="form-control" name="codification" value="<?php echo $row['codification']; ?>">
        </div>
        
        <div class="form-group">
    <label for="wilaya">Wilaya</label>
    <select name="wilaya" class="form-control"  class="form-control">
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
    <select name="commun" class="form-control"  class="form-control" value="<?php echo $commun; ?>" >
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
        <label for="type">Type </label>
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
    </select>
</div>

        </div>                                                     

    </div>
    <br>
    <div class="col-lg-12">
     <div class="payment-adress">
      <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#exampleModalCenter">Modifier étude</button>
      </div>
      <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modifieir étude</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      Voulez-vous vraiment modifier un étude ?
      </div>
      <div class="modal-footer">
      <button type="submit"  class="btn btn-primary waves-effect waves-light" name="submit">Mettre à jour</button>
        
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        
      </div>
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

<?php
// Fermer la connexion à la base de données
mysqli_close($link);
?>
