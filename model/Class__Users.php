<?php
class Users
{

    private $_user_id;
    private $_user_pseudo;
    private $_user_uniqID;
    private $_user_pass;
    private $_user_mail;
    private $_user_nom;
    private $_user_prenom;
    private $_user_pays;
    private $_user_numRue;
    private $_user_nomRue;
    private $_user_codePostal;
    private $_user_ville;
    private $_user_date;
    private $_user_confirmAccount;
    private $_user_detailsConfirmed;
    private $_user_PIchecked;
    

    public function __construct(array $data) {

      $this->hydrate($data);
    }

    public function hydrate(array $data) {

        foreach ($data as $key => $value)
        {
          // On récupère le nom du setter correspondant à l'attribut.
          $reductedKey = substr($key, 11);
          $method = 'set' . ucfirst($reductedKey) . '__F__Users';
              
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
    public function get_user_id() {return $this->_user_id;}
    public function get_user_pseudo() {return $this->_user_pseudo;}
    public function get_user_uniqID() {return $this->_user_uniqID;}
    public function get_user_pass() {return $this->_user_pass;}
    public function get_user_mail() {return $this->_user_mail;}
    public function get_user_nom() {return $this->_user_nom;}
    public function get_user_prenom() {return $this->_user_prenom;}
    public function get_user_pays() {return $this->_user_pays;}
    public function get_user_numRue() {return $this->_user_numRue;}
    public function get_user_nomRue() {return $this->_user_nomRue;}
    public function get_user_codePostal() {return $this->_user_codePostal;}
    public function get_user_ville() {return $this->_user_ville;}
    public function get_user_date() {return $this->_user_date;}
    public function get_user_confirmAccount() {return $this->_user_confirmAccount;}
    public function get_user_detailsConfirmed() {return $this->_user_detailsConfirmed;}
    public function get_user_PIchecked() {return $this->_user_PIchecked;}
    
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
    public function setId__F__Users($id) {

        if (!is_int(intval($id))) {

            trigger_error('Le Champ ID doit être un nombre entier', E_USER_WARNING);
            return;
        } 

        $this->_billet_id = $id;
    }

    public function setPseudo__F__Users($pseudo) {

        if (!is_string($pseudo)) {

            trigger_error('Le Champ pseudo doit être une chaine de caractères', E_USER_WARNING);
            return;
        } 

        $this->_billet_pseudo = $pseudo;
    }

    public function setUniqID__F__Users($uniqID) {

        if (!is_string($uniqID)) {            

            trigger_error('Le Champ uniqID doit être une chaine de caractères', E_USER_WARNING);
            return;
        } 

        $this->_billet_uniqID = $uniqID;
    }   

    public function setPass__F__Users($pass) {

        if (!is_string($pass)) {

            trigger_error('Le Champ pass doit être une chaine de caractères', E_USER_WARNING);
            return;
        } 

        $this->_billet_pass = $pass;
    }

    public function setMail__F__Users($mail) {

        if (!is_string($mail)) {

            trigger_error('Le Champ mail doit être une chaine de caractères', E_USER_WARNING);
            return;
        } 

        $this->_billet_mail = $mail;
    }

    public function setNom__F__Users($nom) {

        if (!is_string($nom)) {

            trigger_error('Le Champ nom doit être une chaine de caractères', E_USER_WARNING);
            return;
        } 

        $this->_billet_nom = $nom;
    }

    
    public function setPrenom__F__Users($prenom) {
        
        if (!is_string($prenom)) {
            
            trigger_error('Le Champ prenom doit être une chaine de caractères', E_USER_WARNING);
            return;
        } 
        
        $this->_billet_prenom = $prenom;
    }

    public function setPays__F__Users($pays) {

        if (!is_string($pays)) {

            trigger_error('Le Champ pays doit être une chaine de caractères', E_USER_WARNING);
            return;
        } 

        $this->_billet_pays = $pays;
    }

    public function setNumRue__F__Users($numRue) {

        if (!is_string($numRue)) {            

            trigger_error('Le Champ numRue doit être une chaine de caractères', E_USER_WARNING);
            return;
        } 

        $this->_billet_numRue = $numRue;
    }

    public function setNomRue__F__Users($nomRue) {

        if (!is_string($nomRue)) {            

            trigger_error('Le Champ nomRue doit être une chaine de caractères', E_USER_WARNING);
            return;
        } 

        $this->_billet_nomRue = $nomRue;
    }   

    public function setCodePostal__F__Users($codePostal) {

        if (!is_string($codePostal)) {

            trigger_error('Le Champ codePostal doit être une chaine de caractères', E_USER_WARNING);
            return;
        } 

        $this->_billet_codePostal = $codePostal;
    }

    public function setVille__F__Users($ville) {

        if (!is_string($ville)) {

            trigger_error('Le Champ ville doit être une chaine de caractères', E_USER_WARNING);
            return;
        } 

        $this->_billet_ville = $ville;
    }

    
    public function setDate__F__Users($date) {

        if (!is_string($date)) {

            trigger_error('Le Champ date doit être une chaine de caractères', E_USER_WARNING);
            return;
        } 

        $this->_billet_date = $date;
    }

    public function setConfirmAccount__F__Users($confirmAccount) {

        if (!is_int(intval($confirmAccount))) {
            
            trigger_error('Le Champ confirmAccount doit être un nombre entier', E_USER_WARNING);
            return;
        } 

        $this->_billet_confirmAccount = $confirmAccount;
    }

    
    public function setDetailsConfirmed__F__Users($detailsConfirmed) {
        
        if (!is_int(intval($detailsConfirmed))) {
            
            trigger_error('Le Champ detailsConfirmed doit être un nombre entier', E_USER_WARNING);
            return;
        } 
        
        $this->_billet_detailsConfirmed = $detailsConfirmed;
    }

    public function setPIchecked__F__Users($PIchecked) {

        if (!is_int(intval($PIchecked))) {
            
            trigger_error('Le Champ PIchecked doit être un nombre entier', E_USER_WARNING);
            return;
        } 

        $this->_billet_PIchecked = $PIchecked;
    }
}
