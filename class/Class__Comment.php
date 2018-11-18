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
    ███████╗███████╗████████╗████████╗███████╗██████╗ ███████╗
    ██╔════╝██╔════╝╚══██╔══╝╚══██╔══╝██╔════╝██╔══██╗██╔════╝
    ███████╗█████╗     ██║      ██║   █████╗  ██████╔╝███████╗
    ╚════██║██╔══╝     ██║      ██║   ██╔══╝  ██╔══██╗╚════██║
    ███████║███████╗   ██║      ██║   ███████╗██║  ██║███████║
    ╚══════╝╚══════╝   ╚═╝      ╚═╝   ╚══════╝╚═╝  ╚═╝╚══════╝
    */
    public function setId__F__Comment($data['JF_comments_id']) {

        if (!is_int($data['JF_comments_id'])) {

            trigger_error('L\'ID d\'un commentaire doit être un nombre entier', E_USER_WARNING);
            return;
        } 

        $this->_comment_id = $data['JF_comments_id'];
    }

    public function setUniqID__F__Comment($data['JF_comments_uniqID']) {

        if (!is_string($data['JF_comments_uniqID'])) {

            trigger_error('L\'uniqID d\'un commentaire doit être une chaine de caractères', E_USER_WARNING);
            return;
        } 

        $this->_comment_uniqID = $data['JF_comments_uniqID'];
    }

    public function setBillet_uniqID__F__Comment($data['JF_comments_billet_uniqID']) {

        if (!is_string($data['JF_comments_billet_uniqID'])) {

            trigger_error('L\'uniqID du billet d\'un commentaire doit être une chaine de caractères', E_USER_WARNING);
            return;
        } 

        $this->_comment_billet_uniqID = $data['JF_comments_billet_uniqID'];
    }

    public function setAuthor__F__Comment($data['JF_comments_author']) {

        if (!is_string($data['JF_comments_author'])) {

            trigger_error('L\'author d\'un commentaire doit être une chaine de caractères', E_USER_WARNING);
            return;
        } 

        $this->_comment_author = $data['JF_comments_author'];
    }

    public function setAuthor_uniqID__F__Comment($data['JF_comments_author_uniqID']) {

        if (!is_string($data['JF_comments_author_uniqID'])) {

            trigger_error('L\'uniqID de l\'author d\'un commentaire doit être une chaine de caractères', E_USER_WARNING);
            return;
        } 

        $this->_comment_author_uniqID = $data['JF_comments_author_uniqID'];
    }

    public function setDate__F__Comment($data['JF_comments_date']) {

        if (!is_string($data['JF_comments_date'])) {

            trigger_error('La date d\'un commentaire doit être une chaine de caractères', E_USER_WARNING);
            return;
        } 

        $this->_comment_date = $data['JF_comments_date'];
    }

    public function setComment__F__Comment($data['JF_comments_comment']) {

        if (!is_string($data['JF_comments_comment'])) {

            trigger_error('La corps d\'un commentaire doit être une chaine de caractères', E_USER_WARNING);
            return;
        } 

        $this->_comment_comment = $data['JF_comments_comment'];
    }

    public function setState__F__Comment($data['JF_comments_state']) {

        if (!is_int($data['JF_comments_state'])) {

            trigger_error('Le state d\'un commentaire doit être un nombre entier', E_USER_WARNING);
            return;
        } 

        $this->_comment_state = $data['JF_comments_state'];
    }
}
