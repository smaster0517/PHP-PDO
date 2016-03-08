<!DOCTYPE html>
<htmL>
<head>
    <title>PHP Pagination</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<?php include_once("header.php"); ?>
<div class="container">
<div class="row">
<?php
    // use this var_umb to get a list of PDO database drivers as an array object
    //var_dump(PDO::getAvailableDrivers());

    require "connect_to_mysql_pdo.php";
    /*** The SQL SELECT statement ***/
    $sql = "SELECT * FROM animals";
    echo '<table class="table table-striped table-bordered"><thead></thead><tr><th>Type</th><th>Name</th></tr><tbody>';
    foreach ($dbh->query($sql) as $row)
    {
        print '<tr><td>' . $row['animal_type'] .'</td> - <td>'. $row['animal_name'] . '</td></tr>';
    }
    echo '</tbody></table>';
    /*** close the database connection ***/
    $dbh = null;
?>
</div>
</div>
<?php include_once("footer.php"); ?>
</body>
</html>