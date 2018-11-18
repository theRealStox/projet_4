<?php
/*
██████╗ ███████╗ █████╗ ██████╗      █████╗ ██╗     ██╗              
██╔══██╗██╔════╝██╔══██╗██╔══██╗    ██╔══██╗██║     ██║              
██████╔╝█████╗  ███████║██║  ██║    ███████║██║     ██║              
██╔══██╗██╔══╝  ██╔══██║██║  ██║    ██╔══██║██║     ██║              
██║  ██║███████╗██║  ██║██████╔╝    ██║  ██║███████╗███████╗         
╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝╚═════╝     ╚═╝  ╚═╝╚══════╝╚══════╝
*/
function content__showBillets() {

    $db = dbConnect();    

    try	{

		$rep = $db->prepare('SELECT JF_billets_uniqID,
        JF_billets_author,
        JF_billets_title,
        JF_billets_content,
        JF_billets_date,
        JF_billets_state,
        JF_billets_lastUpdate
        FROM billets 
        WHERE JF_billets_state = 1
        ORDER BY JF_billets_id DESC
        ');

	    $rep->execute();    		
	}
	catch(Exception $e)	{

	   die('Erreur : '.$e->getMessage());
	}

    return $rep;
	
}
/*  
██████╗ ███████╗ █████╗ ██████╗     ███████╗██╗███╗   ██╗ ██████╗    
██╔══██╗██╔════╝██╔══██╗██╔══██╗    ██╔════╝██║████╗  ██║██╔════╝    
██████╔╝█████╗  ███████║██║  ██║    ███████╗██║██╔██╗ ██║██║  ███╗   
██╔══██╗██╔══╝  ██╔══██║██║  ██║    ╚════██║██║██║╚██╗██║██║   ██║   
██║  ██║███████╗██║  ██║██████╔╝    ███████║██║██║ ╚████║╚██████╔╝██╗
╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝╚═════╝     ╚══════╝╚═╝╚═╝  ╚═══╝ ╚═════╝ ╚═╝
*/
function content__showDetailsBillet($refBillet) {

    $db = dbConnect();    
    try	{

		$rep = $db->prepare('SELECT JF_billets_uniqID,
        JF_billets_author,
        JF_billets_title,
        JF_billets_content,
        JF_billets_date,
        JF_billets_state,
        JF_billets_lastUpdate
        FROM billets 
        WHERE JF_billets_uniqID = :refBillet
        ');

        $rep->execute(array(':refBillet'=>$refBillet));	
	}
	catch(Exception $e)	{

	   die('Erreur : '.$e->getMessage());
	}

    return $rep;
	
}
function content__countCommentsBillet($refBillet) {
    $db = dbConnect();    
    
    try	{

        $query=$db->prepare('SELECT COUNT(JF_comments_uniqID) AS nbCommentsBillets FROM comments WHERE JF_comments_billet_uniqID = :refBillet AND JF_comments_state = 1');
        $query->bindValue(':refBillet',$refBillet, PDO::PARAM_STR);		
        $query->execute();
        $nbCommentsBillets=($query->fetchColumn());
        $query->CloseCursor();

    }
    catch(Exception $e)	{
        
        die('Erreur : '.$e->getMessage());
    }	    
    
    return $nbCommentsBillets;
}
function content__showCommentsBillet($refBillet) {

    $db = dbConnect();    

    try	{

        $rep = $db->prepare('SELECT JF_comments_uniqID, 
        JF_comments_billet_uniqID, 
        JF_comments_author, 
        JF_comments_author_uniqID, 
        JF_comments_date, 
        JF_comments_comment, 
        JF_comments_state
        FROM comments 
        WHERE JF_comments_billet_uniqID = :refBillet
        AND JF_comments_state = 1
        ORDER BY JF_comments_date DESC
        ');

        $rep->execute(array(':refBillet'=>$refBillet));	

    }
    catch(Exception $e)	{
        
        die('Erreur : '.$e->getMessage());
    }	
    
    return $rep;
}
/*
 ██████╗██████╗ ███████╗ █████╗ ████████╗███████╗                 
██╔════╝██╔══██╗██╔════╝██╔══██╗╚══██╔══╝██╔════╝                 
██║     ██████╔╝█████╗  ███████║   ██║   █████╗                   
██║     ██╔══██╗██╔══╝  ██╔══██║   ██║   ██╔══╝                   
╚██████╗██║  ██║███████╗██║  ██║   ██║   ███████╗                 
 ╚═════╝╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝   ╚═╝   ╚══════╝                 
                                                                  
 ██████╗ ██████╗ ███╗   ███╗███╗   ███╗███████╗███╗   ██╗████████╗
██╔════╝██╔═══██╗████╗ ████║████╗ ████║██╔════╝████╗  ██║╚══██╔══╝
██║     ██║   ██║██╔████╔██║██╔████╔██║█████╗  ██╔██╗ ██║   ██║   
██║     ██║   ██║██║╚██╔╝██║██║╚██╔╝██║██╔══╝  ██║╚██╗██║   ██║   
╚██████╗╚██████╔╝██║ ╚═╝ ██║██║ ╚═╝ ██║███████╗██║ ╚████║   ██║   
 ╚═════╝ ╚═════╝ ╚═╝     ╚═╝╚═╝     ╚═╝╚══════╝╚═╝  ╚═══╝   ╚═╝   
*/
function content__addComment($content__comment__uniqID, $referenceBillet, $content__comment) {

    $db = dbConnect();    

    try	{

		$rep = $db->prepare('INSERT INTO comments(
		JF_comments_uniqID,
		JF_comments_billet_uniqID,
		JF_comments_author,
		JF_comments_author_uniqID,
		JF_comments_date,
		JF_comments_comment,
		JF_comments_state
		) VALUES(
        :content__comment__uniqID,
		:referenceBillet,
		:pseudoUser, 
		:uniqIDUser, 
        "'.NOW.'", 
        :content__comment, 
		0
		)');
	    $rep->execute(array(
	        ':content__comment__uniqID'=>$content__comment__uniqID,
	        ':referenceBillet'=>$referenceBillet,
	        ':pseudoUser'=>$_SESSION['pseudo'],
            ':uniqIDUser'=>$_SESSION['uniqID'],  
            ':content__comment'=>$content__comment      
	        )
	    );    		
	}
	catch(Exception $e) {

	   die('Erreur : '.$e->getMessage());
	}

    if ($rep == true) {

		$return = 'newCommentSave';
		return $return;
	}
	else {

		$return = 'newCommentError';
		return $return;
	}
    
}