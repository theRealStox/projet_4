<?php
$db = dbConnect();    

$O__CommentManager = new CommentManager($db);

$getCountComments = $O__CommentManager->getCountComments__F__CommentManager();

$getListComments = $O__CommentManager->getListComments__F__CommentManager();

/*
██████╗ ███████╗███╗   ██╗██╗   ██╗
██╔══██╗██╔════╝████╗  ██║╚██╗ ██╔╝
██║  ██║█████╗  ██╔██╗ ██║ ╚████╔╝ 
██║  ██║██╔══╝  ██║╚██╗██║  ╚██╔╝  
██████╔╝███████╗██║ ╚████║   ██║   
╚═════╝ ╚══════╝╚═╝  ╚═══╝   ╚═╝  
*/
if (isset($_GET['a']) AND $_GET['a'] === 'd') {

    if (isset($_GET['r']) AND !empty($_GET['r'])) {

        $referenceComment = htmlspecialchars($_GET['r']);

        $comment__denyComment = $O__CommentManager->denyComment__F__CommentManager($referenceComment);

        if ($comment__denyComment == true) {

            $notifyUser = "comment__DenyingContentOK";
            header('Location: index.php?v=c&f=a&return=' . $notifyUser . '');       
            
        }
        else {

            //echo'Erreur sur la réponse a la requete SQL de lecture des billets';
            
            $desc = "Update du statut du commentaire impossible";
            $code = "302";
            $page = "comment__control.php";
            $ip = get_ip();
            $saveError = errorRegister($page, $desc, $code, $ip, $uniqueID, $pseudo, 0);    
                    
            $notifyUser = "comment__ErrorDenyingContent";
            header('Location: index.php?v=c&f=a&return=' . $notifyUser . '');
        }
    }
    else {        

        $desc = "Erreur : pas d'indication de référence commentaire, !isset(_GET['r']) ou empty(_GET['r'])";
        $code = "102";
        $page = "comment__control.php";
        $ip = get_ip();
        $saveError = errorRegister($page, $desc, $code, $ip, $uniqueID, $pseudo, 0);

        $notifyUser = "comment__ErrorLoadingSingleComment";
        header('Location: index.php?v=a&return=' . $notifyUser . '');
    }
}
/*
██╗   ██╗ █████╗ ██╗     ██╗██████╗ 
██║   ██║██╔══██╗██║     ██║██╔══██╗
██║   ██║███████║██║     ██║██║  ██║
╚██╗ ██╔╝██╔══██║██║     ██║██║  ██║
 ╚████╔╝ ██║  ██║███████╗██║██████╔╝
  ╚═══╝  ╚═╝  ╚═╝╚══════╝╚═╝╚═════╝ 
*/
if (isset($_GET['a']) AND $_GET['a'] === 'v') {

    if (isset($_GET['r']) AND !empty($_GET['r'])) {

        $referenceComment = htmlspecialchars($_GET['r']);

        $comment__validComment = $O__CommentManager->validComment__F__CommentManager($referenceComment);

        if ($comment__validComment == true) {

            $notifyUser = "comment__validatingContentOK";
            header('Location: index.php?v=c&f=a&return=' . $notifyUser . '');       
            
        }
        else {

            //echo'Erreur sur la réponse a la requete SQL de lecture des billets';
            
            $desc = "Update du statut du commentaire impossible";
            $code = "301";
            $page = "comment__control.php";
            $ip = get_ip();
            $saveError = errorRegister($page, $desc, $code, $ip, $uniqueID, $pseudo, 0);    
                    
            $notifyUser = "comment__ErrorvalidatingContent";
            header('Location: index.php?v=c&f=a&return=' . $notifyUser . '');
        }
    }
    else {        

        $desc = "Erreur : pas d'indication de référence commentaire, !isset(_GET['r']) ou empty(_GET['r'])";
        $code = "102";
        $page = "comment__control.php";
        $ip = get_ip();
        $saveError = errorRegister($page, $desc, $code, $ip, $uniqueID, $pseudo, 0);

        $notifyUser = "comment__ErrorLoadingSingleComment";
        header('Location: index.php?v=a&return=' . $notifyUser . '');
    }
}

require 'view/backEnd/OO__comment__view.php';