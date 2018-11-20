<?php
/*
 ██████╗ ██████╗ ██╗   ██╗███╗   ██╗████████╗
██╔════╝██╔═══██╗██║   ██║████╗  ██║╚══██╔══╝
██║     ██║   ██║██║   ██║██╔██╗ ██║   ██║   
██║     ██║   ██║██║   ██║██║╚██╗██║   ██║   
╚██████╗╚██████╔╝╚██████╔╝██║ ╚████║   ██║   
 ╚═════╝ ╚═════╝  ╚═════╝ ╚═╝  ╚═══╝   ╚═╝   
*/
echo'
<section class="coreBlock container">
    <header class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 marginBlock">
            <div class="row jumbotron text-center">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 marginB2_xs">
                    <span class="btn btn-primary btn-block">' . $getCountBillets . ' billets enregistrés</span>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 marginB2_xs">
                    <span class="btn btn-info btn-block">' . $getCountBilletsP . ' billets publiés</span>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <a class="btn btn-success btn-block" href="index.php?v=b&amp;f=a&amp;a=cf">Créer un Billet</a>
                </div>
            </div>
        </div>
    </header>
</section>
';
/*
██████╗ ███████╗ █████╗ ██████╗ 
██╔══██╗██╔════╝██╔══██╗██╔══██╗
██████╔╝█████╗  ███████║██║  ██║
██╔══██╗██╔══╝  ██╔══██║██║  ██║
██║  ██║███████╗██║  ██║██████╔╝
╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝╚═════╝ 
*/
if (!isset($_GET['a']) OR isset($_GET['a']) AND $_GET['a'] === 's') {
    echo'
        <section id="listBillets" class="coreBlock paddingB2 container">
    ';
    foreach ($getListBillets as $O__Billet) {
        //echo $O__Comment->get_comment_uniqID() . '<br />';
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
                    <div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 DC JC AIC height40px marginB2_xs'>
                        <div>Dernière mise à jour le " . dateFrench($O__Billet_lastUpdate, 0) . "</div>
                    </div>
                    <div class='col-lg-2 col-md-2 col-sm-2 col-xs-4 DR JC AIC'>
                        ";
                        if ($O__Billet_state == 1) {
                            echo'
                            <div class="divButton btn btn-success">                             
                                <a class="" href="index.php?v=b&amp;f=a&amp;a=s&amp;k=0&amp;r=' . $O__Billet_uniqID . '">                            
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                            ';
                        }
                        elseif ($O__Billet_state == 0) {
                            echo'
                            <div class="divButton btn btn-warning">
                                <a class="" href="index.php?v=b&amp;f=a&amp;a=s&amp;k=1&amp;r=' . $O__Billet_uniqID . '">                            
                                    <i class="fas fa-eye-slash"></i>
                                </a>
                            </div>
                            ';
                        }
                        echo"
                    </div>
                    <div class='col-lg-2 col-md-2 col-sm-2 col-xs-4 DR JC AIC'>
                        <div class='divButton btn btn-info'>
                            <a class='' href='index.php?v=b&amp;f=a&amp;a=up&amp;r=" . $O__Billet_uniqID . "'>
                                <i class='fas fa-edit'></i>
                            </a>
                        </div>
                    </div>
                    <div class='col-lg-2 col-md-2 col-sm-2 col-xs-4 DR JC AIC'>
                        <div class='divButton btn btn-danger'>
                            <a class='' href='index.php?v=b&amp;f=a&amp;a=d&amp;r=" . $O__Billet_uniqID . "'>                            
                                <i class='fas fa-trash'></i>
                            </a>
                        </div>
                    </div>
                </div>
            </header>
            <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                <div class='row'>
                    <h3>" . $O__Billet_title . "</h3>
                    <h4>Par " . $O__Billet_author . " publié le " . dateFrench($O__Billet_date, 1) . "</h4>
                    <div class='coreBillet'>" . html_entity_decode($O__Billet_content) . "</div>
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
 ██████╗██████╗ ███████╗ █████╗ ████████╗███████╗
██╔════╝██╔══██╗██╔════╝██╔══██╗╚══██╔══╝██╔════╝
██║     ██████╔╝█████╗  ███████║   ██║   █████╗  
██║     ██╔══██╗██╔══╝  ██╔══██║   ██║   ██╔══╝  
╚██████╗██║  ██║███████╗██║  ██║   ██║   ███████╗
 ╚═════╝╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝   ╚═╝   ╚══════╝
*/
elseif (isset($_GET['a']) AND $_GET['a'] === 'cf') {
    echo'
    <section class="standardBlock paddingBlock container dev2">
        <form method="POST" action="index.php?v=b&amp;f=a&amp;a=cv" class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                <input type="text" name="titleNewBillet" class="form-control" placeholder="Titre du billet"/>
            </div>    
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                <textarea type="text" name="coreNewBillet" class="form-control editme" placeholder="Corps du billet"></textarea>
            </div>   
            <div class="col-lg-offset-5 col-md-offset-5 col-sm-offset-5 col-xs-offset-5 col-lg-2 col-md-2 col-sm-2 col-xs-2 form-group">
                <input type="submit" value="Publier" class="form-control btn btn-success"/>
            </div>       
        </form>
    </section>
    ';
}
/*
██╗   ██╗██████╗ ██████╗  █████╗ ████████╗███████╗
██║   ██║██╔══██╗██╔══██╗██╔══██╗╚══██╔══╝██╔════╝
██║   ██║██████╔╝██║  ██║███████║   ██║   █████╗  
██║   ██║██╔═══╝ ██║  ██║██╔══██║   ██║   ██╔══╝  
╚██████╔╝██║     ██████╔╝██║  ██║   ██║   ███████╗
 ╚═════╝ ╚═╝     ╚═════╝ ╚═╝  ╚═╝   ╚═╝   ╚══════╝
*/
elseif (isset($_GET['a']) AND $_GET['a'] === 'up' AND !isset($_GET['m'])) {

    echo'
    <section id="listBillets" class="standardBlock paddingB2 container">
        ' . $catchUpdateBillets . '
    </section>
    ';       
}