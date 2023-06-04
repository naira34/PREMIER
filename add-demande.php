<?php

require_once "config.php";
session_start();

// Vérifier si l'utilisateur est connecté en tant qu'employé
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'employe') {
    header("Location: login.php");
    exit();
}

// Récupérer l'ID de la personne connectée
$username = $_SESSION['username'];
$query = "SELECT id_personne FROM personne WHERE username='$username' AND role='employe'";
$result = mysqli_query($link, $query);
$row = mysqli_fetch_assoc($result);
$id_personne = $row['id_personne'];



?>
<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$demandeur = $direction = $departement = $atelier = $titre = $documment_ecrit = $documment_cartographie = $raster = $echelle = "";
$demandeur_err = $direction_err = $departement_err = $atelier_err = $titre_err = $documment_ecrit_err = $documment_cartographie_err = $raster_err = $echelle_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    $input_demandeur = trim($_POST["demandeur"]);
    if (empty($input_demandeur)) {
        $demandeur_err = "Please enter votre nom et prenom.";
    } elseif (!filter_var($input_demandeur, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $demandeur_err = "Please enter le nom correct.";
    } else {
        $demandeur = $input_demandeur;
    }

    $input_direction = trim($_POST["direction"]);
    $direction = $input_direction;

    $input_departement = trim($_POST["departement"]);
    $departement = $input_departement;

    // Validate atelier
    $input_atelier = trim($_POST["atelier"]);
    if (empty($input_atelier)) {
        $atelier_err = "Please enter votre atelier.";
    } else {
        $atelier = $input_atelier;
    }

    // Validate titre
    $input_titre = trim($_POST["titre"]);
    if (empty($input_titre)) {
        $titre_err = "Please enter titre.";
    } else {
        $titre = $input_titre;
    }

    // Validate documment_ecrit
    $input_documment_ecrit = trim($_POST["documment_ecrit"]);
    if (empty($input_documment_ecrit)) {
        $documment_ecrit_err = "Please enter le documment.";
    } else {
        $documment_ecrit = $input_documment_ecrit;
    }

    // Validate documment_cartographie
    $input_documment_cartographie = trim($_POST["documment_cartographie"]);
    if (empty($input_documment_cartographie)) {
        $documment_cartographie_err = "Please le documment.";
    } else {
        $documment_cartographie = $input_documment_cartographie;
    }

    $input_raster = trim($_POST["raster"]);
    $raster = $input_raster;

    // Validate echelle
    $input_echelle = trim($_POST["echelle"]);
    if (empty($input_echelle)) {
        $echelle_err = "Please enter l'echelle.";
    } else {
        $echelle = $input_echelle;
    }

    $date = $_POST['date'];

    // Check input errors before inserting in database
    if (empty($demandeur_err) && empty($atelier_err) && empty($titre_err) && empty($documment_ecrit_err) && empty($documment_cartographie_err) && empty($echelle_err) && empty($rater_err) && empty($direction_err) && empty($departement_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO demmandeinfo (id_personne, demandeur, direction, departement, atelier, titre, documment_ecrit, documment_cartographie, raster, echelle, date) VALUES (?,?,?,?,?,?,?,?,?,?,?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssssssss", $param_id_personne, $param_demandeur, $param_direction, $param_departement, $param_atelier, $param_titre, $param_documment_ecrit, $param_documment_cartographie, $param_raster, $param_echelle, $param_date);

            // Set parameters
            $param_id_personne = $id_personne;+
            $param_demandeur = $demandeur;
            $param_direction = $direction;
            $param_departement = $departement;
            $param_atelier = $atelier;
            $param_titre = $titre;
            $param_documment_ecrit = $documment_ecrit;
            $param_documment_cartographie = $documment_cartographie;
            $param_raster = $raster;
            $param_echelle = $echelle;
            $param_date = $date;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Records created successfully. Redirect to landing page
                echo '<script type="text/javascript">';
                echo '$(document).ready(function(){';
                echo '$("#myModal").modal("show");';
                echo '});';
                echo '</script>';
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
}
?>

<!doctype html>
<html class="no-js" lang="en">

<head><meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>SAE</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <style>
    .invalid-feedback{
        color:red;
    }
 </style>
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
<div id="PrimaryModalalert" class="modal modal-edu-general default-popup-PrimaryModal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-close-area modal-close-df">
                                        <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                                    </div>
                                    <div class="modal-body">
                                        <i class="educate-icon educate-checked modal-check-pro"></i>
                                        <h2>Awesome!</h2>
                                        <p>The Modal plugin is a dialog box/popup window that is displayed on top of the current page</p>
                                    </div>
                                    <div class="modal-footer">
                                        <a data-dismiss="modal" href="#">Cancel</a>
                                        <a href="#">Process</a>
                                    </div>
                                </div>
                            </div>
                        </div>
    <div class="left-sidebar-pro">
        <nav id="sidebar" class="">
            <div class="sidebar-header">
                <a href="index.html"><img class="main-logo" src="img/logo/logo.png" style="width: 120px;" alt="" /></a>
                <strong><a href="index.html"><img src="img/logo/logo.png" alt="" /></a></strong>
            </div>
            <div class="left-custom-menu-adp-wrap comment-scrollbar">
                <nav class="sidebar-nav left-sidebar-menu-pro">
                    <ul class="metismenu" id="menu1">
                        <li class="active">
                            <a class="has-arrow" href="index.html">
                                <span class="educate-icon educate-course icon-wrap"></span>
								   <span class="mini-click-non">les etudes</span>
								</a>
                            <ul class="submenu-angle" aria-expanded="true">
                                <li><a title="All Courses" href="listeetudeempl.html"><span class="mini-sub-pro">Liste des etudes</span></a></li>
                                                </ul>
                        </li>
                       
                       
                        <li class="">
                            <a class="has-arrow" href="mailbox.html" aria-expanded="false"><span class="educate-icon educate-data-table icon-wrap"></span> <span class="mini-click-non">Demande d'info</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                            
                                <li><a title="All demandes" href="demandeinfo.html"><span class="mini-sub-pro">ajouter une demande </span></a></li>
                            </ul>
                        </li>
                        
                        <li>
                            <a class="has-arrow" href="mailbox.html" aria-expanded="false"><span class="educate-icon educate-data-table icon-wrap"></span> <span class="mini-click-non">Data Tables</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a title="Peity Charts" href="static-table.html"><span class="mini-sub-pro">Static Table</span></a></li>
                                <li><a title="Data Table" href="data-table.html"><span class="mini-sub-pro">Data Table</span></a></li>
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
                        <a href="index.html"><img class="main-logo" src="img/logo/logo.png"style="width: 100px;"alt="" /></a>
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
                                        <div class="header-top-menu tabl-d-n">
                                            <ul class="nav navbar-nav mai-top-nav">
                                                <li class="nav-item"><a href="#" class="nav-link">Home</a>
                                                </li>
                                                <li class="nav-item"><a href="#" class="nav-link">About</a>
                                                </li>
                                                
                                                <li class="nav-item dropdown res-dis-nn">
                                                    <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">Project <span class="angle-down-topmenu"><i class="fa fa-angle-down"></i></span></a>
                                                    <div role="menu" class="dropdown-menu animated zoomIn">
                                                        <a href="#" class="dropdown-item">Documentation</a>
                                                        <a href="#" class="dropdown-item">Expert Backend</a>
                                                        <a href="#" class="dropdown-item">Expert FrontEnd</a>
                                                        <a href="#" class="dropdown-item">Contact Support</a>
                                                    </div>
                                                </li>
                                                </li>
                                            </ul>
                                        </div>
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
															<span class="admin-name"> <?php echo $_SESSION["employe"]?></span>
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
                <div class="breadcome-list">
                    <div class="row">
                        
                        
                            <ul class="breadcome-menu">
                                <li><a href="#">demande d'information</a> 
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
                        <li class="active"><a href="#description">demande d'information</a></li>
                        
                    </ul>
                    <div id="myTabContent" class="tab-content custom-product-edit">
                        <div class="product-tab-list tab-pane fade active in" id="description">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="review-content-section">
                                        <div id="dropzone1" class="pro-ad addcoursepro">
                                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="dropzone dropzone-custom needsclick addlibrary" id="demo1-upload">
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label>Demandeur</label>
                                                         
                                                          
                                                            <input name="demandeur" type="text" class="form-control <?php echo (!empty($demandeur_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $demandeur; ?>" placeholder="Entrer votre nom ">
                                                            <span class="invalid-feedback"><?php echo $demandeur_err;?></span>
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label>Direction</label>
                                                            <select id="direction"name="direction" class="form-control " value="<?php echo $direction; ?>">
                                                                <option value="none" selected="" disabled="">Selectionner la direction direction</option>
                                                                <option value="DEOA">Direction des Etudes Opérationnelles et d'Architecture</option>
                                                                <option value="DGERA">Direction des Grandes Etudes et de la Recherche Appliquée</option>
                                                                <option value="DPFI">Direction de la Promotion Fonciére et Immobilliére</option>
                                                                <option value="DAF">Direction de l'Administration et des Finances </option>
                                                                
                                                               
                                                            </select> 
                                                            
                                                         </div>
                                                        
                                                        
                                                   <div class="form-group">
                                                    <label>Atelier</label>
                                                    <input type="text" name="atelier" class="form-control <?php echo (!empty($atelier_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $atelier; ?>"placeholder="Entrer votre atelier ">
                                                    <span class="invalid-feedback"><?php echo $atelier_err;?></span>
                                                      <div class="file-upload-inner ts-forms">
                                                          
                                                              
                                                              
                                                           
                                                         
                                                      </div>
                                                  
                                                   </div>
                                                   
                                                   <div class="form-group">
                                                    <label> Document ecrit</label>
                                                   
                                                      <div class="file-upload-inner ts-forms">
                                                          
                                                              
                                                              
                                                            <input name="documment_ecrit" type="text" class="form-control <?php echo (!empty($documment_ecrit_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $documment_ecrit; ?>" placeholder="Entrer le document ecrite">
                                                            <span class="invalid-feedback"><?php echo $documment_ecrit_err;?></span>
                                                      </div>
                                                  
                                                   
                                                  
                                                   </div>
                                                        <label>document cartographique</label>
                                                      
                                                            <input name="documment_cartographie" type="text"  placeholder="Entrer le document cartographie" class="form-control <?php echo (!empty($documment_cartographie_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $documment_cartographie; ?>" placeholder="Entrer le document ecrite">
                                                            <span class="invalid-feedback"><?php echo $documment_cartographie_err;?></span>
                                                        
                                                    </div>
                                                        
                                                            
                                                      
                                               
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label>Titre d'information</label>
                                                            <input name="titre" type="text" placeholder="Entrer le document cartographie" class="form-control <?php echo (!empty($titre_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $titre; ?>">
                                                            <span class="invalid-feedback"><?php echo $titre_err;?></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Department</label>
                                                            <select id="departement" name="departement" class="form-control " value="<?php echo $departement; ?>">
                                                                <label>Select dapartment </label>
                                                               
                                                                <option id="departement" name="departement" value="none">selectionner sous type</option>
                                                                
                                                            </select>
                                                            <script>
                                                                var selectType = document.getElementById("direction");
                                                                var selectSousType = document.getElementById("departement");
                                                        
                                                                selectType.addEventListener("change", function() {
                                                                    if (selectType.value === "DEOA") {
                                                                        selectSousType.innerHTML = ""; // On efface la liste précédente
                                                        
                                                                        var option1 = document.createElement("option");
                                                                        option1.value = "DEUO";
                                                                        option1.text = "Département des Etudes d'Urbanisme Opérationnel";
                                                                        selectSousType.add(option1);
                                                        
                                                                        var option2 = document.createElement("option");
                                                                        option2.value = "DEUG";
                                                                        option2.text = "Département des Etudes d'Urbanisme Géneral";
                                                                        selectSousType.add(option2);

                                                                        var option3 = document.createElement("option");
                                                                        option3.value = "DSS";
                                                                        option3.text = "Département Soutien et Suivi";
                                                                        selectSousType.add(option3); 

                                                                        var option5 = document.createElement("option");
                                                                        option5.value = "DEI";
                                                                        option5.text = "Département Des Etudes Infratstructure";
                                                                        selectSousType.add(option5); 

                                                                        var option4 = document.createElement("option");
                                                                        option4.value = "DAAU";
                                                                        option4.text = "Département de l'Architecture et de l'Amélioration Urbaine";
                                                                        selectSousType.add(option4);
                                                                    }
                                                                    else {

                                                                        if (selectType.value === "DGERA") {
                                                                        selectSousType.innerHTML = ""; // On efface la liste précédente
                                                        
                                                                        var option1 = document.createElement("option");
                                                                        option1.value = "DEG";
                                                                        option1.text = "Département des Etudes  urbanisme génerales ";
                                                                        selectSousType.add(option1);
                                                        
                                                                        var option2 = document.createElement("option");
                                                                        option2.value = "DES ";
                                                                        option2.text = " Département des Etudes spéicifaique";
                                                                        selectSousType.add(option2);

                                                                    
                                                                        var option3 = document.createElement("option");
                                                                        option3.value = "DATRA";
                                                                        option3.text = "Département d'amenagement du territoire et recherche appliquée";
                                                                        selectSousType.add(option3);

                                                                        
                                                                    }else{
                                                                        if (selectType.value === "DPFI") {
                                                                        selectSousType.innerHTML = ""; // On efface la liste précédente
                                                        
                                                                        var option1 = document.createElement("option");
                                                                        option1.value = "DPF";
                                                                        option1.text = "Département de La promotion Fonciére";
                                                                        selectSousType.add(option1);
                                                        
                                                                        var option2 = document.createElement("option");
                                                                        option2.value = "DPI";
                                                                        option2.text = "Département de la Promotion Immobiliére";
                                                                        selectSousType.add(option2);
                                                                    }
                                                                    else {
                                                                        if (selectType.value === "DAF") {
                                                                        selectSousType.innerHTML = ""; // On efface la liste précédente
                                                        
                                                                        var option1 = document.createElement("option");
                                                                        option1.value = "DRHS";
                                                                        option1.text = "Département Des Ressources Humaines et de la Sécurité";
                                                                        selectSousType.add(option1);
                                                        
                                                                        var option2 = document.createElement("option");
                                                                        option2.value = "DMG";
                                                                        option2.text = "Département des Moyens Généraux ";
                                                                        selectSousType.add(option2);

                                                                        var option3 = document.createElement("option");
                                                                        option3.value = "DIFD";
                                                                        option3.text = "Département de l'Informatique ,La Formation et la Documentation";
                                                                        selectSousType.add(option3);

                                                                        var option4 = document.createElement("option");
                                                                        option4.value = "DF";
                                                                        option4.text = "Département des Finances ";
                                                                        selectSousType.add(option4);

                                                                        var option4 = document.createElement("option");
                                                                        option4.value = "DCG";
                                                                        option4.text = "Département de la Comptabilité Générale";
                                                                        selectSousType.add(option4);
                                                                    }
                                                                   
                                                                    }
                                                                    }
                                                                }
                                                                });</script>
                                                                
                                                        </div>
                                                        
                                                        
                                                        <div class="form-group">
                                                            <label>raster</label>
                                                            <select id="raster"name="raster" class="form-control " value="<?php echo $raster; ?>">
                                                                <label>Select dapartment </label>
                                                               
                                                                <option value="none">selectionner le raster </option>
                                                                <option value="0">raster</option>
                                                                <option value="1">raster</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label> echelle</label>
                                                            <input name="echelle" type="text" class="form-control <?php echo (!empty($echlle_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $echelle; ?>"placeholder="Entrer l'echelle ">
                                                    <span class="invalid-feedback"><?php echo $echelle_err;?></span>
                                                        </div>
                                                        <div class="form-group">
                                                      <input type="hidden" name="date" value="<?php echo date('Y-m-d '); ?>"></div>
                                                    </div>
                                                    
                                                </div>  
                                                <br>
                                                <br>
                                               
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="payment-adress">
                                                        <button type="submit"value="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
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
  