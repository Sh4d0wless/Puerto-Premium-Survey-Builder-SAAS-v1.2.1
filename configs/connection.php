<?php
# -------------------------------------------------#
# Puerto Premium Survey 1.0
# -------------------------------------------------#

$connect = [
	'HOSTNAME' => 'xxxx',
	'USERNAME' => 'xxxx',
	'PASSWORD' => 'xxxx',
	'DATABASE' => 'xxxx'
];

define('prefix', 'puerto_');

// გამოვრთავთ mysqli-ს Fatal Error-ებს
mysqli_report(MYSQLI_REPORT_OFF);

// ბაზასთან დაკავშირება
$db = @new mysqli($connect['HOSTNAME'], $connect['USERNAME'], $connect['PASSWORD'], $connect['DATABASE']);

// თუ ბაზას ვერ დაუკავშირდა და მომხმარებელი ჯერ არ არის install.php-ზე
if ($db->connect_errno) {
    if (basename($_SERVER['PHP_SELF']) !== 'install.php') {
        header("Location: install.php");
        exit;
    }
} else {
    // თუ დაკავშირდა, დავაყენოთ sql_mode
    $sql_mode = $db->query("SELECT @@GLOBAL.sql_mode;");
    if ($sql_mode) {
        $rs_mode = $sql_mode->fetch_assoc();
        if (!empty($rs_mode["@@GLOBAL.sql_mode"])) {
            $db->query("SET GLOBAL sql_mode='';");
        }
    }
}