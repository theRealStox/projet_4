<?php
$db = dbConnect();

$O__UsersManager = new UsersManager($db);

/*
██████╗ ██████╗ ███╗   ██╗███╗   ██╗███████╗██╗  ██╗██╗ ██████╗ ███╗   ██╗
██╔════╝██╔═══██╗████╗  ██║████╗  ██║██╔════╝╚██╗██╔╝██║██╔═══██╗████╗  ██║
██║     ██║   ██║██╔██╗ ██║██╔██╗ ██║█████╗   ╚███╔╝ ██║██║   ██║██╔██╗ ██║
██║     ██║   ██║██║╚██╗██║██║╚██╗██║██╔══╝   ██╔██╗ ██║██║   ██║██║╚██╗██║
╚██████╗╚██████╔╝██║ ╚████║██║ ╚████║███████╗██╔╝ ██╗██║╚██████╔╝██║ ╚████║
╚═════╝ ╚═════╝ ╚═╝  ╚═══╝╚═╝  ╚═══╝╚══════╝╚═╝  ╚═╝╚═╝ ╚═════╝ ╚═╝  ╚═══╝
*/
if ($_GET['f'] === 'c') {
    
    $title = 'Connexion';
    
    if (USER_IS_CO === 1) {
        
        $notifyUser = "userAlreadyCo";
        header('Location: index.php?return=' . $notifyUser . '');
    }
    else {

        if (isset($_POST['pseudo']))
        {
            if (empty($_POST['pseudo']) || empty($_POST['password']) )
            {
                $notifyUser = "user__ErrorCo__MissingInput";
                header('Location: index.php?v=u&f=c&return=' . $notifyUser . '');
            }
            else {

                $pseudoPost = htmlspecialchars($_POST['pseudo']);

                $getUserLogs = $O__UsersManager->getUserLogs__F__UsersManager($pseudoPost);

                while ($data = $getUserLogs->fetch())
                {
                    if ($data['JF_user_pass'] == hash('sha512', $_POST['password']) AND $data['JF_user_confirmAccount'] == 1)
                    {
                        $_SESSION['pseudo'] = $data['JF_user_pseudo'];
                        $_SESSION['uniqID'] = $data['JF_user_uniqID'];

                        $getUserRole = $O__UsersManager->getUserRole__F__UsersManager($_SESSION['pseudo']);

                        if ($getUserRole == 1) {

                            $_SESSION['role'] = 'admin';
                        }
                        $notifyUser = "USER_CO_SET";
                        header('Location: index.php?return=' . $notifyUser . '');
                    }
                    else {

                        $desc = "Echec CONNEXION MDP INCORRECT";
                        $code = "101";
                        $page = "connexion.php";
                        $ip = get_ip();
                        $saveError = errorRegister($page, $desc, $code, $ip, $data['JF_user_uniqID'], $data['JF_user_pseudo'], 0);

                        $notifyUser = "user__ErrorCo__invalidLogAttempt";
                        header('Location: index.php?v=u&f=c&return=' . $notifyUser . '');
            
                    }
                }
                $rep->CloseCursor();   
            }
        }
    }
    
}
/*
██████╗██████╗ ███████╗ █████╗ ████████╗███████╗
██╔════╝██╔══██╗██╔════╝██╔══██╗╚══██╔══╝██╔════╝
██║     ██████╔╝█████╗  ███████║   ██║   █████╗  
██║     ██╔══██╗██╔══╝  ██╔══██║   ██║   ██╔══╝  
╚██████╗██║  ██║███████╗██║  ██║   ██║   ███████╗
╚═════╝╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝   ╚═╝   ╚══════╝
*/
elseif ($_GET['f'] === 'i') {
    
    $title = 'Inscription';
    
}
elseif ($_GET['f'] === 'iv') {

    if (isset($_POST['pseudo'])
        AND isset($_POST['MDP'])
        AND isset($_POST['confirm'])
        AND isset($_POST['email'])
        ) 
    {
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $mdp = htmlspecialchars($_POST['MDP']);
        $confirm = htmlspecialchars($_POST['confirm']);
        $email = htmlspecialchars($_POST['email']);

        $mdp_hash = hash('sha512', $mdp);
        $confirm_hash = hash('sha512', $confirm);
        
        $i = 0;	

        $pseudo_free = $O__UsersManager->newUserVerif__pseudo__F__UsersManager($pseudo);
        $mail_free = $O__UsersManager->newUserVerif__email__F__UsersManager($email);

        if(!$pseudo_free) {

            $notifyUser = "user__ErrorReg__invalidAttempt_idTaken";
            $i++;
        }

        if (strlen($pseudo) < 3 || strlen($pseudo) > 50) {

            $notifyUser = "user__ErrorReg__invalidAttempt_idWrongSize";
            $i++;
        }

        if ($mdp_hash != $confirm_hash || empty($confirm_hash) || empty($mdp_hash)) {

            $notifyUser = "user__ErrorReg__invalidAttempt_passNoMatch";
            $i++;
        }

        if(!$mail_free) {            

            $notifyUser = "user__ErrorReg__invalidAttempt_mailTaken";
            $i++;
        }

        if (!preg_match("#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$#", $email) || empty($email)) {

            $notifyUser = "user__ErrorReg__invalidAttempt_mailWrongForm";
            $i++;
        }

        if ($i === 0) {

            //require('inscriptionInsert.php');
            $uniqueID = 'user-'.md5($pseudo . '-' . NOW);

            $addUser = $O__UsersManager->newUserInsert__F__UsersManager($pseudo, $uniqueID, $mdp_hash, $email);

            if ($addUser == true) 
            {
                /*
                $mailTo = emailTypeCarrousel('NEWUSER', $email, $uniqueID, '0');
                */
                $notifyUser = "user__successReg";
                header('Location: index.php?v=u&f=c&return=' . $notifyUser . '');

            }
            else
            {

                $desc = "Echec INSERT INTO";
                $code = "201";
                $page = "inscription_insert.php";
                $ip = get_ip();
                $saveError = errorRegister($page, $desc, $code, $ip, $uniqueID, $pseudo, 0);    

                $notifyUser = "tech__errorReg";
                header('Location: index.php?v=u&f=i&return=' . $notifyUser . '');
            }

        }
        else {    	

        
            if ($i === 1) {

                header('Location: index.php?v=u&f=i&return=' . $notifyUser . '');
            }
            elseif ($i > 1) {

                $notifyUser = "user__ErrorReg__invalidAttempt_multipleError";
                header('Location: index.php?v=u&f=i&return=' . $notifyUser . '');
            }
        }
            
    } else {	


        $notifyUser = "user__ErrorReg__MissingInput";
        header('Location: index.php?v=u&f=c&return=' . $notifyUser . '');
    }        
}
/*
███████╗███████╗███████╗███████╗       ██████╗ ███████╗███████╗████████╗
██╔════╝██╔════╝██╔════╝██╔════╝       ██╔══██╗██╔════╝██╔════╝╚══██╔══╝
███████╗█████╗  ███████╗███████╗       ██║  ██║█████╗  ███████╗   ██║   
╚════██║██╔══╝  ╚════██║╚════██║       ██║  ██║██╔══╝  ╚════██║   ██║   
███████║███████╗███████║███████║██╗    ██████╔╝███████╗███████║   ██║   
╚══════╝╚══════╝╚══════╝╚══════╝╚═╝    ╚═════╝ ╚══════╝╚══════╝   ╚═╝   
*/
elseif ($_GET['f'] === 'd') {
    
    //require('view/body/user/sessionDestroy.php');
    $sessionDestroy = $O__UsersManager->sessionDestroy__F__UsersManager();
}
require 'view/frontEnd/OO__users__view.php';