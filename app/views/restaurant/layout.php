<?php 
$path = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);


include 'blocks/header.php';
require_once '../app/views/restaurant/' . $data['page'] . '.php';
include 'blocks/footer.php';