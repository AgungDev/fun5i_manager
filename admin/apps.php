<?php 
require_once "publicfunction.php";

$pf = new PublicFunction();
$token = $pf->checkAuth();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Dashboard Developher</title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="thedashboard.php?auth=<?php echo $token; ?>">Dashboard</a></li>
            <li><a href="apps.php?auth=<?php echo $token; ?>">Apps</a></li>
        </ul>
    </nav>

    <div>
        <form>
            <input type="text" placeholder="name package">
        </form>
    </div>
</body>
</html>