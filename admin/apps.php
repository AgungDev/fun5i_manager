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
    <h1>create your own apps</h1>
    <nav>
        <ul>
            <li><a href="thedashboard.php?auth=<?php echo $token; ?>">Dashboard</a></li>
            <li><a href="apps.php?auth=<?php echo $token; ?>">Apps</a></li>
        </ul>
    </nav>

    <div>
        <form method="POST" class="creatapp">
            <div>
                <input type="text" placeholder="nama aplikasi" name="name">
                <button>create</button>
            </div>
        </form>
        <?php 
        if (isset($_POST['name'])){
            $createApp = $appsLib->createApp($_POST['name']);
            if (!$createApp['error']){
                header("Location: apps.php?auth=".$token);
            }else{
                echo "Error ".$createApp['message'];
            }
            
        }
        ?>
    </div>

    <div>
    <table class="apptable" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Version</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            
            $showApp = $appsLib->readApp();
            $error1 = $showApp['error'];
            $res1 = $showApp['result'];
            if(!$error1){
                for($i1=0; $i1 < count($res1); $i1++){
            ?>
            <form action="criteriaapps.php?auth=<?php echo $token."&idApp=".$res1[$i1]["id"]; ?>" method="POST">
                <tr class="appinfo">
                    <td class="idtable"><?php echo $res1[$i1]["id"]; ?></td>
                    <td><?php echo $res1[$i1]["name"]; ?></td>
                    <td class="versiontable">
                        <?php 
                        $selectVersion = false;
                        $showVersion = $appsLib->readVersion($res1[$i1]["id"]);
                        $error2 = $showVersion["error"];
                        $res2 = $showVersion['result'];
                        
                        if(count($res2) == 0){
                        ?>
                        <div class="newversi">
                            <input type="text" placeholder="new version" name="version" value="1.0.0"/>
                            <input type="submit" name="new" value="new"/>
                        </div>
                        <?php 
                        }elseif(!$error2){
                            $selectVersion = true;
                            echo "<select class='selectVersion' name='version'>";
                            for($i2=0; $i2 < count($res2); $i2++){
                                echo "<option>".$res2[$i2]["version"]."</option>";
                            }
                            echo "</select>";
                        }else{
                            echo "<h1>".$showVersion["message"]."</h1>"; #if error
                        }
                        ?>
                    </td>
                    <td class="actiontable">
                        <div style="display: flex;">
                            <div class="appactionsub">
                                <button name="kriteria" <?php echo ($selectVersion)?'class="btnena"':'disabled class="btndis"'; ?>>
                                    <i class="fa fa-thin fa-cube"></i> Criteria
                                </button>
                            </div>

                            <div class="appactionsub">
                                <button name="kriteria" class="btndis">
                                <i class="fa fa-chart-area"></i> Analytics
                                </button>
                            </div>

                            <div class="appactionsub">
                                <button name="kriteria" class="btndis">
                                <i class="fa fa-info-circle"></i> About
                                </button>
                            </div>

                            <div class="appactionsub">
                                <button name="kriteria" class="btndis">
                                <i class="fa fa-trash-alt"></i> Delate
                                </button>
                            </div>
                            
                        </div>
                        
                    </td>
                </tr>
            </form>
            <?php 
                }
            }else{
                echo "<h1>".$showApp["message"]."</h1>"; #if error
            }
            ?>
        </tbody>
    </table>
    </div>
</body>
<script src="../assets/js/fontawesome.js"></script>
</html>