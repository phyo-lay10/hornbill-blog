<?php 

$host = 'localhost';
$dbname = 'hornbill-blog';
$dbuser = 'root';
$dbpass = '';
//  $db = new PDO("mysql:host=localhost; dbname=hornbill-blog", 'root','');
$db = new PDO("mysql:host=$host;dbname=$dbname",$dbuser,$dbpass );
if($db != true) {
    echo 'pdo connection failed';
}