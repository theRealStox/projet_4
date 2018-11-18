<?php
session_start();
if (isset($_SESSION['pseudo']) AND $_SESSION['pseudo'] != NULL) {
    define("USER_IS_CO", 1);
} else {
    define("USER_IS_CO", 0);
}

if (isset($_SESSION['role']) AND $_SESSION['role'] === 'admin') {
    define("ADMIN_IS_CO", 1);
} else {
    define("ADMIN_IS_CO", 0);
}


define("THIS_YEAR", date('Y'));
define("THIS_MONTH", date('m'));
define("THIS_DAY", date('d'));
define("NOW", date('Y-m-d H:i:s'));
define("NOW_FR", date('d-m-Y H:i:s'));
define("TODAY_EN", date('Y-m-d'));
define("TODAY_FR", date('d-m-Y'));
