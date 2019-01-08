<?php
header("content-type:text/json;charset=utf-8");
error_reporting(0);
$link = mysqli_connect("localhost", "root", "", "photochemcad");

if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
$name = htmlentities($_POST['name']);
$link->set_charset("utf8");
mysqli_select_db($link, "pacd_graphic");
$sql = 'SELECT compound,wavelength,abs,ems FROM graphic_data WHERE compound="'. $name .'"';
$resultset = mysqli_query($link, $sql);

class Graphic{
 public $compound;
 public $wavelength;
 public $abs;
 public $ems;
}

if($resultset){
while($row = mysqli_fetch_array($resultset, MYSQLI_NUM)) {
    $graphic = new Graphic();
	$graphic->compound = $row[0];
	$graphic->wavelength = $row[1];
	$graphic->abs = $row[2];
	$graphic->ems = $row[3];
    $data[] = $graphic;
}}
$json = json_encode($data);//把数据转换为JSON数据.
echo $json;
mysqli_close($link);
?>