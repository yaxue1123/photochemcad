<?php
// use separate dbconnect.php to add security and condense code
$h = 'localhost';
$u = 'root';
$p = '';
$dbname = 'photochemcad';
$mysqli = new mysqli($h, $u, $p, $dbname);
if ($mysqli->connect_errno) {
    echo "Connect failed" . $mysqli->connect_error;
    exit();
}

?>
