<?php
/*
 ██████╗ ██████╗ ██╗   ██╗███╗   ██╗████████╗
██╔════╝██╔═══██╗██║   ██║████╗  ██║╚══██╔══╝
██║     ██║   ██║██║   ██║██╔██╗ ██║   ██║   
██║     ██║   ██║██║   ██║██║╚██╗██║   ██║   
╚██████╗╚██████╔╝╚██████╔╝██║ ╚████║   ██║   
 ╚═════╝ ╚═════╝  ╚═════╝ ╚═╝  ╚═══╝   ╚═╝   
*/
function countBillets() {

    $db = dbConnect();
    
    $query=$db->prepare('SELECT COUNT(JF_billets_uniqID) AS nbBillets FROM billets');
    $query->execute();
    $nbBillets=($query->fetchColumn());
    $query->CloseCursor();
    
    return $nbBillets;
}

function countBilletsP() {

    $db = dbConnect();
       
    $query=$db->prepare('SELECT COUNT(JF_billets_uniqID) AS nbBilletsP FROM billets WHERE JF_billets_state = 1');
    $query->execute();
    $nbBilletsP=($query->fetchColumn());
    $query->CloseCursor();

    return $nbBilletsP;
}
/*
 ██████╗██████╗ ███████╗ █████╗ ████████╗███████╗
██╔════╝██╔══██╗██╔════╝██╔══██╗╚══██╔══╝██╔════╝
██║     ██████╔╝█████╗  ███████║   ██║   █████╗  
██║     ██╔══██╗██╔══╝  ██╔══██║   ██║   ██╔══╝  
╚██████╗██║  ██║███████╗██║  ██║   ██║   ███████╗
 ╚═════╝╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝   ╚═╝   ╚══════╝
*/
function addNewBillet ($author, $title, $core) {
    $db = dbConnect();
    $titleNewBillet = htmlspecialchars($title);
    $coreNewBillet = htmlspecialchars($core);
    $billetUniqID = ('billet-' . md5($titleNewBillet.NOW));
    try
	{
		$rep = $db->prepare('INSERT INTO billets(
		JF_billets_uniqID,
		JF_billets_author,
		JF_billets_title,
		JF_billets_content,
		JF_billets_date,
		JF_billets_state,
		JF_billets_lastUpdate
		) VALUES(
        :billetUniqID,
		:pseudo,
		:title, 
		:corps, 
		"'.NOW.'", 
		1, 
		"'.NOW.'"
		)');
	    $rep->execute(array(
	        ':billetUniqID'=>$billetUniqID,
	        ':pseudo'=>$author,
	        ':title'=>$titleNewBillet,
	        ':corps'=>$coreNewBillet	        
	        )
	    );    		
	}
	catch(Exception $e)
	{
	   die('Erreur : '.$e->getMessage());
	}

    if ($rep == true)    
	{
		$return = 'newBilletSave';
		return $return;
	}
	else
	{
		$return = 'newBilletError';
		return $return;
	}
}
/*
██████╗ ███████╗ █████╗ ██████╗ 
██╔══██╗██╔════╝██╔══██╗██╔══██╗
██████╔╝█████╗  ███████║██║  ██║
██╔══██╗██╔══╝  ██╔══██║██║  ██║
██║  ██║███████╗██║  ██║██████╔╝
╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝╚═════╝
*/
function showBillet() {
    $db = dbConnect();
    
    try
	{
		$rep = $db->prepare('SELECT JF_billets_uniqID,
        JF_billets_author,
        JF_billets_title,
        JF_billets_content,
        JF_billets_date,
        JF_billets_state,
        JF_billets_lastUpdate
        FROM billets 
        ORDER BY JF_billets_id DESC
        ');

	    $rep->execute();    		
	}
	catch(Exception $e)
	{
	   die('Erreur : '.$e->getMessage());
	}

    return $rep;
	
}
/*
███████╗████████╗ █████╗ ████████╗██╗   ██╗████████╗
██╔════╝╚══██╔══╝██╔══██╗╚══██╔══╝██║   ██║╚══██╔══╝
███████╗   ██║   ███████║   ██║   ██║   ██║   ██║   
╚════██║   ██║   ██╔══██║   ██║   ██║   ██║   ██║   
███████║   ██║   ██║  ██║   ██║   ╚██████╔╝   ██║   
╚══════╝   ╚═╝   ╚═╝  ╚═╝   ╚═╝    ╚═════╝    ╚═╝   
*/
function statutBillet($UniqIDBillet, $mode) {
	
	$db = dbConnect();
    try
	{
		
		if ($mode == 0) {
			
			$rep = $db->prepare('UPDATE billets SET JF_billets_state = 0, JF_billets_lastUpdate = :lastupdate WHERE JF_billets_uniqID = :uniqIDBillet');
        }
        elseif ($mode == 1) {
			
			$rep = $db->prepare('UPDATE billets SET JF_billets_state = 1, JF_billets_lastUpdate = :lastupdate WHERE JF_billets_uniqID = :uniqIDBillet');
        }
		
        $rep->execute(array(':uniqIDBillet'=>$UniqIDBillet, ':lastupdate'=>NOW));    		  		
	}
	catch(Exception $e)
	{
		die('Erreur : '.$e->getMessage());
	}
	
    if ($rep == true)    
	{
		$return = 'statutBilletOK';
		return $return;
    }
	else
	{
		$return = 'statutBilletError';
		return $return;
	}
}


/*
██╗   ██╗██████╗ ██████╗  █████╗ ████████╗███████╗
██║   ██║██╔══██╗██╔══██╗██╔══██╗╚══██╔══╝██╔════╝
██║   ██║██████╔╝██║  ██║███████║   ██║   █████╗  
██║   ██║██╔═══╝ ██║  ██║██╔══██║   ██║   ██╔══╝  
╚██████╔╝██║     ██████╔╝██║  ██║   ██║   ███████╗
╚═════╝ ╚═╝     ╚═════╝ ╚═╝  ╚═╝   ╚═╝   ╚══════╝
*/
function updateBillet($uniqIdBillet) {
	
	$db = dbConnect();
    try
	{
		$rep = $db->prepare('SELECT JF_billets_uniqID,        
        JF_billets_title,
        JF_billets_content        
        FROM billets 
        WHERE JF_billets_uniqID = :uniqIdBillet
        ');

$rep->execute(array(':uniqIdBillet'=>$uniqIdBillet));    

return $rep;
}
catch(Exception $e)
{
	die('Erreur : '.$e->getMessage());
}
}

function majBillets ($UniqIDBillet, $title, $core) {
	
	$db = dbConnect();
    try
	{
		$rep = $db->prepare('UPDATE billets SET JF_billets_title = :title, JF_billets_content = :core WHERE JF_billets_uniqID = :uniqIDBillet');
		
        $rep->execute(array(':uniqIDBillet'=>$UniqIDBillet, ':title'=>$title, ':core'=>$core));    		  		
	}
	catch(Exception $e)
	{
		die('Erreur : '.$e->getMessage());
	}
	
    if ($rep == true)    
	{
		$return = 'updateBilletOK';
		return $return;
    }
	else
	{
		$return = 'updateBilletError';
		return $return;
	}
}

/*
██████╗ ███████╗██╗     ███████╗████████╗███████╗
██╔══██╗██╔════╝██║     ██╔════╝╚══██╔══╝██╔════╝
██║  ██║█████╗  ██║     █████╗     ██║   █████╗  
██║  ██║██╔══╝  ██║     ██╔══╝     ██║   ██╔══╝  
██████╔╝███████╗███████╗███████╗   ██║   ███████╗
╚═════╝ ╚══════╝╚══════╝╚══════╝   ╚═╝   ╚══════╝
*/
function deleteBillet($UniqIDBillet) {

	$db = dbConnect();
	try
	{
		$rep = $db->prepare('DELETE FROM `billets` WHERE JF_billets_uniqID =:uniqIDBillet');

		$rep->execute(array(':uniqIDBillet'=>$UniqIDBillet));    		  		
	}
	catch(Exception $e)
	{
	   die('Erreur : '.$e->getMessage());
	}

	if ($rep == true)    
	{
		$return = 'deleteBilletOK';
		return $return;
	}
	else
	{
		$return = 'deleteBilletError';
		return $return;
	}
}





