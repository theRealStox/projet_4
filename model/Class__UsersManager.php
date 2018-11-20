<?php
class UsersManager
{
    private $_db;

    public function __construct($db) {

        $this->setDb__F__UsersManager($db);
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
    public function setDb__F__UsersManager(PDO $db) {$this->_db = $db;}

    
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
    ██████╗██████╗ ███████╗ █████╗ ████████╗███████╗
    ██╔════╝██╔══██╗██╔════╝██╔══██╗╚══██╔══╝██╔════╝
    ██║     ██████╔╝█████╗  ███████║   ██║   █████╗  
    ██║     ██╔══██╗██╔══╝  ██╔══██║   ██║   ██╔══╝  
    ╚██████╗██║  ██║███████╗██║  ██║   ██║   ███████╗
    ╚═════╝╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝   ╚═╝   ╚══════╝
    */
    function newUserVerif__pseudo__F__UsersManager($pseudo){

        try	{

            $query=$this->_db->prepare('SELECT COUNT(*) AS nbr FROM user WHERE JF_user_pseudo =:pseudo');
            $query->bindValue(':pseudo',$pseudo, PDO::PARAM_STR);
            $query->execute();
            $pseudo_free=($query->fetchColumn()==0)?1:0;
            $query->CloseCursor();
        }
        catch(Exception $e) {
            
            die('Erreur newUserVerif__pseudo__F__UsersManager: '.$e->getMessage());
        }

        return $pseudo_free;
    }

    function newUserVerif__email__F__UsersManager($email){

        try	{
            
            $query=$this->_db->prepare('SELECT COUNT(*) AS nbr FROM user WHERE JF_user_mail =:email');
            $query->bindValue(':email',$email, PDO::PARAM_STR);
            $query->execute();
            $mail_free=($query->fetchColumn()==0)?1:0;
            $query->CloseCursor();	   
        }
        catch(Exception $e) {
            
            die('Erreur newUserVerif__email__F__UsersManager: '.$e->getMessage());
        }
        
        return $mail_free;
    }         

    function newUserInsert__F__UsersManager($pseudo, $uniqueID, $mdp_hash, $email) {

        try	{

            $rep = $this->_db->prepare('INSERT INTO user(
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

            $rep->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
            $rep->bindValue(':uniqueID', $uniqueID, PDO::PARAM_STR);
            $rep->bindValue(':mdp_hash', $mdp_hash, PDO::PARAM_STR);
            $rep->bindValue(':email', $email, PDO::PARAM_STR);
            $rep->execute();
        }
        catch(Exception $e)	{
            
            die('Erreur newUserInsert__F__UsersManager: '.$e->getMessage());
        }
        
        return $rep;
    }
    /*
    ██████╗ ██████╗ ███╗   ██╗███╗   ██╗███████╗██╗  ██╗██╗ ██████╗ ███╗   ██╗
    ██╔════╝██╔═══██╗████╗  ██║████╗  ██║██╔════╝╚██╗██╔╝██║██╔═══██╗████╗  ██║
    ██║     ██║   ██║██╔██╗ ██║██╔██╗ ██║█████╗   ╚███╔╝ ██║██║   ██║██╔██╗ ██║
    ██║     ██║   ██║██║╚██╗██║██║╚██╗██║██╔══╝   ██╔██╗ ██║██║   ██║██║╚██╗██║
    ╚██████╗╚██████╔╝██║ ╚████║██║ ╚████║███████╗██╔╝ ██╗██║╚██████╔╝██║ ╚████║
    ╚═════╝ ╚═════╝ ╚═╝  ╚═══╝╚═╝  ╚═══╝╚══════╝╚═╝  ╚═╝╚═╝ ╚═════╝ ╚═╝  ╚═══╝
    */
    function getUserLogs__F__UsersManager($pseudoPost) {

        sleep(1);

        try	{

            $rep = $this->_db->prepare('SELECT 
            JF_user_pseudo,
            JF_user_pass,
            JF_user_detailsConfirmed,
            JF_user_uniqID, 
            JF_user_confirmAccount
            FROM user WHERE JF_user_pseudo = :pseudoPost');

            $rep->bindValue(':pseudoPost', $pseudoPost, PDO::PARAM_STR);
            $rep->execute();
            
        }
        catch(Exception $e)	{
            
            die('Erreur getUserLogs__F__UsersManager: '.$e->getMessage());
        }
        
        return $rep;
    }

    function getUserRole__F__UsersManager($pseudo) {

        try	{

            $query = $this->_db->prepare('SELECT COUNT(JF_roleUser_pseudo) AS isSet FROM roleuser WHERE JF_roleUser_pseudo = :pseudo AND JF_roleUser_role = "admin"');
            $query->bindValue(':pseudo',$pseudo, PDO::PARAM_STR);			
            $query->execute();
            $isSet=($query->fetchColumn());
            $query->CloseCursor();
            
        }
        catch(Exception $e) {
            
            die('Erreur getUserRole__F__UsersManager: '.$e->getMessage());
        }
        return $isSet;
    }
    /*
    ███████╗███████╗███████╗███████╗       ██████╗ ███████╗███████╗████████╗
    ██╔════╝██╔════╝██╔════╝██╔════╝       ██╔══██╗██╔════╝██╔════╝╚══██╔══╝
    ███████╗█████╗  ███████╗███████╗       ██║  ██║█████╗  ███████╗   ██║   
    ╚════██║██╔══╝  ╚════██║╚════██║       ██║  ██║██╔══╝  ╚════██║   ██║   
    ███████║███████╗███████║███████║██╗    ██████╔╝███████╗███████║   ██║   
    ╚══════╝╚══════╝╚══════╝╚══════╝╚═╝    ╚═════╝ ╚══════╝╚══════╝   ╚═╝   
    */
    function sessionDestroy__F__UsersManager() {

        session_destroy();
        header('Location: index.php');
    }
}