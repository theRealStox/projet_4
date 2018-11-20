<?php
class Comment
{
    private $_comment_id;
    private $_comment_uniqID;
    private $_comment_billet_uniqID;
    private $_comment_author;
    private $_comment_author_uniqID;
    private $_comment_date;
    private $_comment_comment;
    private $_comment_state;

    public function __construct(array $data) {

      $this->hydrate($data);
    }

    public function hydrate(array $data) {

        foreach ($data as $key => $value)
        {
          // On récupère le nom du setter correspondant à l'attribut.
          $reductedKey = substr($key, 12);
          $method = 'set' . ucfirst($reductedKey) . '__F__Comment';
              
          // Si le setter correspondant existe.
          if (method_exists($this, $method))
          {
            // On appelle le setter.
            $this->$method($value);
          }
        } 
    }
    /*
    ███████╗███████╗███████╗███████╗███████╗███████╗███████╗███████╗███████╗███████╗███████╗███████╗███████╗
    ╚══════╝╚══════╝╚══════╝╚══════╝╚══════╝╚══════╝╚══════╝╚══════╝╚══════╝╚══════╝╚══════╝╚══════╝╚══════╝
    */
    /*
     ██████╗ ███████╗████████╗████████╗███████╗██████╗ ███████╗
    ██╔════╝ ██╔════╝╚══██╔══╝╚══██╔══╝██╔════╝██╔══██╗██╔════╝
    ██║  ███╗█████╗     ██║      ██║   █████╗  ██████╔╝███████╗
    ██║   ██║██╔══╝     ██║      ██║   ██╔══╝  ██╔══██╗╚════██║
    ╚██████╔╝███████╗   ██║      ██║   ███████╗██║  ██║███████║
     ╚═════╝ ╚══════╝   ╚═╝      ╚═╝   ╚══════╝╚═╝  ╚═╝╚══════╝
    */
    public function get_comment_id() {return $this->_comment_id;}
    public function get_comment_uniqID() {return $this->_comment_uniqID;}
    public function get_comment_billet_uniqID() {return $this->_comment_billet_uniqID;}
    public function get_comment_author() {return $this->_comment_author;}
    public function get_comment_author_uniqID() {return $this->_comment_author_uniqID;}
    public function get_comment_date() {return $this->_comment_date;}
    public function get_comment_comment() {return $this->_comment_comment;}
    public function get_comment_state() {return $this->_comment_state;}
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
    public function setId__F__Comment($id) {

        if (!is_int(intval($id))) {

            trigger_error('L\'ID d\'un commentaire doit être un nombre entier', E_USER_WARNING);
            return;
        } 

        $this->_comment_id = $id;
    }

    public function setUniqID__F__Comment($uniqID) {

        if (!is_string($uniqID)) {            

            trigger_error('L\'uniqID d\'un commentaire doit être une chaine de caractères', E_USER_WARNING);
            return;
        } 

        $this->_comment_uniqID = $uniqID;
    }

    public function setBillet_uniqID__F__Comment($billet_uniqID) {

        if (!is_string($billet_uniqID)) {

            trigger_error('L\'uniqID du billet d\'un commentaire doit être une chaine de caractères', E_USER_WARNING);
            return;
        } 

        $this->_comment_billet_uniqID = $billet_uniqID;
    }

    public function setAuthor__F__Comment($author) {

        if (!is_string($author)) {

            trigger_error('L\'author d\'un commentaire doit être une chaine de caractères', E_USER_WARNING);
            return;
        } 

        $this->_comment_author = $author;
    }

    public function setAuthor_uniqID__F__Comment($author_uniqID) {

        if (!is_string($author_uniqID)) {

            trigger_error('L\'uniqID de l\'author d\'un commentaire doit être une chaine de caractères', E_USER_WARNING);
            return;
        } 

        $this->_comment_author_uniqID = $author_uniqID;
    }

    public function setDate__F__Comment($date) {

        if (!is_string($date)) {

            trigger_error('La date d\'un commentaire doit être une chaine de caractères', E_USER_WARNING);
            return;
        } 

        $this->_comment_date = $date;
    }

    public function setComment__F__Comment($comment) {

        if (!is_string($comment)) {

            trigger_error('La corps d\'un commentaire doit être une chaine de caractères', E_USER_WARNING);
            return;
        } 

        $this->_comment_comment = $comment;
    }

    public function setState__F__Comment($state) {

        if (!is_int(intval($state))) {

            trigger_error('Le state d\'un commentaire doit être un nombre entier', E_USER_WARNING);
            return;
        } 

        $this->_comment_state = $state;
    }
}
