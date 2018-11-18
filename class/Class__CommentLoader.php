<?php
class CommentLoader
{
    private $_db; // Instance de PDO

    public function __construct($db) {

        $this->setDb__F__CommentLoader($db);
    }

    public function setDb__F__CommentLoader(PDO $db) {$this->_db = $db;}

    /*
    public function setDb__F__CommentLoader() {

        $q = $this->_db->query('SELECT * FROM comments WHERE JF_comments_id = '.$info);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
      
        return new Comment($donnees);
    }
    */
}