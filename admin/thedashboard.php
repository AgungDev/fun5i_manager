<?php 
require_once "publicfunction.php";

$pf = new PublicFunction();
$pf->checkAuth();
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
    <h1>the dashboard</h1>
    <nav>
        <ul>
            <li><a href="thedashboard.php">Dashboard</a></li>
            <li><a href="apps.php">Apps</a></li>
        </ul>
    </nav>
</body>
</html>

