<?php
require_once("class.MySql.php");

	$host       =   "localhost";
    	$username   =   "username";
    	$password   =   "sifra";
    	$baza       =   "dbname";

$db = new SQL ($host, $username, $password, $baza);


$zaDodavanje=array(
    'id' => NULL,
    'ime'=>'Petar',
    'prezime'=>'Petrovic'
);
$db->dodaj("imebaze",$zaDodavanje);

?>
