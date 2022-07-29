<?php 
require_once "publicfunction.php";
require_once "../lib/apps.php";

$pf = new PublicFunction();
$pf->checkAuth();
$token = $pf->getToken();
$appsLib = $pf->getAppLib();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/criteria.app.css">
    <link rel="stylesheet" href="../assets/css/fontawesome.css">
    <title>The Dashboard Developher</title>
</head>
<body>
    <h1>Criteria App</h1>
    <nav>
        <ul>
            <li><a href="apps.php">Back</a></li>
        </ul>
    </nav>

    <?php 
    # id version 
    if(isset($_GET['idVer'])){
        if(isset($_GET['newver'])){
            $version = $_GET['newver'];
            $createNew = $appsLib->createVersion($_GET['idVer'], $version);
            if(!$createNew["error"]){
                header("Location: apps.php");
            }else{
                echo "<h1>".$createNew['message']." : ".$createNew['result']."</h1>";
            }
        }elseif( isset($_GET['idVer']) ){
            $version = $_GET['idVer'];
    ?>
    <div>
        <!-- body config kriteria -->
        <div>
            <!-- Clones kriteria here -->
        </div>
        <div>
            <table cellspacing="0" cellpadding="0">
                <?php 
                # Criteria
                $readKriteria = $appsLib->readCriteria($_GET['idVer']);
                $resKri = $readKriteria['result'];
                for ($i1= 0; $i1 < count($resKri); $i1++){
                ?>
                <tr>
                    <th>
                        <div>
                            <?php echo $resKri[$i1]["name"]; ?>
                        </div>
                    </th>
                    <?php 
                    # Sub Criteria
                    $idKriteria = $resKri[$i1]["id"];
                    $readSub = $appsLib->readSubCriteria($idKriteria);
                    $resSub = $readSub['result'];
                    for ($i2 = 0; $i2 < count($resSub); $i2++){
                    ?>
                    <td>
                        <div>
                            <?php echo $resSub[$i2]["name"]; ?>
                        </div>
                    </td>
                    <?php 
                    }
                    # End Sub kriteria
                    ?>
                    <td class="subx">
                        <div>
                            <form action="" method="POST">
                                <input placeholder="Type.." name="addSub" class="is"/>
                                <button name="idKrt" value="<?php echo $idKriteria; ?>">
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php 
                }
                # End Kriteria
                ?>
                <tr>
                    <th class="kriteriax">
                        <form action="" method="POST">
                            <input placeholder="Type.." name="addkeriteria" class="ik"/>
                            <button></button>
                        </form>
                        <?php
                        if (isset($_POST['addkeriteria'])){
                            $add = $_POST['addkeriteria'];
                            $create = $appsLib->createCriteria($_GET['idVer'], $add);

                            if ($create['error']){
                                var_dump($create); # error
                            }else{
                                echo "<script>window.location.href = window.location.href;</script>";
                            }
                        } 

                        if (isset($_POST['addSub'])){
                            $add = $_POST['addSub'];
                            $idKriteria = $_POST['idKrt'];
                            $create = $appsLib->createSubCriteria($idKriteria, $add);

                            if ($create['error']){
                                var_dump($create); # error
                            }else{
                                echo "<script>window.location.href = window.location.href;</script>";
                            }
                        } 
                        ?>
                    </th>
                </tr>
            </table>
        </div>
        <!-- end body config version -->
    </div>

            <?php
        }else{
            header("Location: apps.php?error=wrong%20parms");
        }
    }else{
        header("Location: apps.php?error=need%20id");
    }

    ?>
</body>
<script src="../assets/js/fontawesome.js"></script>
</html>