<?php
session_start();

// Vérifier si l'utilisateur est connecté en tant qu'employé
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'agent') {
    header("Location: login.php");
    exit();
}

?>
<?php
// Process delete operation after confirmation
if(isset($_POST["id_type"]) && !empty($_POST["id_type"])){
    // Include config file
    require_once "config.php";
    
    // Prepare a delete statement
    $sql = "DELETE FROM type
    WHERE id_type = ? and nom_type NOT IN (
        SELECT type
        FROM etude1
    )";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id_type);
        
        // Set parameters
        $param_id_type = trim($_POST["id_type"]);
        
        // Attempt to execute the prepared statement
       
        if(mysqli_stmt_execute($stmt)){
            if(mysqli_stmt_affected_rows($stmt) > 0) {
                header("location: add-type.php?deleted=1");
                exit();
            } else {
                header("location: add-type.php?deleted=0");
                exit();
            }
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
   
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
} else{
    // Check existence of id parameter
    if(empty(trim($_GET["id_type"]))){
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>

    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5 mb-3">Delete Record</h2>
                    
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger">
                            <input type="hidden" name="id_type" value="<?php echo trim($_GET["id_type"]); ?>"/>
                            <p>Are you sure you want to delete this type record?</p>
                            <p>
                                <input type="submit" value="Yes" class="btn btn-danger">
                                <a href="add-type.php" class="btn btn-secondary">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
    
</body>
</html>
