<?php
class Billet
{
    private $_billet_id;
    private $_billet_uniqID;
    private $_billet_author;
    private $_billet_title;
    private $_billet_content;
    private $_billet_date;
    private $_billet_state;
    private $_billet_lastUpdate;

    public function __construct(array $data) {

      $this->hydrate($data);
    }

    public function hydrate(array $data) {

        foreach ($data as $key => $value)
        {
          // On récupère le nom du setter correspondant à l'attribut.
          $reductedKey = substr($key, 11);
          $method = 'set' . ucfirst($reductedKey) . '__F__Billet';
              
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
    public function get_billet_id() {return $this->_billet_id;}
    public function get_billet_uniqID() {return $this->_billet_uniqID;}
    public function get_billet_author() {return $this->_billet_author;}
    public function get_billet_title() {return $this->_billet_title;}
    public function get_billet_content() {return $this->_billet_content;}
    public function get_billet_date() {return $this->_billet_date;}
    public function get_billet_state() {return $this->_billet_state;}
    public function get_billet_lastUpdate() {return $this->_billet_lastUpdate;}
    
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
    public function setId__F__Billet($id) {

        if (!is_int(intval($id))) {

            trigger_error('Le Champ ID doit être un nombre entier', E_USER_WARNING);
            return;
        } 

        $this->_billet_id = $id;
    }

    public function setUniqID__F__Billet($uniqID) {

        if (!is_string($uniqID)) {            

            trigger_error('Le Champ uniqID doit être une chaine de caractères', E_USER_WARNING);
            return;
        } 

        $this->_billet_uniqID = $uniqID;
    }   

    public function setAuthor__F__Billet($author) {

        if (!is_string($author)) {

            trigger_error('Le Champ author doit être une chaine de caractères', E_USER_WARNING);
            return;
        } 

        $this->_billet_author = $author;
    }

    public function setTitle__F__Billet($title) {

        if (!is_string($title)) {

            trigger_error('Le Champ title doit être une chaine de caractères', E_USER_WARNING);
            return;
        } 

        $this->_billet_title = $title;
    }

    public function setContent__F__Billet($content) {

        if (!is_string($content)) {

            trigger_error('Le Champ content doit être une chaine de caractères', E_USER_WARNING);
            return;
        } 

        $this->_billet_content = $content;
    }

    public function setDate__F__Billet($date) {

        if (!is_string($date)) {

            trigger_error('Le Champ date doit être une chaine de caractères', E_USER_WARNING);
            return;
        } 

        $this->_billet_date = $date;
    }

    
    public function setState__F__Billet($state) {
        
        if (!is_int(intval($state))) {
            
            trigger_error('Le Champ state doit être un nombre entier', E_USER_WARNING);
            return;
        } 
        
        $this->_billet_state = $state;
    }

    public function setLastUpdate__F__Billet($lastUpdate) {

        if (!is_string($lastUpdate)) {

            trigger_error('Le Champ lastUpdate doit être une chaine de caractères', E_USER_WARNING);
            return;
        } 

        $this->_billet_lastUpdate = $lastUpdate;
    }
}
