<?php
class BilletManager
{
    private $_db;

    public function __construct($db) {

        $this->setDb__F__BilletManager($db);
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
    public function setDb__F__BilletManager(PDO $db) {$this->_db = $db;}

    
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
    public function getCountBillets__F__BilletManager()  {
        
        try	{

            return $this->_db->query('SELECT COUNT(JF_billets_id) FROM billets')->fetchColumn();
        }
        catch(Exception $e)	{

            die('Erreur getCountBillets__F__BilletManager: '.$e->getMessage());
        }
    }
    public function getCountBilletsP__F__BilletManager()  {

        try	{

            return $this->_db->query('SELECT COUNT(JF_billets_id) FROM billets WHERE JF_billets_state = 1')->fetchColumn();
        }
        catch(Exception $e)	{

            die('Erreur getCountBilletsP__F__BilletManager: '.$e->getMessage());
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
    public function getListBillets__F__BilletManager($mode) {
    
        $O__Billet = [];

        try	{
            if ($mode === 1) {

                $q = $this->_db->prepare('SELECT * FROM billets WHERE JF_billets_state = 1 ORDER BY JF_billets_date DESC');
                $q->execute();
            }
            else {
                $q = $this->_db->prepare('SELECT * FROM billets ORDER BY JF_billets_id DESC');
                $q->execute();
            }
            
        }
        catch(Exception $e)	{

            die('Erreur getListBillets__F__BilletManager: '.$e->getMessage());
        }

        while ($data = $q->fetch(PDO::FETCH_ASSOC))
        {
            $O__Billet[] = new Billet($data);
        }

        return $O__Billet;
    }
    public function getBillet__F__BilletManager($refereceBillet) {
    
        try	{
           
            $q = $this->_db->prepare('SELECT * FROM billets WHERE JF_billets_uniqID = :refereceBillet LIMIT 1');
            $q->bindValue(':refereceBillet', $refereceBillet, PDO::PARAM_STR);
            $q->execute();
       
        }
        catch(Exception $e)	{

            die('Erreur getBillet__F__BilletManager: '.$e->getMessage());
        }

        while ($data = $q->fetch(PDO::FETCH_ASSOC))
        {
            $O__Billet = new Billet($data);
        }

        return $O__Billet;
    }
    /*
    ██████╗██████╗ ███████╗ █████╗ ████████╗███████╗
    ██╔════╝██╔══██╗██╔════╝██╔══██╗╚══██╔══╝██╔════╝
    ██║     ██████╔╝█████╗  ███████║   ██║   █████╗  
    ██║     ██╔══██╗██╔══╝  ██╔══██║   ██║   ██╔══╝  
    ╚██████╗██║  ██║███████╗██║  ██║   ██║   ███████╗
    ╚═════╝╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝   ╚═╝   ╚══════╝
    */
    public function addNewBillet__F__BilletManager($author, $titleNewBillet, $coreNewBillet, $billetUniqID) {

        try
        {
            $rep = $this->_db->prepare('INSERT INTO billets(
            JF_billets_uniqID,
            JF_billets_author,
            JF_billets_title,
            JF_billets_content,
            JF_billets_date,
            JF_billets_state,
            JF_billets_lastUpdate
            ) VALUES(
            :billetUniqID,
            :author,
            :title, 
            :corps, 
            "'.NOW.'", 
            1, 
            "'.NOW.'"
            )');
                        
            $rep->bindValue(':billetUniqID', $billetUniqID, PDO::PARAM_STR);
            $rep->bindValue(':author', $author, PDO::PARAM_STR);
            $rep->bindValue(':title', $titleNewBillet, PDO::PARAM_STR);
            $rep->bindValue(':corps', $coreNewBillet, PDO::PARAM_STR);
            $rep->execute();
        }
        catch(Exception $e)
        {
        die('Erreur addNewBillet__F__BilletManager: '.$e->getMessage());
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
    ██╗   ██╗██████╗ ██████╗  █████╗ ████████╗███████╗
    ██║   ██║██╔══██╗██╔══██╗██╔══██╗╚══██╔══╝██╔════╝
    ██║   ██║██████╔╝██║  ██║███████║   ██║   █████╗  
    ██║   ██║██╔═══╝ ██║  ██║██╔══██║   ██║   ██╔══╝  
    ╚██████╔╝██║     ██████╔╝██║  ██║   ██║   ███████╗
    ╚═════╝ ╚═╝     ╚═════╝ ╚═╝  ╚═╝   ╚═╝   ╚══════╝
    */
    public function getDetailsForUpdateBillet__F__BilletManager($uniqIdBillet) {
        
        try {

            $rep = $this->_db->prepare('SELECT JF_billets_uniqID,        
            JF_billets_title,
            JF_billets_content        
            FROM billets 
            WHERE JF_billets_uniqID = :uniqIdBillet
            ');

            $rep->bindValue(':uniqIdBillet', $uniqIdBillet, PDO::PARAM_STR);
            $rep->execute();

        }
        catch(Exception $e) {
            
            die('Erreur getDetailsForUpdateBillet__F__BilletManager: '. $e->getMessage());
        }
        
        return $rep;
    }

    public function updateBillets__F__BilletManager ($uniqIdBillet, $title, $core) {
        
        try {

            $rep = $this->_db->prepare('UPDATE billets SET JF_billets_title = :title, JF_billets_content = :core WHERE JF_billets_uniqID = :uniqIdBillet');
            
            $rep->bindValue(':uniqIdBillet', $uniqIdBillet, PDO::PARAM_STR);
            $rep->bindValue(':title', $title, PDO::PARAM_STR);
            $rep->bindValue(':core', $core, PDO::PARAM_STR);
            $rep->execute();    		  		
        }
        catch(Exception $e)
        {
            die('Erreur updateBillets__F__BilletManager: '.$e->getMessage());
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
    ███████╗████████╗ █████╗ ████████╗██╗   ██╗████████╗
    ██╔════╝╚══██╔══╝██╔══██╗╚══██╔══╝██║   ██║╚══██╔══╝
    ███████╗   ██║   ███████║   ██║   ██║   ██║   ██║   
    ╚════██║   ██║   ██╔══██║   ██║   ██║   ██║   ██║   
    ███████║   ██║   ██║  ██║   ██║   ╚██████╔╝   ██║   
    ╚══════╝   ╚═╝   ╚═╝  ╚═╝   ╚═╝    ╚═════╝    ╚═╝   
    */
    public function updateStatutBillet__F__BilletManager($uniqIDBillet, $mode) {
	
        try {            
            if ($mode == 0) {
                
                $rep = $this->_db->prepare('UPDATE billets SET JF_billets_state = 0, JF_billets_lastUpdate = :lastupdate WHERE JF_billets_uniqID = :uniqIDBillet');
            }
            elseif ($mode == 1) {
                
                $rep = $this->_db->prepare('UPDATE billets SET JF_billets_state = 1, JF_billets_lastUpdate = :lastupdate WHERE JF_billets_uniqID = :uniqIDBillet');
            }
            
            $rep->bindValue(':lastupdate', NOW, PDO::PARAM_STR);
            $rep->bindValue(':uniqIDBillet', $uniqIDBillet, PDO::PARAM_STR);
            $rep->execute();	 

        }
        catch(Exception $e)
        {
            die('Erreur updateStatutBillet__F__BilletManager: '.$e->getMessage());
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
    ██████╗ ███████╗██╗     ███████╗████████╗███████╗
    ██╔══██╗██╔════╝██║     ██╔════╝╚══██╔══╝██╔════╝
    ██║  ██║█████╗  ██║     █████╗     ██║   █████╗  
    ██║  ██║██╔══╝  ██║     ██╔══╝     ██║   ██╔══╝  
    ██████╔╝███████╗███████╗███████╗   ██║   ███████╗
    ╚═════╝ ╚══════╝╚══════╝╚══════╝   ╚═╝   ╚══════╝
    */
    function deleteBillet__F__BilletManager($uniqIDBillet) {

        try {

            $rep = $this->_db->prepare('DELETE FROM billets WHERE JF_billets_uniqID =:uniqIDBillet');

            $rep->bindValue(':uniqIDBillet', $uniqIDBillet, PDO::PARAM_STR);
            $rep->execute();	 	  		
        }
        catch(Exception $e) {

            die('Erreur deleteBillet__F__BilletManager : '.$e->getMessage());
        }

        if ($rep == true) {

            $return = 'deleteBilletOK';
            return $return;
        }
        else {

            $return = 'deleteBilletError';
            return $return;
        }
    }

}