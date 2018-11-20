<?php
function debug($req, $var){
	$var_return = ('<span style="color:gray;">$' . $req . ' -> ' . $var . '</span><br />');
	echo $var_return;
}
function debug_com($comm, $color){
	if ($color === 1) {
		$var_return = ('<span style="color:green;">' . $comm . '</span><br />');		
	}
	elseif ($color === 0) {
		$var_return = ('<span style="color:red;">' . $comm . '</span><br />');
	}
	elseif ($color === 2) {
		$var_return = ('<span style="color:blue;">' . $comm . '</span><br />');
	}
	echo $var_return;
}





function dateFrench($datetime, $type)
{
	if ($type === 0) {
		$year = substr($datetime, 0, 4);
		$month = substr($datetime, 5, 2);
		$day = substr($datetime, 8, 2);
		$heu = substr($datetime, 11, 2);
		$min = substr($datetime, 14, 2);
		$sec = substr($datetime, 17, 2);
		$frenchDay = ($day . ' / ' . $month . ' / ' . $year . ' à ' . $heu . ':' . $min . ':' . $sec);
	}
	else {
		$date = substr($datetime, 0, 12);
		$year = substr($date, 0, 4);
		$month = substr($date, 5, 2);
		$day = substr($date, 8, 2);
		$frenchDay = ($day . ' / ' . $month . ' / ' . $year);
	}
	return $frenchDay;
}
function cutText($text) {

    $cutedText = substr($text, 0, 500);
    $textReturn = ($cutedText . '...');
    return $textReturn;
}
/*
 █████╗ ██████╗ ███╗   ███╗██╗███╗   ██╗
██╔══██╗██╔══██╗████╗ ████║██║████╗  ██║
███████║██║  ██║██╔████╔██║██║██╔██╗ ██║
██╔══██║██║  ██║██║╚██╔╝██║██║██║╚██╗██║
██║  ██║██████╔╝██║ ╚═╝ ██║██║██║ ╚████║
╚═╝  ╚═╝╚═════╝ ╚═╝     ╚═╝╚═╝╚═╝  ╚═══╝                                        
*/

function get_ip() 
{
	// IP si internet partagé
	if (isset($_SERVER['HTTP_CLIENT_IP'])) 
	{
		return $_SERVER['HTTP_CLIENT_IP'];
	}
	// IP derrière un proxy
	elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) 
	{
		return $_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	// Sinon : IP normale
	else 
	{
		return (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '');
	}
}

function get_page()
{
	$page = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	return $page;
}

function errorRegister($page, $desc, $code, $ip, $uniqID, $pseudo, $notifEmail) {
	$db = dbConnect();
	try
	{
		$rep = $db->prepare('INSERT INTO errorregister(
		JF_errorRegister_date,
		JF_errorRegister_page,
		JF_errorRegister_desc,
		JF_errorRegister_code,
		JF_errorRegister_ip,
		JF_errorRegister_uniqID,
		JF_errorRegister_pseudo
		) VALUES(
		"'.NOW.'", 
		:page,
		:desc, 
		:code, 
		:ip, 
		:uniqID, 
		:pseudo
		)');
	    $rep->execute(array(
	        ':page'=>$page,
	        ':desc'=>$desc,
	        ':code'=>$code,
	        ':ip'=>$ip,
	        ':uniqID'=>$uniqID,
	        ':pseudo'=>$pseudo
	        )
	    );    		
	}
	catch(Exception $e)
	{
	   die('Erreur : '.$e->getMessage());
	}

    if($rep == true)    
	{
		if ($notifEmail === 1) {
			$mailTo = emailTypeCarrousel('TECH', $code, $page, $desc);
		}
	}
	else
	{
		$return = 'Erreur d\'enregistrement errorRegister';
		return $return;
	}
}

function sendMail($emailDest, $emailSend, $titre, $message_txt, $message_html)
{
	$mail = $emailDest; // Déclaration de l'adresse de destination.
	if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.
	{
		$passage_ligne = "\r\n";
	}
	else
	{
		$passage_ligne = "\n";
	}

	 
	//=====Création de la boundary
	$boundary = "-----=".md5(rand());
	//==========
	 
	 
	//=====Création du header de l'e-mail.
	$header = "From: \"doNoReply\"<" . $emailSend . ">".$passage_ligne;
	$header.= "Reply-to: \"doNoReply\" <" . $emailSend . ">".$passage_ligne;
	$header.= "MIME-Version: 1.0".$passage_ligne;
	$header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
	//==========
	 
	//=====Création du message.
	$message = $passage_ligne."--".$boundary.$passage_ligne;
	//=====Ajout du message au format texte.
	$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
	$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
	$message.= $passage_ligne.$message_txt.$passage_ligne;
	//==========
	$message.= $passage_ligne."--".$boundary.$passage_ligne;
	//=====Ajout du message au format HTML
	$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
	$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
	$message.= $passage_ligne.$message_html.$passage_ligne;
	//==========
	$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
	$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
	//==========
	 
	//=====Envoi de l'e-mail.
	mail($mail,$titre,$message,$header);
	//==========
	$statut = 'done';
	return $statut;
}

function emailTypeCarrousel($req, $dest, $var1, $var2)
{	
	if ($req == 'NEWUSER') 	
	{	
		/*
		db    db .d8888. d88888b d8888b. 
		88    88 88'  YP 88'     88  `8D 
		88    88 `8bo.   88ooooo 88oobY' 
		88    88   `Y8b. 88~~~~~ 88`8b   
		88b  d88 db   8D 88.     88 `88. 
		~Y8888P' `8888Y' Y88888P 88   YD 
		*/
		$emailDest = $dest;
		$emailSend = 'DoNoReply-NePasRépondre@forteroche.com';
		$titre = 'forteroche.com - confirmation d\'inscription';
		$message_txt = '';
		$message_html = '';
		$uniqIDdest = $var1;

		//=====Déclaration des messages au format texte et au format HTML.
		$message_txt = "De : forteroche.com\n	
		#############################################\n	
		CECI EST UN MAIL AUTOMATIQUE, LES RÉPONSES NE SONT PAS LUES\n
		Pour nous contacter : contact@forteroche.com\n
		#############################################\n	
		\n
		Bonjour et Bienvenue sur forteroche.com\n
		Votre adresse e-mail a été fournie comme adresse de contact sur notre site.\n
		Veuillez cliquer sur ce lien pour valider le compte :\n
		http://forteroche.com/index.php?a=ac&v=".$uniqIDdest."\n
		Si ce lien ne fonctionne pas, copiez et collez le dans la barre d'adresse.\n
		http://forteroche.com/index.php?a=ac&v=".$uniqIDdest."\n

		A très vite sur forteroche.com !\n
		";
		$message_html = '<html><head></head><body>
		<p class="exo2 font2 color3 margin0">De : forteroche.com</p>
		<p class="exo2 font2 color3 margin0">
			#############################################<br />	
			CECI EST UN MAIL AUTOMATIQUE, LES RÉPONSES NE SONT PAS LUES<br />
			Pour nous contacter : contact@forteroche.com<br />
			#############################################<br />	
		</p>
		<p class="exo2 font2 color3 margin0">Bonjour et Bienvenue sur forteroche.com</p>
		<p class="exo2 font2 color3 margin0">
		Votre adresse e-mail a été fournie comme adresse de contact sur notre site.<br />
		Veuillez cliquer sur ce lien pour valider le compte :<br />
		<a class="color3 font2 nsl" href="http://forteroche.com/index.php?a=ac&v='.$uniqIDdest.'">Confirmation</a><br />
		Si ce lien ne fonctionne pas, copiez et collez le dans la barre d\'adresse.<br />
		http://forteroche.com/index.php?a=ac&v='.$uniqIDdest.'<br />
		</p>
		

		</body></html>';
		//==========

		$sendMail = sendMail($emailDest, $emailSend, $titre, $message_txt, $message_html);	

		if ($sendMail == 'done') 
		{
		/*
		 .d8b.  d8888b. .88b  d88. d888888b d8b   db 
		d8' `8b 88  `8D 88'YbdP`88   `88'   888o  88 
		88ooo88 88   88 88  88  88    88    88V8o 88 
		88~~~88 88   88 88  88  88    88    88 V8o88 
		88   88 88  .8D 88  88  88   .88.   88  V888 
		YP   YP Y8888D' YP  YP  YP Y888888P VP   V8P 
		*/

		$emailDest = 'mana@manacorp.eu';
		$emailSend = 'DoNoReply-NePasRépondre@forteroche.com';
		$titre = 'forteroche.com - NEW USER';
		$message_txt = '';
		$message_html = '';
		$uniqIDdest = $var1;

		//=====Déclaration des messages au format texte et au format HTML.
		$message_txt = "De : forteroche.com\n	
		#############################################\n	
		CECI EST UN MAIL AUTOMATIQUE, LES RÉPONSES NE SONT PAS LUES\n
		Pour nous contacter : contact@forteroche.com\n
		#############################################\n	
		\n
		Bonjour et Bienvenue sur forteroche.com\n
		Votre adresse e-mail a été fournie comme adresse de contact sur notre site.\n
		Veuillez cliquer sur ce lien pour valider le compte :\n
		http://forteroche.com/index.php?a=ac&v=".$uniqIDdest."\n
		Si ce lien ne fonctionne pas, copiez et collez le dans la barre d'adresse.\n
		http://forteroche.com/index.php?a=ac&v=".$uniqIDdest."\n

		A très vite sur forteroche.com !\n
		";
		$message_html = '<html><head></head><body>
		<p class="exo2 font2 color3 margin0">De : forteroche.com</p>
		<p class="exo2 font2 color3 margin0">
			#############################################<br />	
			CECI EST UN MAIL AUTOMATIQUE, LES RÉPONSES NE SONT PAS LUES<br />
			Pour nous contacter : contact@forteroche.com<br />
			#############################################<br />	
		</p>
		<p class="exo2 font2 color3 margin0">Bonjour et Bienvenue sur forteroche.com</p>
		<p class="exo2 font2 color3 margin0">
		Votre adresse e-mail a été fournie comme adresse de contact sur notre site.<br />
		Veuillez cliquer sur ce lien pour valider le compte :<br />
		<a class="color3 font2 nsl" href="http://forteroche.com/index.php?a=ac&v='.$uniqIDdest.'">Confirmation</a><br />
		Si ce lien ne fonctionne pas, copiez et collez le dans la barre d\'adresse.<br />
		http://forteroche.com/index.php?a=ac&v='.$uniqIDdest.'<br />
		</p>
		

		</body></html>';
		//==========

		$sendMail = sendMail($emailDest, $emailSend, $titre, $message_txt, $message_html);	
		}
	}
	if ($req == 'TECH') 
	{
		$emailDest = 'mana@manacorp.eu';
		$emailSend = 'errorRegister@forteroche.com';
		$titre = 'trigger Alert error' . $dest;
		$message_txt = '';
		$message_html = '';
		$uniqIDdest = $var1;

		//=====Déclaration des messages au format texte et au format HTML.
		$message_txt = "De : forteroche.com\n	
		
		Erreur de type :" . $dest . "\n
		Relevée le " . NOW . "\n
		" . $var1 . "\n
		" . $var2 . "\n
		";				
		$message_html = '<html><head></head><body>
		<p class="exo2 font2 color3 margin0">De : forteroche.com</p>
		<p>
		Erreur de type :' . $dest . '<br />
		Relevée le ' . NOW . '<br />
		' . $var1 . '<br />
		' . $var2 . '<br />
		</p>
		

		</body></html>';
		//==========
		//==========

		$sendMail = sendMail($emailDest, $emailSend, $titre, $message_txt, $message_html);	
	}
}

