<?php
/*
███████╗██╗  ██╗ ██████╗ ██╗    ██╗
██╔════╝██║  ██║██╔═══██╗██║    ██║
███████╗███████║██║   ██║██║ █╗ ██║
╚════██║██╔══██║██║   ██║██║███╗██║
███████║██║  ██║╚██████╔╝╚███╔███╔╝
╚══════╝╚═╝  ╚═╝ ╚═════╝  ╚══╝╚══╝ 
*/
function comment__showComments() {

    $db = dbConnect();    

    try	{

		$rep = $db->prepare('SELECT *
        FROM comments 
        ORDER BY JF_comments_id DESC
        ');

	    $rep->execute();    		
	}
	catch(Exception $e)	{

	   die('Erreur : '.$e->getMessage());
	}

    return $rep;
	
}
/*
██████╗ ███████╗███╗   ██╗██╗   ██╗
██╔══██╗██╔════╝████╗  ██║╚██╗ ██╔╝
██║  ██║█████╗  ██╔██╗ ██║ ╚████╔╝ 
██║  ██║██╔══╝  ██║╚██╗██║  ╚██╔╝  
██████╔╝███████╗██║ ╚████║   ██║   
╚═════╝ ╚══════╝╚═╝  ╚═══╝   ╚═╝  
*/
function comment__denyComment($referenceComment) {

    $db = dbConnect();    

    try	{

		$rep = $db->prepare('UPDATE comments
        SET JF_comments_state = 2
        WHERE JF_comments_uniqID = :referenceComment
        ');

	    $rep->execute(array(':referenceComment' => $referenceComment));    		
	}
	catch(Exception $e)	{

	   die('Erreur : '.$e->getMessage());
	}

    return $rep;

}
/*
██╗   ██╗ █████╗ ██╗     ██╗██████╗ 
██║   ██║██╔══██╗██║     ██║██╔══██╗
██║   ██║███████║██║     ██║██║  ██║
╚██╗ ██╔╝██╔══██║██║     ██║██║  ██║
 ╚████╔╝ ██║  ██║███████╗██║██████╔╝
  ╚═══╝  ╚═╝  ╚═╝╚══════╝╚═╝╚═════╝ 
*/
function comment__validComment($referenceComment) {

    $db = dbConnect();    

    try	{

		$rep = $db->prepare('UPDATE comments
        SET JF_comments_state = 1
        WHERE JF_comments_uniqID = :referenceComment
        ');

	    $rep->execute(array(':referenceComment' => $referenceComment));    		
	}
	catch(Exception $e)	{

	   die('Erreur : '.$e->getMessage());
	}

    return $rep;

}