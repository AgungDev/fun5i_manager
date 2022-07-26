<?php 
require_once "publicfunction.php";
require_once "../lib/apps.php";

$pf = new PublicFunction();
$token = $pf->checkAuth();

use fun5i\manager\lib\AppsLib;

$appsLib = new AppsLib();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/admin.app.css">
    <link rel="stylesheet" href="../assets/css/fontawesome.css">
    <title>The Dashboard Developher</title>
</head>
<body>
    <h1>Criteria App</h1>
    <nav>
        <ul>
            <li><a href="apps.php?auth=<?php echo $token; ?>">Back</a></li>
        </ul>
    </nav>

    <?php 
    if(isset($_POST, $_GET['idApp'])){
        if(isset($_POST['new'])){
            $version = $_POST['version'];
            $createNew = $appsLib->createVersion($_GET['idApp'], $version);
            if(!$createNew["error"]){
                header("Location: apps.php?auth=".$token);
            }else{
                echo "<h1>".$createNew['message']." : ".$createNew['result']."</h1>";
            }
        }elseif( isset($_POST['kriteria']) ){
            $version = $_POST['version'];
            ?>
    <div>
        <div>
            <div>
                <i class="fa fa-clone"></i> Clone version
            </div>
        </div>
        <?php echo "Config version ".$version; ?>
    </div>

            <?php
        }else{
            header("Location: apps.php?auth=".$token);
        }
    }else{
        header("Location: apps.php?auth=".$token);
    }

    ?>
</body>
<script src="../assets/js/fontawesome.js"></script>
</html>