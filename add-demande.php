
<?php
require_once "config.php";
session_start();

// Vérifier si l'utilisateur est connecté en tant qu'employé
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'chef') {
    header("Location: login.php");
    exit();
}


$query = "SELECT password FROM personne WHERE username = '{$_SESSION['chef']}'";
$result = mysqli_query($link, $query);

if ($result && $row = mysqli_fetch_assoc($result)) {
    $paaswordbd = $row['password'];
?>
<?php

//connexion à la base de donnée
 include_once "conf.php";
//on récupère le id dans le lien
 $iddemande = $_GET['iddemande'];
 //requête pour afficher les infos d'un employé
 $req = mysqli_query($con , "SELECT * FROM demmandeinfo WHERE iddemande = $iddemande");
 $row = mysqli_fetch_assoc($req);


//vérifier que le bouton ajouter a bien été cliqué
if(isset($_POST['valid'])){
    
  	   
        
        
        $passwordbd= $_POST['password'];

        

  //extraction des informations envoyé dans des variables par la methode POST
  extract($_POST);
  //verifier que tous les champs ont été remplis
 
      //requête de modification
      $req = mysqli_query($con, "UPDATE demmandeinfo SET  valid='$valid' WHERE iddemande = $iddemande ");
       if($req){//si la requête a été effectuée avec succès , on fait une redirection
           header("location: liste--demande-chef.php");
       }else {//si non
           $message = "Employé non modifié";
       }

  
}

}
?>


<!doctype html>
<html class="no-js" lang="fr">

<head><meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title>SAE</title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.payment-adress {
display: flex;
justify-content: center;
}

.payment-adress button {
margin: 0 5px; /* Ajustez les marges selon vos besoins */
}

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
    
    <!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
    <!-- Start Left menu area -->
    <div class="left-sidebar-pro">
        <nav id="sidebar" class="">
            <div class="sidebar-header">
                <a href="chef_de_departement.php"><img class="main-logo" src="img/logo/logo.png" style="width: 120px;" alt="" /></a>
                <strong><a href="chef_de_departement.php"><img src="img/logo/logo.png" alt="" /></a></strong>
            </div>
            <br>
            <div class="left-custom-menu-adp-wrap comment-scrollbar">
                <nav class="sidebar-nav left-sidebar-menu-pro">
                    <ul class="metismenu" id="menu1">
                        <li class="active">
                            <a class="has-arrow" href="chef_de_departement.php">
                                <span class="educate-icon educate-course icon-wrap"></span>
								   <span class="mini-click-non">Les etudes</span>
								</a>
                            <ul class="submenu-angle" aria-expanded="true">
                                <li><a title="All etude" href="chef_de_departement.php" style="background-color:rgba(94, 92, 92, 0.043); color:rgb(79, 79, 79);"><span class="mini-sub-pro">Liste des etudes</span></a></li>
                                        
                                         </ul>
                        </li>
                       
                        <li>  <a class="has-arrow" href="index.html">
                                <span class="educate-icon educate-data-table icon-wrap"></span>
								   <span class="mini-click-non">Demande d'info</span>
								</a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a title="Liste des type" href="liste--demande-chef.php"><span class="mini-sub-pro">les demandes d'info</span></a></li>
                                <li><a title="Ajouter type " href="historique-chef.php"><span class="mini-sub-pro">Historique des demandes </span></a></li>
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
                        <a href="chef_de_departement.php"><img class="main-logo" src="img/logo/logo.png"style="width: 100px;"alt="" /></a>
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
															<span class="admin-name"><?php echo $_SESSION['chef'] ?></span>
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
           
            <div class="breadcome-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="breadcome-list single-page-breadcome">
                                <div class="row">
                                    
                                    
                                        <ul class="breadcome-menu">
                                            <li><a href="#">Demande d'information</a> <span class="bread-slash">/</span>
                                            </li>
                                            <li><span class="bread-blod">La liste des demandes d'informations</span>
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
                                   <form action="" method="post" class="dropzone dropzone-custom needsclick addlibrary" id="demo1-upload">
                                       <div class="row">
                                           <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                               <div class="form-group">
                                                   <label>Demandeur :</label>
                                                
                                                 
                                                   <?php echo $row["demandeur"]; ?>
                                                  
                                               </div>
                                               
                                               <div class="form-group">
                                                   <label>Direction :</label>
                                                   <?php echo $row["direction"]; ?>
                                                   
                                                </div>
                                               
                                               
                                          <div class="form-group">
                                           <label>Atelier :</label>
                                           <?php echo $row["atelier"]; ?>
                                             <div class="file-upload-inner ts-forms">
                                                 
                                                     
                                                     
                                                  
                                                
                                             </div>
                                         
                                          </div>
                                          
                                          <div class="form-group">
                                           <label> Document ecrit :</label>
                                           <?php echo $row["documment_ecrit"]; ?>
                                             <div class="file-upload-inner ts-forms">
                                            
                                             </div>
                                         
                                          
                                         
                                          </div>
                                               <label>Document cartographique :</label>
                                             
                                               <?php echo $row["documment_cartographie"]; ?>
                                           </div>
                                               
                                                   
                                             
                                      
                                           <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                               <div class="form-group">
                                                   <label>Titre d'information :</label>
                                                   <?php echo $row["titre"]; ?>
                                               </div>
                                               <div class="form-group">
                                                   <label>Department</label>
                                                   <?php echo $row["departement"]; ?>
                                                       
                                               </div>
                                               
                                               
                                               <div class="form-group">
                                                   <label>Raster :</label>
                                                   <?php echo $row["raster"]; ?>
                                               </div>
                                               <div class="form-group">
                                                   <label> Echelle :</label>
                                                  <?php echo $row["echelle"]; ?>
                                               </div>
                                               <div class="form-group">
                                                   <label> Date :</label>
                                                   <?php echo $row["date"]; ?>
                                               </div>
                                               <div class="form-group">
                                             </div>
                                           </div>
                                           
                                       </div>  
                                       <br>
                                       <br>
                                      
                                       <div class="row">
                                      
                                       <!-- Placer le code PHP avant la génération de la page HTML -->

                                      






<div class="col-lg-12">
    <div class="payment-adress">
                                           
        <button type="button" class="btn btn-primary waves-effect waves-light"  data-toggle="modal" data-target="#exampleModalCenter">Validation</button>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Valideation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               
                <div class="form-group">
                    <label class="control-label">Password</label>
                    <input type="password" title="Please enter your password" placeholder="******" required="" name="password" id="password" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit"name="valid" value="1" class="btn btn-custon-four btn-success">
											<i class="fa fa-check edu-checked-pro" aria-hidden="true"></i> Valider</button>
                <button type="submit" name="valid" value="0" class="btn btn-custon-four btn-danger">
											<i class="fa fa-times edu-danger-error" aria-hidden="true"></i> Rufuser </button>
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
