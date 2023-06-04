<?php
session_start();

// Vérifier si l'utilisateur est connecté en tant qu'employé
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}





// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values 
$nom_personne = $prenom = $email = $direction = $departement = $atelier = $structure = $fonction = $username = $password = $role = "";
$nom_personne_err = $prenom_err = $email_err = $atelier_err = $structure_err = $fonction_err = $username_err = $password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"  && !empty($_POST)){
    // Validate nom_personne
    $input_nom_personne = trim($_POST["nom_personne"]);
    if(empty($input_nom_personne)){
        $nom_personne_err = "Please enter a nom_personne.";
    } elseif(!filter_var($input_nom_personne, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $nom_personne_err = "Please enter a valid nom_personne.";
    } else{
        $nom_personne = $input_nom_personne;
    }
    
    // Validate prenom 
    $input_prenom = trim($_POST["prenom"]);
    if(empty($input_prenom)){
        $prenom_err = "Please enter a prenom.";
    } elseif(!filter_var($input_prenom, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $prenom_err = "Please enter a valid prenom.";
    } else{
        $prenom = $input_prenom;
    }
   
    //Validate email 
    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = "Please enter an email.";     
    } else{
        $email = $input_email;
    }

    

    // Validate direction
    $input_direction = trim($_POST["direction"]);
    {
        $direction = $input_direction;
    }
    

    //Validate departement
    $input_departement = trim($_POST["departement"]);
    {$departement = $input_departement;}
        



    // Validate atelier
    $input_atelier = trim($_POST["atelier"]);
    if(empty($input_atelier)){
        $ateliere_err = "Please enter an atelier.";     
    } else{
        $atelier = $input_atelier;
    }
 
    // Validate fonction
    $input_fonction = trim($_POST["fonction"]);
    if(empty($input_fonction)){
        $fonction_err = "Please enter an fonction.";     
    } else{
        $fonction = $input_fonction;
    }
    // Validate structure
    $input_structure = trim($_POST["structure"]);
    if(empty($input_structure)){
        $structure_err = "Please enter an structure.";     
    } else{
        $structure = $input_structure;
    }

   
    $username = $input_nom_personne . '.' . $input_prenom;

    $input_password = trim($_POST["password"]);
    if(empty($input_password)){
        $password_err = "Please enter an password.";     
    } else{
        $password = $input_password;
    }
    
    $input_role = trim($_POST["role"]);
    {$role = $input_role;}
        
    
    // Check input errors before inserting in database 
    if(empty($nom_personne_err) && empty($prenom_err) && empty($atelier_err) && empty($structure_err ) && empty($fonction_err)) 
    {
        // Prepare an insert statement 
        $sql = "INSERT INTO personne (nom_personne,	prenom,	email, direction, departement, atelier, structure, fonction, username, password, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters 
            mysqli_stmt_bind_param($stmt, "sssssssssss", $param_nom_personne, $param_prenom, $param_email, $param_direction, $param_departement, $param_atelier, $param_structure, $param_fonction, $param_username, $param_password, $param_role);
            
            // Set parameters
            $param_nom_personne= $nom_personne;
            $param_prenom = $prenom;
            $param_email = $email; 
            $param_direction = $direction;
            $param_departement = $departement;
            $param_atelier = $atelier;
            $param_structure = $structure; 
            $param_fonction = $fonction;
            $param_username = $username;
            $param_password = $password;
            $param_role = $role;
            
            
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: userliste.php?add=1");
                exit();
            } else{
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

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>SAE | Admin </title>
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
    <div class="left-sidebar-pro">
        <nav id="sidebar" class="">
            <div class="sidebar-header">
                <a href="admin.php"><img class="main-logo" src="img/logo/logo.png" style="width: 120px;" alt="" /></a>
                <strong><a href="admin.php"><img src="img/logo/logo.png" alt="" /></a></strong>
            </div>
            <br>
            <div class="left-custom-menu-adp-wrap comment-scrollbar">
                <nav class="sidebar-nav left-sidebar-menu-pro">
                    <ul class="metismenu" id="menu1">
                            <li>
                                <a class="has-arrow" href="admin.php">
                                    <span class="educate-icon educate-course icon-wrap"></span>
                                       <span class="mini-click-non">Les etudes</span>
                                    </a>
                                <ul class="submenu-angle" aria-expanded="false">
                                    <li><a title="All etude" href="admin.php"><span class="mini-sub-pro">Liste des etudes</span></a></li>
                                </ul>
                            </li>
                     
                        
                            <li class="active">
                            <a class="has-arrow" href="userliste.html" aria-expanded="false"> <i class="fa fa-users text-info" style="color: #999999;"></i> <span class="mini-click-non">Users</span></a>
                            <ul class="submenu-angle" aria-expanded="true">
                                <li><a title="All users" href="userliste.php"><span class="mini-sub-pro">La liste des utilisateurs</span></a></li>
                                <li><a title="Add user" href="add-user.php" style="background-color:rgba(94, 92, 92, 0.043); color:rgb(79, 79, 79);"><span class="mini-sub-pro">Ajouter utilisateur</span></a></li>
                            </ul>
                        
                            <li>
                            <a class="has-arrow" href="mailbox.html" aria-expanded="false"><span class="educate-icon educate-data-table icon-wrap"></span> <span class="mini-click-non">Demande d'info</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a title="All demandes" href="la-liste-demande-info.php"><span class="mini-sub-pro">Liste des demandes </span></a></li>
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
															<span class="admin-name">Administrateur réseau</span>
															<i class="fa fa-angle-down edu-icon edu-down-arrow"></i>
														</a>
                                                    <ul role="menu" class="dropdown-header-top author-log dropdown-menu animated zoomIn">
                                                        <li><a href="#"><span class="edu-icon edu-settings author-log-ic"></span>Settings</a>
                                                        </li>
                                                        <li><a href="logout.php"><span class="edu-icon edu-locked author-log-ic">Déconnexion</span></a>
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
            <!-- Mobile Menu start --><div class="mobile-menu-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="mobile-menu">
                                <nav id="dropdown">
                                    <ul class="mobile-menu-nav">
                                        <li><a data-toggle="collapse" data-target="#Charts" href="#">Etudes <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                            <ul class="collapse dropdown-header-top">
                                                <li><a href="index.html">Dashboard v.1</a></li>
                                                <li><a href="index-1.html">Dashboard v.2</a></li>
                                               
                                            </ul>
                                        </li>
                                        <li><a data-toggle="collapse" data-target="#Charts" href="#">Users <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                            <ul class="collapse dropdown-header-top">
                                                <li><a href="userliste.html">La liste des utilisateur</a></li>
                                                <li><a href="add-user.html">Ajouter utilisateur</a></li>
                                               
                                            </ul>
                                        </li>
                                        <li><a data-toggle="collapse" data-target="#Charts" href="#">Demande d'info<span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                            <ul class="collapse dropdown-header-top">
                                                <li><a href="index.html">Liste des demandes</a></li>
                                               
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
                                            <li><a href="#">Users</a> <span class="bread-slash">/</span>
                                            </li>
                                            <li><span class="bread-blod">Ajouter utilisateur</span>
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
                                <li class="active"><a href="#description">Ajouter un utilisateur et son compte</a></li>
        

                            </ul>
                            <div id="myTabContent" class="tab-content custom-product-edit">
                                <div class="product-tab-list tab-pane fade active in" id="description">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="review-content-section">
                                                <form method="post" id="add-department"  class="add-department" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                            
                                                            <div class="form-group">
                                                                <label>Nom</label>
                                                                <input type="text" name="nom_personne" class="form-control"  placeholder="Veuillez entrer un nom"  required <?php echo (!empty($nom_personne_err)) ? 'is-invalid' : ''; ?> value="<?php echo $nom_personne; ?>">
                                                                <span class="invalid-feedback"><?php echo $nom_personne_err;?></span>
                                                            </div> 
                                                            <div class="form-group">
                                                                <label>Prenom</label>
                                                                <input type="text" name="prenom" class="form-control"  placeholder="Veuillez entrer un prenom" required <?php echo (!empty($prenom_err)) ? 'is-invalid' : ''; ?> value="<?php echo $prenom; ?>">
                                                                <span class="invalid-feedback"><?php echo $prenom_err;?></span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Email</label>
                                                                <input type="email" name="email" class="form-control"  placeholder="Veuillez entrer un email"  <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?> value="<?php echo $email; ?>">
                                                                <span class="invalid-feedback"><?php echo $email_err;?></span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Direction</label>
                                                                <select  id="direction" name="direction" class="form-control" required <?php echo (!empty($direction_err)) ? 'is-invalid' : ''; ?> value="<?php echo $direction; ?>">
                                                                    <option value="none" selected="" disabled="">Select Direction</option>
                                                                    <option value="DEOA">Direction des Etudes Opérationnelles et d'Architecture</option>
                                                                    <option value="DGERA">Direction des Grandes Etudes et de la Recherche Appliquée</option>
                                                                    <option value="DPFI">Direction de la Promotion Fonciére et Immobilliére</option>
                                                                    <option value="DAF">Direction de l'Administration et des Finances </option>
                                                                </select>

                                                            </div>
                                                            <div class="form-group">
                                                                <label>Departement</label>
                                                                <select id="departement" name="departement" class="form-control" required  value="<?php echo $departement; ?>">
                                                                    <option   value="none" selected="" disabled="">Select Departement</option>
                                                                    
                                                                </select>
                                                          
                                                                <script>
                                                                var selectType = document.getElementById("direction");
                                                                var selectSousType = document.getElementById("departement");
                                                        
                                                                selectType.addEventListener("change", function() {
                                                                    if (selectType.value === "DEOA") {
                                                                        selectSousType.innerHTML = ""; // On efface la liste précédente
                                                        
                                                                        var option1 = document.createElement("option");
                                                                        option1.value = "D.E.U.O";
                                                                        option1.text = "Département des Etudes d'Urbanisme Opérationnel";
                                                                        selectSousType.add(option1);
                                                        
                                                                        var option2 = document.createElement("option");
                                                                        option2.value = "D.E.U.G";
                                                                        option2.text = "Département des Etudes d'Urbanisme Géneral";
                                                                        selectSousType.add(option2);

                                                                        var option3 = document.createElement("option");
                                                                        option3.value = "D.E.I";
                                                                        option3.text = "Département des Etudes d'Infrastructures";
                                                                        selectSousType.add(option3); 


                                                                        var option4 = document.createElement("option");
                                                                        option4.value = "D.S.S";
                                                                        option4.text = "Département Soutien et Suivi";
                                                                        selectSousType.add(option4); 

                                                                        var option5 = document.createElement("option");
                                                                        option5.value = "D.A.A.U";
                                                                        option5.text = "Département de l'Architecture et de l'Amélioration Urbaine";
                                                                        selectSousType.add(option5);
                                                                    }
                                                                    else {

                                                                        if (selectType.value === "DGERA") {
                                                                        selectSousType.innerHTML = ""; // On efface la liste précédente
                                                        
                                                                        var option1 = document.createElement("option");
                                                                        option1.value = "D.E.U.G";
                                                                        option1.text = "Département des Etudes  urbanisme génerales ";
                                                                        selectSousType.add(option1);
                                                        
                                                                        var option2 = document.createElement("option");
                                                                        option2.value = "D.E.U.O";
                                                                        option2.text = "Département des Etudes urbanisme operationnel ";
                                                                        selectSousType.add(option2);

                                                                    
                                                                        var option3 = document.createElement("option");
                                                                        option3.value = "D.A.T.R.A";
                                                                        option3.text = "Département d'amenagement du territoire et recherche appliquée";
                                                                        selectSousType.add(option3);

                                                                        
                                                                    }else{
                                                                        if (selectType.value === "DPFI") {
                                                                        selectSousType.innerHTML = ""; // On efface la liste précédente
                                                        
                                                                        var option1 = document.createElement("option");
                                                                        option1.value = "D.P.F";
                                                                        option1.text = "Département de La promotion Fonciére";
                                                                        selectSousType.add(option1);
                                                        
                                                                        var option2 = document.createElement("option");
                                                                        option2.value = "D.P.I";
                                                                        option2.text = "Département de la Promotion Immobiliére";
                                                                        selectSousType.add(option2);
                                                                    }
                                                                    else {
                                                                        if (selectType.value === "DAF") {
                                                                        selectSousType.innerHTML = ""; // On efface la liste précédente
                                                        
                                                                        var option1 = document.createElement("option");
                                                                        option1.value = "D.R.H.S";
                                                                        option1.text = "Département Des Ressources Humaines et de la Sécurité";
                                                                        selectSousType.add(option1);
                                                        
                                                                        var option2 = document.createElement("option");
                                                                        option2.value = "D.M.G";
                                                                        option2.text = "Département des Moyens Généraux ";
                                                                        selectSousType.add(option2);

                                                                        var option3 = document.createElement("option");
                                                                        option3.value = "D.I.F.D";
                                                                        option3.text = "Département de l'Informatique ,La Formation et la Documentation";
                                                                        selectSousType.add(option3);

                                                                        var option4 = document.createElement("option");
                                                                        option4.value = "D.F";
                                                                        option4.text = "Département des Finances ";
                                                                        selectSousType.add(option4);

                                                                        var option4 = document.createElement("option");
                                                                        option4.value = "D.C.G";
                                                                        option4.text = "Département de la Comptabilité Générale";
                                                                        selectSousType.add(option4);
                                                                    }
                                                                   
                                                                    }
                                                                    }
                                                                }
                                                                });</script>
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                                <label>Atelier</label>
                                                                <input type="text" name="atelier" class="form-control" required placeholder="Veuillez entrer un atelier" <?php echo (!empty($atelier_err)) ? 'is-invalid' : ''; ?> value="<?php echo $atelier; ?>">
                                                                <span class="invalid-feedback"><?php echo $atelier_err;?></span>
                                                            </div>
                                                           
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                            
                                                            <div class="form-group">
                                                                <label>Structure</label>
                                                                <input type="text" name="structure" class="form-control" placeholder="Veuillez entrer la structure" required <?php echo (!empty($structure_err)) ? 'is-invalid' : ''; ?> value="<?php echo $structure; ?>">
                                                                <span class="invalid-feedback"><?php echo $structure_err;?></span>
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                                <label>Fonction</label>
                                                                <input type="text" name="fonction" class="form-control" placeholder="Veuillez entrer la fonction" required <?php echo (!empty($fonction_err)) ? 'is-invalid' : ''; ?> value="<?php echo $fonction; ?>">
                                                                <span class="invalid-feedback"><?php echo $fonction_err;?></span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Type d'utilisateur</label>
                                                            <select name="role" class="form-control" value="<?php echo $role; ?>">
                                                                <label>Select type de compte</label>
                                                                <option selected disabled>Select type compte</option>
                                                                <option value="employee">Employé</option>
                                                                <option value="responsable_bd">Responsable banque de donnees</option>
                                                                <option value="chef">Chef de departement</option>
                                                                <option value="agent">Agent de sasie</option>
                                                            </select>
                                                            </div>
                                                           <!-- <div class="form-group">
                                                                <label>Username</label>
                                                                <input name="username" value="<?php echo $username; ?>"type="text" class="form-control" placeholder="username">
                                                            </div>-->
                                                            <div class="form-group">
                                                                <label>Mot de passe</label>
                                                                <input name="password" value="<?php echo $password; ?>"type="password" class="form-control" placeholder="Password">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Confirmer mot de passe</label>
                                                                <input type="password" class="form-control" placeholder="Confirm Password">
                                                            </div>
                                                        </div>
                                                    </div>
                                                  
                                                    <br>
                                                    <div class="col-lg-12">
                                                            <div class="payment-adress">
                                                            <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#exampleModalCenter">Ajouter utilisateur</button>
                                                            </div>
                                                        </div>
                                                    <!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Ajouter employé</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      Voulez-vous vraiment ajouter un employé ?
      </div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-primary waves-effect waves-light">Ajouter</button>
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