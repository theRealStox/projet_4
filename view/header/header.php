<?php

ob_start(); // ouverture de la capture
/*
if (ADMIN_IS_CO === 1) {
    
    require('navMenuAdmin.html');
}
*/
require('navMenu.html');

$containMenu = ob_get_clean(); // fermeture de la capture


echo'
<header class="container-fluid">
'
 . 
$containMenu
 . 
'
</header>
';