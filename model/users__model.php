<?php

/*
███████╗███████╗███████╗███████╗       ██████╗ ███████╗███████╗████████╗
██╔════╝██╔════╝██╔════╝██╔════╝       ██╔══██╗██╔════╝██╔════╝╚══██╔══╝
███████╗█████╗  ███████╗███████╗       ██║  ██║█████╗  ███████╗   ██║   
╚════██║██╔══╝  ╚════██║╚════██║       ██║  ██║██╔══╝  ╚════██║   ██║   
███████║███████╗███████║███████║██╗    ██████╔╝███████╗███████║   ██║   
╚══════╝╚══════╝╚══════╝╚══════╝╚═╝    ╚═════╝ ╚══════╝╚══════╝   ╚═╝   
*/
function sessionDestroy() {

    session_destroy();
    header('Location: index.php');
}

/*
 ██████╗ ██████╗ ███╗   ██╗███╗   ██╗███████╗██╗  ██╗██╗ ██████╗ ███╗   ██╗
██╔════╝██╔═══██╗████╗  ██║████╗  ██║██╔════╝╚██╗██╔╝██║██╔═══██╗████╗  ██║
██║     ██║   ██║██╔██╗ ██║██╔██╗ ██║█████╗   ╚███╔╝ ██║██║   ██║██╔██╗ ██║
██║     ██║   ██║██║╚██╗██║██║╚██╗██║██╔══╝   ██╔██╗ ██║██║   ██║██║╚██╗██║
╚██████╗╚██████╔╝██║ ╚████║██║ ╚████║███████╗██╔╝ ██╗██║╚██████╔╝██║ ╚████║
 ╚═════╝ ╚═════╝ ╚═╝  ╚═══╝╚═╝  ╚═══╝╚══════╝╚═╝  ╚═╝╚═╝ ╚═════╝ ╚═╝  ╚═══╝
                                                                           
*/
function getUserLogs($pseudoPost) {

    $db = dbConnect();

    sleep(1);

    try	{

		$rep=$db->prepare('SELECT 
        JF_user_pseudo,
        JF_user_pass,
        JF_user_detailsConfirmed,
        JF_user_uniqID, 
        JF_user_confirmAccount
        FROM user WHERE JF_user_pseudo = :pseudo_post');

        $rep->execute(array(':pseudo_post'=>$pseudoPost));
        
        return $rep;
	}
	catch(Exception $e)	{

	   die('Erreur : '.$e->getMessage());
	}
}

function getUserRole($pseudo) {

    $db = dbConnect();

    try	{

        $query=$db->prepare('SELECT COUNT(JF_roleUser_pseudo) AS isSet FROM roleuser WHERE JF_roleUser_pseudo = :pseudo AND JF_roleUser_role = "admin"');
        $query->bindValue(':pseudo',$pseudo, PDO::PARAM_STR);			
        $query->execute();
        $isSet=($query->fetchColumn());
        $query->CloseCursor();
        
    }
    catch(Exception $e) {
        
        die('Erreur : '.$e->getMessage());
    }
    return $isSet;
}


/*
 ██████╗██████╗ ███████╗ █████╗ ████████╗███████╗
██╔════╝██╔══██╗██╔════╝██╔══██╗╚══██╔══╝██╔════╝
██║     ██████╔╝█████╗  ███████║   ██║   █████╗  
██║     ██╔══██╗██╔══╝  ██╔══██║   ██║   ██╔══╝  
╚██████╗██║  ██║███████╗██║  ██║   ██║   ███████╗
 ╚═════╝╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝   ╚═╝   ╚══════╝
*/
function user__newUserVerif__pseudo($pseudo){

    $db = dbConnect();

    try	{

        $query=$db->prepare('SELECT COUNT(*) AS nbr FROM user WHERE JF_user_pseudo =:pseudo');
        $query->bindValue(':pseudo',$pseudo, PDO::PARAM_STR);
        $query->execute();
        $pseudo_free=($query->fetchColumn()==0)?1:0;
        $query->CloseCursor();

        return $pseudo_free;
    }
    catch(Exception $e) {

        die('Erreur : '.$e->getMessage());
    }
}

function user__newUserVerif__email($email){

    $db = dbConnect();

    try	{
        
        $query=$db->prepare('SELECT COUNT(*) AS nbr FROM user WHERE JF_user_mail =:email');
        $query->bindValue(':email',$email, PDO::PARAM_STR);
        $query->execute();
        $mail_free=($query->fetchColumn()==0)?1:0;
        $query->CloseCursor();	   

        return $mail_free;
    }
    catch(Exception $e) {

        die('Erreur : '.$e->getMessage());
    }
}         

function user__newUserInsert($pseudo, $uniqueID, $mdp_hash, $email) {
	
	$db = dbConnect();

	try	{

		$rep = $db->prepare('INSERT INTO user(
		JF_user_pseudo, 
		JF_user_uniqID, 
		JF_user_pass, 
		JF_user_mail, 
		JF_user_nom, 
		JF_user_prenom, 
		JF_user_pays, 
		JF_user_numRue, 
		JF_user_nomRue, 
		JF_user_codePostal, 
		JF_user_ville, 
		JF_user_date, 
		JF_user_detailsConfirmed, 
		JF_user_PIchecked,
		JF_user_confirmAccount
		) VALUES(
		:pseudo, 
		:uniqueID,
		:mdp_hash, 
		:email, 
		0, 
		0, 
		0, 
		0, 
		0, 
		0, 
		0, 
		"'.NOW.'", 
		0, 
		0,
		1
		)');

		$rep->execute(array(
			':pseudo'=>$pseudo,
			':uniqueID'=>$uniqueID,
			':mdp_hash'=>$mdp_hash,
			':email'=>$email
			)
		);

		return $rep;
	}
	catch(Exception $e)
	{
	die('Erreur : '.$e->getMessage());
	}
}