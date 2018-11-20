<?php
/*
██████╗ ███████╗ █████╗ ██████╗      █████╗ ██╗     ██╗              
██╔══██╗██╔════╝██╔══██╗██╔══██╗    ██╔══██╗██║     ██║              
██████╔╝█████╗  ███████║██║  ██║    ███████║██║     ██║              
██╔══██╗██╔══╝  ██╔══██║██║  ██║    ██╔══██║██║     ██║              
██║  ██║███████╗██║  ██║██████╔╝    ██║  ██║███████╗███████╗         
╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝╚═════╝     ╚═╝  ╚═╝╚══════╝╚══════╝
*/
if (!isset($_GET['f']) OR isset($_GET['f']) AND $_GET['f'] === 's') {
    echo'
    <section id="content__listBillets" class="standardBlock paddingB2 container allBillets">
    ';
    foreach ($getListBillets as $O__Billet) {
            
        $O__Billet_id = $O__Billet->get_billet_id();
        $O__Billet_uniqID = $O__Billet->get_billet_uniqID();
        $O__Billet_author = $O__Billet->get_billet_author();
        $O__Billet_title = $O__Billet->get_billet_title();
        $O__Billet_content = $O__Billet->get_billet_content();
        $O__Billet_date = $O__Billet->get_billet_date();
        $O__Billet_state = $O__Billet->get_billet_state();
        $O__Billet_lastUpdate = $O__Billet->get_billet_lastUpdate();

        echo"
        <div class='row'>
            <header class='col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'>
                <div class='row'>
                    <div class='col-lg-offset-9 col-md-offset-9 col-sm-offset-6 col-lg-3 col-md-3 col-sm-6 col-xs-12'>
                        <a href='index.php?v=a&f=r&r=" . $O__Billet_uniqID . "' class='btn btn-info'>
                            <i class='fas fa-eye'></i>
                            Lire le Billet en intégralité
                        </a>
                    </div>     
                </div>
                <div class='row'>
                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <h3>" . $O__Billet_title . "</h3>
                    </div>     
                </div>
                <div class='row'>
                    <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6 DC JC AIC'>
                        <h4>Par " . $O__Billet_author . ", publié le " . dateFrench($O__Billet_date, 1) . "</h4>
                    </div>     
                    <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6 DC JC AIC'>
                        <div>Dernière mise à jour le " . dateFrench($O__Billet_lastUpdate, 0) . "</div>
                    </div> 
                </div>                    
            </header>
            <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                <div class='row'>
                    <div class='coreBillet'>
                        " . cutText(html_entity_decode($O__Billet_content)) . "
                    </div>
                </div>
            </div>
        </div>
        ";
    }   
    echo'
    </section>
    ';
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

        echo'
        <section id="content__listBillets" class="standardBlock paddingB2 container">
        ';
        
            $O__Billet_id = $getBillet->get_billet_id();
            $O__Billet_uniqID = $getBillet->get_billet_uniqID();
            $O__Billet_author = $getBillet->get_billet_author();
            $O__Billet_title = $getBillet->get_billet_title();
            $O__Billet_content = $getBillet->get_billet_content();
            $O__Billet_date = $getBillet->get_billet_date();
            $O__Billet_state = $getBillet->get_billet_state();
            $O__Billet_lastUpdate = $getBillet->get_billet_lastUpdate();
            echo"
            <div class='row'>
                <header class='col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'>
                    <div class='row'>
                        <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                            <h3>" . $O__Billet_title . "</h3>
                        </div>     
                    </div>
                    <div class='row'>
                        <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6 DC JC AIC'>
                            <h4>Par " . $O__Billet_author . ", publié le " . dateFrench($O__Billet_date, 1) . "</h4>
                        </div>     
                        <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6 DC JC AIC'>
                            <div>Dernière mise à jour le " . dateFrench($O__Billet_lastUpdate, 0) . "</div>
                        </div> 
                    </div>                    
                </header>
                <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                    <div class='row'>
                        <div class='coreBillet'>
                            " . html_entity_decode($O__Billet_content) . "
                        </div>
                    </div>
                </div>                        
            </div>
            ";
       
        echo'
        </section>
        ';
    
        echo'
        <section id="content__listComments" class="paddingB2 container">
        ';
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

                foreach ($content__showCommentsBillet as $O__Comment) {
                    //echo $O__Comment->get_comment_uniqID() . '<br />';
                    $O__Comment_id = $O__Comment->get_comment_id();
                    $O__Comment_uniqID = $O__Comment->get_comment_uniqID();
                    $O__Comment_billet_uniqID = $O__Comment->get_comment_billet_uniqID();
                    $O__Comment_author = $O__Comment->get_comment_author();
                    $O__Comment_author_uniqID = $O__Comment->get_comment_author_uniqID();
                    $O__Comment_date = $O__Comment->get_comment_date();
                    $O__Comment_comment = $O__Comment->get_comment_comment();
                    $O__Comment_state = $O__Comment->get_comment_state();
                    echo"
                    <div class='row content__showComment__container'>
                        <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'>
                            <div class='row'>
                                <div class='col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-lg-10 col-md-10 col-sm-10 col-xs-12 alert-info'>
                                    <div class=''>
                                        <header class='row'>
                                            <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12>
                                                <div class='row'>
                                                    <div class='col-lg-5 col-md-5 col-sm-5 col-xs-5'>
                                                        <p>
                                                            Par " . htmlspecialchars($O__Comment_author) . "<br />
                                                        </p>
                                                    </div>
                                                    <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6'>
                                                        <p>
                                                            Le " . dateFrench($O__Comment_date, 0) . "
                                                        </p>
                                                    </div>
                                                    <div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'>
                                                        <div class='divButton'>
                                                            <a class='btn btn-warning btn-block DR JC AIC' href='index.php?v=a&f=si&k=" . $referenceBillet . "&r=" . $O__Comment_uniqID . "' alt='Signaler'>
                                                                <i class='fas fa-bell'></i>
                                                            </a>
                                                        </div>
                                                    </div>                                                    
                                                </div>
                                            </div>
                                        </header>
                                        <section class='row'>
                                            <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                                                <p>
                                                    " . htmlspecialchars($O__Comment_comment) . "
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
        echo'
        </section>
        ';
    
        echo'
        <section id="content__createComments" class="paddingB2 container">
        ';
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
        echo'
        </section>
        ';
    }
    
}