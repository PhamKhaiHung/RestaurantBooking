<?php
$path = rtrim(str_replace('index.php', '', $_SERVER['SCRIPT_NAME']), '/') . '/';
header("Location: " . $path . "authen/home/login?register=1");
exit;
?>
