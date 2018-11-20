<?php
$db = dbConnect();    

$O__BilletManager = new BilletManager($db);
$O__CommentManager = new CommentManager($db);


/*
██████╗ ███████╗ █████╗ ██████╗      █████╗ ██╗     ██╗              
██╔══██╗██╔════╝██╔══██╗██╔══██╗    ██╔══██╗██║     ██║              
██████╔╝█████╗  ███████║██║  ██║    ███████║██║     ██║              
██╔══██╗██╔══╝  ██╔══██║██║  ██║    ██╔══██║██║     ██║              
██║  ██║███████╗██║  ██║██████╔╝    ██║  ██║███████╗███████╗         
╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝╚═════╝     ╚═╝  ╚═╝╚══════╝╚══════╝
*/
if (!isset($_GET['f']) OR isset($_GET['f']) AND $_GET['f'] === 's') {

    $mode = 1;
    $getListBillets = $O__BilletManager->getListBillets__F__BilletManager($mode);

    //if ($getListBillets == true) {
        
        /*
    }
    elseif ($getListBillets == false) {

        $desc = "Erreur sur la réponse a la requete SQL de lecture des billets";
        $code = "101";
        $page = "OO__content__control.php";
        $ip = get_ip();
        $saveError = errorRegister($page, $desc, $code, $ip, $uniqueID, $pseudo, 0);    
                
        $notifyUser = "content__ErrorLoadingContent";
        header('Location: index.php?v=a&return=' . $notifyUser . '');
    }
    */
}
/*  
██████╗ ███████╗ █████╗ ██████╗     ███████╗██╗███╗   ██╗ ██████╗    
██╔══██╗██╔════╝██╔══██╗██╔══██╗    ██╔════╝██║████╗  ██║██╔════╝    
██████╔╝█████╗  ███████║██║  ██║    ███████╗██║██╔██╗ ██║██║  ███╗   
██╔══██╗██╔══╝  ██╔══██║██║  ██║    ╚════██║██║██║╚██╗██║██║   ██║   
██║  ██║███████╗██║  ██║██████╔╝    ███████║██║██║ ╚████║╚██████╔╝██╗
╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝╚═════╝     ╚══════╝╚═╝╚═╝  ╚═══╝ ╚═════╝ ╚═╝
*/
elseif (isset($_GET['f']) AND $_GET['f'] === 'r') {

    if (isset($_GET['r']) AND !empty($_GET['r'])) {

        $referenceBillet = htmlspecialchars($_GET['r']);

        $getBillet = $O__BilletManager->getBillet__F__BilletManager($referenceBillet);

        $content__countCommentsBillet = $O__CommentManager->getCountCommentsBillet__F__CommentManager($referenceBillet);

        $content__showCommentsBillet = $O__CommentManager->getListCommentsBillet__F__CommentManager($referenceBillet);

        //var_dump($getBillet);
        /*
        if ($getBillet == false) {

            //echo'Erreur sur la réponse a la requete SQL de lecture des billets';
            
            $desc = "Erreur sur la réponse a la requete SQL de lecture d'un billets";
            $code = "102";
            $page = "content__control.php";
            $ip = get_ip();
            $saveError = errorRegister($page, $desc, $code, $ip, $uniqueID, $pseudo, 0);    
                    
            $notifyUser = "content__ErrorLoadingContent";
            header('Location: index.php?v=a&return=' . $notifyUser . '');
        }
        */
    }
    else {        

        $notifyUser = "content__ErrorLoadingSingleBillet";
        header('Location: index.php?v=a&return=' . $notifyUser . '');
    }
}
/*
 ██████╗██████╗ ███████╗ █████╗ ████████╗███████╗                 
██╔════╝██╔══██╗██╔════╝██╔══██╗╚══██╔══╝██╔════╝                 
██║     ██████╔╝█████╗  ███████║   ██║   █████╗                   
██║     ██╔══██╗██╔══╝  ██╔══██║   ██║   ██╔══╝                   
╚██████╗██║  ██║███████╗██║  ██║   ██║   ███████╗                 
 ╚═════╝╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝   ╚═╝   ╚══════╝                 
                                                                  
 ██████╗ ██████╗ ███╗   ███╗███╗   ███╗███████╗███╗   ██╗████████╗
██╔════╝██╔═══██╗████╗ ████║████╗ ████║██╔════╝████╗  ██║╚══██╔══╝
██║     ██║   ██║██╔████╔██║██╔████╔██║█████╗  ██╔██╗ ██║   ██║   
██║     ██║   ██║██║╚██╔╝██║██║╚██╔╝██║██╔══╝  ██║╚██╗██║   ██║   
╚██████╗╚██████╔╝██║ ╚═╝ ██║██║ ╚═╝ ██║███████╗██║ ╚████║   ██║   
 ╚═════╝ ╚═════╝ ╚═╝     ╚═╝╚═╝     ╚═╝╚══════╝╚═╝  ╚═══╝   ╚═╝   
*/
elseif (isset($_GET['f']) AND $_GET['f'] === 'cc') {

    if (isset($_GET['r']) AND !empty($_GET['r'])) {

        $referenceBillet = htmlspecialchars($_GET['r']);

        if (isset($_POST['content__comment']) 
            AND !empty($_POST['content__comment'])) {
                
            $content__comment = htmlspecialchars($_POST['content__comment']);

            $content__comment__uniqID = 'comment-'.md5($referenceBillet . '-' . NOW);

            $content__addComment = $O__CommentManager->addComment__F__CommentManager($content__comment__uniqID, $referenceBillet, $content__comment);


            
            header('Location: index.php?v=a&f=r&r=' . $referenceBillet . '&return=' . $content__addComment . '');
        }
    }
}
/*
███████╗██╗ ██████╗ ███╗   ██╗ █████╗ ██╗                         
██╔════╝██║██╔════╝ ████╗  ██║██╔══██╗██║                         
███████╗██║██║  ███╗██╔██╗ ██║███████║██║                         
╚════██║██║██║   ██║██║╚██╗██║██╔══██║██║                         
███████║██║╚██████╔╝██║ ╚████║██║  ██║███████╗                    
╚══════╝╚═╝ ╚═════╝ ╚═╝  ╚═══╝╚═╝  ╚═╝╚══════╝

 ██████╗ ██████╗ ███╗   ███╗███╗   ███╗███████╗███╗   ██╗████████╗
██╔════╝██╔═══██╗████╗ ████║████╗ ████║██╔════╝████╗  ██║╚══██╔══╝
██║     ██║   ██║██╔████╔██║██╔████╔██║█████╗  ██╔██╗ ██║   ██║   
██║     ██║   ██║██║╚██╔╝██║██║╚██╔╝██║██╔══╝  ██║╚██╗██║   ██║   
╚██████╗╚██████╔╝██║ ╚═╝ ██║██║ ╚═╝ ██║███████╗██║ ╚████║   ██║   
 ╚═════╝ ╚═════╝ ╚═╝     ╚═╝╚═╝     ╚═╝╚══════╝╚═╝  ╚═══╝   ╚═╝   
*/
elseif (isset($_GET['f']) AND $_GET['f'] === 'si') {

    if (isset($_GET['r']) AND !empty($_GET['r']) AND isset($_GET['k']) AND !empty($_GET['k'])) {

        $referenceBillet = htmlspecialchars($_GET['k']);
        $referenceComment = htmlspecialchars($_GET['r']);

        $content__signalComment = $O__CommentManager->signalComment__F__CommentManager($referenceComment);

        if ($content__signalComment == true) {

            $notifyUser = "content__SignalingCommentOK";

            header('Location: index.php?v=a&f=r&r=' . $referenceBillet . '&return=' . $notifyUser . '');
            
        }
        else {

            //echo'Erreur sur la réponse a la requete SQL de lecture des billets';
            
            $desc = "Update du statut du commentaire impossible";
            $code = "301";
            $page = "OO__comment__control.php";
            $ip = get_ip();
            $saveError = errorRegister($page, $desc, $code, $ip, $uniqueID, $pseudo, 0);    
                    
            $notifyUser = "content__ErrorSignalingComment";
            header('Location: index.php?v=a&f=r&r=' . $referenceBillet . '&return=' . $notifyUser . '');
        }
            
        
    }
}
require 'view/frontEnd/OO__content__view.php';