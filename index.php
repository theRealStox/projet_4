<?php

require('view/header/sessionStart.php');

require('admin/dbConnect.php');

require('public/fonctions.php');

ob_start();

require('view/header/header.php');	

ob_start();

	if (!isset($_GET['v']) OR $_GET['v'] === 'a') {
		
		$title = 'Accueil';
		//require('view/body/accueil.php');

		require('controller/content__control.php');
		
	}
	if (isset($_GET['v']) AND $_GET['v'] === 'u') {
		
		if (isset($_GET['f'])) {
		
			require('controller/users__control.php');
		}
		else {
			// REDIR 404
		}

	}
	if (isset($_GET['v']) AND $_GET['v'] === 'b') {
		
		if (ADMIN_IS_CO === 1) {
			
			if (isset($_GET['f']) AND $_GET['f'] === 'a') {
				
				$title = 'Administration Billets';
				require('controller/billets__control.php');
			}			
		}
		else {
			
			$notifyUser = "notLoggedAsAdmin";
			header('Location: index.php?v=u&f=c&return=' . $notifyUser . '');
			
		}
	}
	if (isset($_GET['v']) AND $_GET['v'] === 'c') {
		
		if (ADMIN_IS_CO === 1) {
			
			if (isset($_GET['f']) AND $_GET['f'] === 'a') {
				
				$title = 'Administration Commentaires';
				require('controller/comment__control.php');
			}
		}
		else {
			
			$notifyUser = "notLoggedAsAdmin";
			header('Location: index.php?v=u&f=c&return=' . $notifyUser . '');
			
		}
	}

$contentBody = ob_get_clean(); // fermeture de la capture

if (isset($_GET['return']) AND !empty($_GET['return'])) { 
    
    $returnNotif = htmlspecialchars($_GET['return']);
}

require('view/header/eventNotifier.php');	

echo $contentBody;

require('view/footer/footer.php');

$content = ob_get_clean(); // fermeture de la capture

require('view/template.php');