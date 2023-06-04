
<?php require_once "config.php";
session_start();
  

   
   $output = "";

  if (isset($_POST['login'])) {
  	   
  	   $username = $_POST['username'];
  	   
  	   $password = $_POST['password'];

  	   if (empty($username)) {
  	   	
  	   }else if(empty($password)){

  	   }else{

         $query = "SELECT * FROM personne WHERE username='$username' AND password='$password'";
         $res = mysqli_query($link,$query);

         if (mysqli_num_rows($res) == 1) {
          $row = mysqli_fetch_assoc($res);
          $role = $row['role'];

          if ($role == "employee") {
            $_SESSION['role'] = 'employe';
          


             $_SESSION['employe'] = $username;
             header("Location: employe.php");
             
           }else if($role == "chef"){
            $_SESSION['role'] = 'chef';
              
              $_SESSION['chef'] = $username;
              header("Location: chef_de_departement.php");


           }else if($role == "responsable_bd"){
            $_SESSION['role'] = 'responsable_bd';
            $_SESSION['responsable_bd'] = $username;
            header("Location: responsable_bd.php");

         } else if($role == "admin"){
          $_SESSION['role'] = 'admin';
              
          $_SESSION['admin'] = $username;
          header("Location: admin.php");

       }
       else if($role == "agent"){
        $_SESSION['role'] = 'agent';
              
        $_SESSION['agent'] = $username;
        header("Location: agent_de_saisie.php");
      }
         else if($role == "agent"){
                
          $_SESSION['agent'] = $username;
          header("Location: agent_de_saisie.php");
        }
         	 $output .= "you have logged-In";
         }else{
             $output .= "Failed to login";
         }

  	   }
  }




 ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>SAE | Login </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <!-- Google Fonts
		============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Play:400,700" rel="stylesheet">
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
    <!-- main CSS
		============================================ -->
    <link rel="stylesheet" href="css/main.css">
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
    <style>
       body{
    background: no-repeat fixed 50% 50% ;
    background-position: center;
    background-size: cover;
 }
    .title{
      font-size: 25px;
      font-weight: bold;
      position: relative;
      color: #000000;
      
    }
   .title::before{
      content: "";
      position: absolute;
      left: 0;
      bottom: 0;
      height: 3px;
      width: 50px;
      border-radius: 5px;
      background:linear-gradient(30deg,#5f060f,#ce071c);
    }
    .hpanel .panel-body {
    background: #ffffff9e;
    border-radius: 2px;
    padding: 20px;
    position: relative;
}</style>
    
</head>

<body style="background-image:url(img/R.jpg);">
    <!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
	<div class="error-pagewrap">
		<div class="error-page-int">
			
			<div class="content-error">
				<div class="hpanel">
                    <div class="panel-body">
                      <div class="title">S'authentifier</div>
                      <br>
                      <div class="text-center"><?php echo $output; ?></div>
                      <br>
                        <form method="post" id="loginForm"> 
                        <!--<div class="form-group">
                          <label>Your role</label>
                          <select name="role" class="form-control my-2">
                              <option selected disabled>Selete Role</option>
                              <option value="employee">Employee</option>
                              <option value="chef">Chef de departement</option>
                              <option value="responsable_bd">Responsable banque de donnees</option>
                              <option value="admin">Admin</option>
                              <option value="agent">Agent de sasie</option>
                            </select>
                            </div>-->
                            <div class="form-group">
                                <label class="control-label" >Username</label>
                                <input type="text"  placeholder="Please enter you username nom.prenom" title="Please enter you username" required="" name="username" id="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="control-label" >Password</label>
                                <input type="password"  title="Please enter your password" placeholder="******" required="" name="password" id="password" class="form-control">

                            </div>
                           
                          <br>
                         
                            <button  type="submit" name="login" class="btn btn-success btn-block loginbtn">S’authentifier</button>
                            
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
    <!-- tab JS
		============================================ -->
    <script src="js/tab.js"></script>
    <!-- icheck JS
		============================================ -->
    <script src="js/icheck/icheck.min.js"></script>
    <script src="js/icheck/icheck-active.js"></script>
    <!-- plugins JS
		============================================ -->
    <script src="js/plugins.js"></script>
    <!-- main JS
		============================================ -->
    <script src="js/main.js"></script>
    
</body>

</html>