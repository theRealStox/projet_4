<?php
require('model/content__model.php');

/*
██████╗ ███████╗ █████╗ ██████╗      █████╗ ██╗     ██╗              
██╔══██╗██╔════╝██╔══██╗██╔══██╗    ██╔══██╗██║     ██║              
██████╔╝█████╗  ███████║██║  ██║    ███████║██║     ██║              
██╔══██╗██╔══╝  ██╔══██║██║  ██║    ██╔══██║██║     ██║              
██║  ██║███████╗██║  ██║██████╔╝    ██║  ██║███████╗███████╗         
╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝╚═════╝     ╚═╝  ╚═╝╚══════╝╚══════╝
*/
if (!isset($_GET['f']) OR isset($_GET['f']) AND $_GET['f'] === 's') {

    $listBillets = content__showBillets();

    if ($listBillets == true)    
    {
        ob_start();
        
        while ($data = $listBillets->fetch())
        {
            echo"
            <div class='row'>
                <header class='col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'>
                    <div class='row'>
                        <div class='col-lg-offset-9 col-md-offset-9 col-sm-offset-6 col-lg-3 col-md-3 col-sm-6 col-xs-12'>
                            <a href='index.php?v=a&f=r&r=" . $data['JF_billets_uniqID'] . "' class='btn btn-info'>
                                <i class='fas fa-eye'></i>
                                Lire le Billet en intégralité
                            </a>
                        </div>     
                    </div>
                    <div class='row'>
                        <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                            <h3>" . $data['JF_billets_title'] . "</h3>
                        </div>     
                    </div>
                    <div class='row'>
                        <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6 DC JC AIC'>
                            <h4>Par " . $data['JF_billets_author'] . ", publié le " . dateFrench($data['JF_billets_date'], 1) . "</h4>
                        </div>     
                        <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6 DC JC AIC'>
                            <div>Dernière mise à jour le " . dateFrench($data['JF_billets_lastUpdate'], 0) . "</div>
                        </div> 
                    </div>                    
                </header>
                <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                    <div class='row'>
                        <div class='coreBillet'>
                            " . html_entity_decode($data['JF_billets_content']) . "
                        </div>
                    </div>
                </div>
            </div>
            ";
        }
        $listBillets->CloseCursor();  
        
        $listBillets = ob_get_clean();   
        
    }
    else
    {
        //echo'Erreur sur la réponse a la requete SQL de lecture des billets';
        
        $desc = "Erreur sur la réponse a la requete SQL de lecture des billets";
        $code = "101";
        $page = "content__control.php";
        $ip = get_ip();
        $saveError = errorRegister($page, $desc, $code, $ip, $uniqueID, $pseudo, 0);    
                
        $notifyUser = "content__ErrorLoadingContent";
        header('Location: index.php?v=a&return=' . $notifyUser . '');
    }
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

        $content__showDetailsBillet = content__showDetailsBillet($referenceBillet);

        $content__countCommentsBillet = content__countCommentsBillet($referenceBillet);

        $content__showCommentsBillet = content__showCommentsBillet($referenceBillet);

        ob_start();

            if ($content__countCommentsBillet == 0) {

                echo"
                <div class='row'>
                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'>
                        <div class='row'>
                            <div class='col-lg-offset-3 col-md-offset-3 col-sm-offset-3 col-lg-6 col-md-6 col-sm-6 col-xs-12'>
                                <div class='jumbotron alert-info'>
                                    <p>
                                        Aucun avis sur ce billet, donnez le votre !
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                ";
            }
            else {

                if ($content__showCommentsBillet == true) {

                    while ($data = $content__showCommentsBillet->fetch())
                    {
                        echo"
                        <div class='row content__showComment__container'>
                            <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'>
                                <div class='row'>
                                    <div class='col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-lg-10 col-md-10 col-sm-10 col-xs-12 alert-info'>
                                        <div class=''>
                                            <header class='row'>
                                                <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12>
                                                    <div class='row'>
                                                        <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6'>
                                                            <p>
                                                                Par " . htmlspecialchars($data['JF_comments_author']) . "<br />
                                                            </p>
                                                        </div>
                                                        <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6'>
                                                            <p>
                                                                Le " . dateFrench($data['JF_comments_date'], 0) . "
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </header>
                                            <section class='row'>
                                                <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                                                    <p>
                                                        " . htmlspecialchars($data['JF_comments_comment']) . "
                                                    </p>
                                                </div>
                                            </section>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        ";
                    }
                }
            }            

        $content__showCommentsBillet = ob_get_clean();   

        ob_start();

            if (USER_IS_CO === 1) {                
            
                echo"
                <form method='POST' action='index.php?v=a&f=cc&r=" . $referenceBillet . "'>
                    <div class='row'>
                        <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'>
                            <div class='row'>
                                <div class='col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-lg-8 col-md-8 col-sm-8 col-xs-12 form-group'>
                                    <textarea class='form-control alert-success' placeholder='Votre Commentaire' name='content__comment'></textarea>
                                </div>
                                <div class='col-lg-2 col-md-2 col-sm-2 col-xs-12 form-group content__createComments__submitContainer'>
                                    <input class='form-control btn btn-success' type='submit' value='Envoyer' />
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                ";
            } 
            else {
                echo"
                <div class='row'>
                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'>
                        <div class='row'>
                            <div class='col-lg-offset-3 col-md-offset-3 col-sm-offset-3 col-lg-6 col-md-6 col-sm-6 col-xs-12'>
                                <div class='jumbotron alert-warning'>
                                    <p>
                                        Vous devez être connecté pour pouvoir commenter.
                                    </p>
                                    <p>
                                        <a class='btn btn-success' href='index.php?v=u&f=c'>Connexion</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                ";
            }

        $content__showInputCommentBillet = ob_get_clean();   


        if ($content__showDetailsBillet == true) {

            ob_start();
            
                while ($data = $content__showDetailsBillet->fetch())
                {
                    echo"
                    <div class='row'>
                        <header class='col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'>
                            <div class='row'>
                                <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                                    <h3>" . $data['JF_billets_title'] . "</h3>
                                </div>     
                            </div>
                            <div class='row'>
                                <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6 DC JC AIC'>
                                    <h4>Par " . $data['JF_billets_author'] . ", publié le " . dateFrench($data['JF_billets_date'], 1) . "</h4>
                                </div>     
                                <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6 DC JC AIC'>
                                    <div>Dernière mise à jour le " . dateFrench($data['JF_billets_lastUpdate'], 0) . "</div>
                                </div> 
                            </div>                    
                        </header>
                        <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                            <div class='row'>
                                <div class='coreBillet'>
                                    " . html_entity_decode($data['JF_billets_content']) . "
                                </div>
                            </div>
                        </div>                        
                    </div>
                    ";
                }
                $content__showDetailsBillet->CloseCursor();  
            
            $content__showDetailsBillet = ob_get_clean();               
            
        }
        else {

            //echo'Erreur sur la réponse a la requete SQL de lecture des billets';
            
            $desc = "Erreur sur la réponse a la requete SQL de lecture d'un billets";
            $code = "102";
            $page = "content__control.php";
            $ip = get_ip();
            $saveError = errorRegister($page, $desc, $code, $ip, $uniqueID, $pseudo, 0);    
                    
            $notifyUser = "content__ErrorLoadingContent";
            header('Location: index.php?v=a&return=' . $notifyUser . '');
        }
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

            $content__addComment = content__addComment($content__comment__uniqID, $referenceBillet, $content__comment);
            
            header('Location: index.php?v=a&f=r&r=' . $referenceBillet . '&return=' . $content__addComment . '');
        }
    }
}

require('view/frontEnd/content__view.php');