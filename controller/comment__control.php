<?php
require('model/comment__model.php');

/*
███████╗██╗  ██╗ ██████╗ ██╗    ██╗
██╔════╝██║  ██║██╔═══██╗██║    ██║
███████╗███████║██║   ██║██║ █╗ ██║
╚════██║██╔══██║██║   ██║██║███╗██║
███████║██║  ██║╚██████╔╝╚███╔███╔╝
╚══════╝╚═╝  ╚═╝ ╚═════╝  ╚══╝╚══╝ 
*/
if (!isset($_GET['f']) OR isset($_GET['f']) AND $_GET['f'] === 'a') {

    $comment__showComments = comment__showComments();

    if ($comment__showComments == true)    
    {
        ob_start();
        
            while ($data = $comment__showComments->fetch())
            {
                echo"
                <div class='row'>
                    <header class='col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'>  
                    ";
                    if ($data['JF_comments_state'] == 0) {

                        echo"
                        <div class='row alert-info'>
                            <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                                <p>Le Commentaire est en attente de modération</p>
                            ";
                    }
                    elseif ($data['JF_comments_state'] == 1) {
                        
                        echo"
                        <div class='row alert-success'>
                            <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                                <p>Le Commentaire est validé</p>
                            ";
                    }
                    elseif ($data['JF_comments_state'] == 2) {
                        
                        echo"
                        <div class='row alert-danger'>
                            <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                                <p>Le Commentaire est refusé</p>
                            ";
                    }
                            echo"
                            </div>
                        </div>                                        
                        <div class='row'>
                            <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6 DC JC AIC'>
                                <h4>Par " . $data['JF_comments_author'] . "</h4>
                            </div>     
                            <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6 DC JC AIC'>
                                <h4>Publié le " . dateFrench($data['JF_comments_date'], 0) . "</h4>
                            </div> 
                        </div>                    
                    </header>
                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                    ";
                        if ($data['JF_comments_state'] == 0) {
                            echo"
                            <div class='row alert-info'>
                            ";
                        }
                        elseif ($data['JF_comments_state'] == 1) {
                            echo"
                            <div class='row alert-success'>
                            ";
                        }
                        elseif ($data['JF_comments_state'] == 2) {
                            echo"
                            <div class='row alert-danger'>
                            ";
                        }
                            echo"
                            <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 coreBillet'>
                                " . htmlspecialchars($data['JF_comments_comment']) . "
                            </div>
                        </div>
                        <aside class='row text-center'>
                            <div class='col-lg-4 col-md-4 col-sm-4 col-xs-12 marginB2_xs'>
                                <a href='index.php?v=a&f=r&r=" . $data['JF_comments_billet_uniqID'] . "' target='_blank' class='btn btn-info btn-block'>
                                    <i class='fas fa-eye'></i>
                                    Voir le Billet
                                </a>
                            </div>     
                            <div class='col-lg-4 col-md-4 col-sm-4 col-xs-12 marginB2_xs'>
                                <a href='index.php?v=c&f=a&a=d&r=" . $data['JF_comments_uniqID'] . "' class='btn btn-danger btn-block'>
                                    <i class='fas fa-times-circle'></i>
                                    Refuser le Commentaire
                                </a>
                            </div>     
                            <div class='col-lg-4 col-md-4 col-sm-4 col-xs-12'>
                                <a href='index.php?v=c&f=a&a=v&r=" . $data['JF_comments_uniqID'] . "' class='btn btn-success btn-block'>
                                    <i class='fas fa-check-circle'></i>
                                    Publier le Commentaire
                                </a>
                            </div>
                        </aside>     
                    </div>
                </div>
                ";
            }
            $comment__showComments->CloseCursor();  
        
        $comment__showComments = ob_get_clean();   
        
    }
    else
    {
        //echo'Erreur sur la réponse a la requete SQL de lecture des billets';
        
        $desc = "Erreur sur la réponse a la requete SQL de lecture des commentaires";
        $code = "101";
        $page = "comment__control.php";
        $ip = get_ip();
        $saveError = errorRegister($page, $desc, $code, $ip, $uniqueID, $pseudo, 0);    
                
        $notifyUser = "comment__ErrorLoadingContent";
        header('Location: index.php?v=a&return=' . $notifyUser . '');
    }
}
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

        $comment__denyComment = comment__denyComment($referenceComment);

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

        $comment__validComment = comment__validComment($referenceComment);

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

require('view/backEnd/comment__view.php');