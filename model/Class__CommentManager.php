<?php
class CommentManager
{
    private $_db;

    public function __construct($db) {

        $this->setDb__F__CommentManager($db);
    }    
    /*
    ███████╗███████╗███████╗███████╗███████╗███████╗███████╗███████╗███████╗███████╗███████╗███████╗███████╗
    ╚══════╝╚══════╝╚══════╝╚══════╝╚══════╝╚══════╝╚══════╝╚══════╝╚══════╝╚══════╝╚══════╝╚══════╝╚══════╝
    */
    /*
    ███████╗███████╗████████╗████████╗███████╗██████╗ ███████╗
    ██╔════╝██╔════╝╚══██╔══╝╚══██╔══╝██╔════╝██╔══██╗██╔════╝
    ███████╗█████╗     ██║      ██║   █████╗  ██████╔╝███████╗
    ╚════██║██╔══╝     ██║      ██║   ██╔══╝  ██╔══██╗╚════██║
    ███████║███████╗   ██║      ██║   ███████╗██║  ██║███████║
    ╚══════╝╚══════╝   ╚═╝      ╚═╝   ╚══════╝╚═╝  ╚═╝╚══════╝
    */    
    public function setDb__F__CommentManager(PDO $db) {$this->_db = $db;}

    
    /*
    ███████╗███████╗███████╗███████╗███████╗███████╗███████╗███████╗███████╗███████╗███████╗███████╗███████╗
    ╚══════╝╚══════╝╚══════╝╚══════╝╚══════╝╚══════╝╚══════╝╚══════╝╚══════╝╚══════╝╚══════╝╚══════╝╚══════╝
    */
    /*
    ███╗   ███╗███████╗████████╗██╗  ██╗ ██████╗ ██████╗ ███████╗
    ████╗ ████║██╔════╝╚══██╔══╝██║  ██║██╔═══██╗██╔══██╗██╔════╝
    ██╔████╔██║█████╗     ██║   ███████║██║   ██║██║  ██║███████╗
    ██║╚██╔╝██║██╔══╝     ██║   ██╔══██║██║   ██║██║  ██║╚════██║
    ██║ ╚═╝ ██║███████╗   ██║   ██║  ██║╚██████╔╝██████╔╝███████║
    ╚═╝     ╚═╝╚══════╝   ╚═╝   ╚═╝  ╚═╝ ╚═════╝ ╚═════╝ ╚══════╝
    */
    /*
    ██████╗ ██████╗ ██╗   ██╗███╗   ██╗████████╗
    ██╔════╝██╔═══██╗██║   ██║████╗  ██║╚══██╔══╝
    ██║     ██║   ██║██║   ██║██╔██╗ ██║   ██║   
    ██║     ██║   ██║██║   ██║██║╚██╗██║   ██║   
    ╚██████╗╚██████╔╝╚██████╔╝██║ ╚████║   ██║   
    ╚═════╝ ╚═════╝  ╚═════╝ ╚═╝  ╚═══╝   ╚═╝   
    */
    public function getCountComments__F__CommentManager()  {

        try	{

            return $this->_db->query('SELECT COUNT(JF_comments_id) FROM comments')->fetchColumn();
        }
        catch(Exception $e)	{

            die('Erreur getCountComments__F__CommentManager: '.$e->getMessage());
        }
    }
    public function getCountCommentsBillet__F__CommentManager($refBillet)  {

        try	{

            $rep = $this->_db->prepare('SELECT COUNT(JF_comments_uniqID) AS nbCommentsBillets FROM comments 
                WHERE (JF_comments_billet_uniqID = :refBillet AND JF_comments_state = 1) 
                OR (JF_comments_billet_uniqID = :refBillet AND JF_comments_state = 3)');
            $rep->bindValue(':refBillet',$refBillet, PDO::PARAM_STR);		
            $rep->execute();
            $nbCommentsBillets=($rep->fetchColumn());
            $rep->CloseCursor();
        }
        catch(Exception $e)	{

            die('Erreur getCountCommentsBillet__F__CommentManager: '.$e->getMessage());
        }

        return $nbCommentsBillets;
    }
    /*
     ██████╗██████╗ ███████╗ █████╗ ████████╗███████╗                 
    ██╔════╝██╔══██╗██╔════╝██╔══██╗╚══██╔══╝██╔════╝                 
    ██║     ██████╔╝█████╗  ███████║   ██║   █████╗                   
    ██║     ██╔══██╗██╔══╝  ██╔══██║   ██║   ██╔══╝                   
    ╚██████╗██║  ██║███████╗██║  ██║   ██║   ███████╗                 
    ╚═════╝╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝   ╚═╝   ╚══════╝        
    */
    function addComment__F__CommentManager($content__comment__uniqID, $referenceBillet, $content__comment) {

        try	{
    
            $rep = $this->_db->prepare('INSERT INTO comments(
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

            $rep->bindValue(':content__comment__uniqID', $content__comment__uniqID, PDO::PARAM_STR);
            $rep->bindValue(':referenceBillet', $referenceBillet, PDO::PARAM_STR);
            $rep->bindValue(':pseudoUser', $_SESSION['pseudo'], PDO::PARAM_STR);
            $rep->bindValue(':uniqIDUser', $_SESSION['uniqID'], PDO::PARAM_STR);
            $rep->bindValue(':content__comment', $content__comment, PDO::PARAM_STR);
            $rep->execute();   		
        }
        catch(Exception $e) {
    
           die('Erreur addComment__F__CommentManager: '.$e->getMessage());
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
    /*
    ██████╗ ███████╗ █████╗ ██████╗ 
    ██╔══██╗██╔════╝██╔══██╗██╔══██╗
    ██████╔╝█████╗  ███████║██║  ██║
    ██╔══██╗██╔══╝  ██╔══██║██║  ██║
    ██║  ██║███████╗██║  ██║██████╔╝
    ╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝╚═════╝ 
    */
    public function getComment__F__CommentManager($refereceCommentaire) {
        // Récupère un commentaire en fonction de son UniqID
        try	{            
            $q = $this->_db->prepare('SELECT * FROM comments 
                WHERE (JF_comments_billet_uniqID = :refereceCommentaire AND JF_comments_state = 1) 
                OR (JF_comments_billet_uniqID = :refereceCommentaire AND JF_comments_state = 3)');
            $q->bindValue(':refereceCommentaire', $refereceCommentaire, PDO::PARAM_STR);
            $q->execute();
        }
        catch(Exception $e)	{

            die('Erreur getComment__F__CommentManager: '.$e->getMessage());
        }

        $O__Comment = new Comment($data);

        return $O__Comment;
    }
    public function getListCommentsBillet__F__CommentManager($referenceBillet) {
        // Récupère la liste des commentaires d'un billet
        $O__Comment = [];

        try	{            
            $q = $this->_db->prepare('SELECT * FROM comments 
                WHERE (JF_comments_billet_uniqID = :referenceBillet AND JF_comments_state = 1) 
                OR (JF_comments_billet_uniqID = :referenceBillet AND JF_comments_state = 3) 
                ORDER BY JF_comments_id DESC');
            $q->bindValue(':referenceBillet', $referenceBillet, PDO::PARAM_STR);
            $q->execute();
        }
        catch(Exception $e)	{

            die('Erreur getListCommentsBillet__F__CommentManager: '.$e->getMessage());
        }

        while ($data = $q->fetch(PDO::FETCH_ASSOC))
        {
            $O__Comment[] = new Comment($data);
        }

        return $O__Comment;
    }
    public function getListComments__F__CommentManager() {
    
        $O__Comment = [];

        try	{            
            $q = $this->_db->prepare('SELECT * FROM comments ORDER BY JF_comments_id DESC');
            $q->execute();
        }
        catch(Exception $e)	{

            die('Erreur getListComments__F__CommentManager: '.$e->getMessage());
        }

        while ($data = $q->fetch(PDO::FETCH_ASSOC))
        {
            $O__Comment[] = new Comment($data);
        }

        return $O__Comment;
    }

    /*
    ██████╗ ███████╗███╗   ██╗██╗   ██╗
    ██╔══██╗██╔════╝████╗  ██║╚██╗ ██╔╝
    ██║  ██║█████╗  ██╔██╗ ██║ ╚████╔╝ 
    ██║  ██║██╔══╝  ██║╚██╗██║  ╚██╔╝  
    ██████╔╝███████╗██║ ╚████║   ██║   
    ╚═════╝ ╚══════╝╚═╝  ╚═══╝   ╚═╝  
    */
    public function denyComment__F__CommentManager($referenceComment) {
       
        try	{

            $rep = $this->_db->prepare('UPDATE comments
            SET JF_comments_state = 2
            WHERE JF_comments_uniqID = :referenceComment
            ');                
            $rep->bindValue(':referenceComment', $referenceComment, PDO::PARAM_STR);
            $rep->execute();
        }
        catch(Exception $e)	{
    
           die('Erreur denyComment__F__CommentManager: '.$e->getMessage());
        }
    
        return $rep;
    }
    /*
    ███████╗██╗ ██████╗ ███╗   ██╗ █████╗ ██╗     
    ██╔════╝██║██╔════╝ ████╗  ██║██╔══██╗██║     
    ███████╗██║██║  ███╗██╔██╗ ██║███████║██║     
    ╚════██║██║██║   ██║██║╚██╗██║██╔══██║██║     
    ███████║██║╚██████╔╝██║ ╚████║██║  ██║███████╗
    ╚══════╝╚═╝ ╚═════╝ ╚═╝  ╚═══╝╚═╝  ╚═╝╚══════╝
    */
    public function signalComment__F__CommentManager($referenceComment) {
       
        try	{

            $rep = $this->_db->prepare('UPDATE comments
            SET JF_comments_state = 3
            WHERE JF_comments_uniqID = :referenceComment
            ');                
            $rep->bindValue(':referenceComment', $referenceComment, PDO::PARAM_STR);
            $rep->execute();
        }
        catch(Exception $e)	{
    
           die('Erreur signalComment__F__CommentManager: '.$e->getMessage());
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
    public function validComment__F__CommentManager($referenceComment) {
       
        try	{

            $rep = $this->_db->prepare('UPDATE comments
            SET JF_comments_state = 1
            WHERE JF_comments_uniqID = :referenceComment
            ');                
            $rep->bindValue(':referenceComment', $referenceComment, PDO::PARAM_STR);
            $rep->execute();
        }
        catch(Exception $e)	{
    
           die('Erreur validComment__F__CommentManager: '.$e->getMessage());
        }
    
        return $rep;
    }
}