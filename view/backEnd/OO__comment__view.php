<?php

if (!isset($_GET['f']) OR isset($_GET['f']) AND $_GET['f'] === 'a') {
    echo'
        <section id="comment__listComments" class="standardBlock paddingB2 container allBillets">
    ';
    foreach ($getListComments as $O__Comment) {
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
        <div class='row'>
            <header class='col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'>  
            ";
            if ($O__Comment_state == 0) {

                echo"
                <div class='row alert-info'>
                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <p>Le Commentaire est en attente de modération</p>
                    ";
            }
            elseif ($O__Comment_state == 1) {
                
                echo"
                <div class='row alert-success'>
                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <p>Le Commentaire est validé</p>
                    ";
            }
            elseif ($O__Comment_state == 2) {
                
                echo"
                <div class='row alert-danger'>
                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <p>Le Commentaire est refusé</p>
                    ";
            }
            elseif ($O__Comment_state == 3) {
                
                echo"
                <div class='row alert-warning'>
                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <p>Le Commentaire est signalé</p>
                    ";
            }
                    echo"
                    </div>
                </div>                                        
                <div class='row'>
                    <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6 DC JC AIC'>
                        <h4>Par " . $O__Comment_author . "</h4>
                    </div>     
                    <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6 DC JC AIC'>
                        <h4>Publié le " . dateFrench($O__Comment_date, 0) . "</h4>
                    </div> 
                </div>                    
            </header>
            <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
            ";
                if ($O__Comment_state == 0) {
                    echo"
                    <div class='row alert-info'>
                    ";
                }
                elseif ($O__Comment_state == 1) {
                    echo"
                    <div class='row alert-success'>
                    ";
                }
                elseif ($O__Comment_state == 2) {
                    echo"
                    <div class='row alert-danger'>
                    ";
                }
                elseif ($O__Comment_state == 3) {
                    echo"
                    <div class='row alert-warning'>
                    ";
                }
                    echo"
                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 coreBillet'>
                        " . htmlspecialchars($O__Comment_comment) . "
                    </div>
                </div>
                <aside class='row text-center'>
                    <div class='col-lg-4 col-md-4 col-sm-4 col-xs-12 marginB2_xs'>
                        <a href='index.php?v=a&f=r&r=" . $O__Comment_billet_uniqID . "' target='_blank' class='btn btn-info btn-block'>
                            <i class='fas fa-eye'></i>
                            Voir le Billet
                        </a>
                    </div>     
                    <div class='col-lg-4 col-md-4 col-sm-4 col-xs-12 marginB2_xs'>
                        <a href='index.php?v=c&f=a&a=d&r=" . $O__Comment_uniqID . "' class='btn btn-danger btn-block'>
                            <i class='fas fa-times-circle'></i>
                            Refuser le Commentaire
                        </a>
                    </div>     
                    <div class='col-lg-4 col-md-4 col-sm-4 col-xs-12'>
                        <a href='index.php?v=c&f=a&a=v&r=" . $O__Comment_uniqID . "' class='btn btn-success btn-block'>
                            <i class='fas fa-check-circle'></i>
                            Publier le Commentaire
                        </a>
                    </div>
                </aside>     
            </div>
        </div>
        ";
    }
    echo'
        </section>
    ';
}