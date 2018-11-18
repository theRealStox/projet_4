<?php

echo'
<section class="coreBlock container">
    <header class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 marginBlock">
            <div class="row jumbotron text-center">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 marginB2_xs">
                    <span class="btn btn-primary btn-block">' . $countBillets . ' billets enregistrés</span>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 marginB2_xs">
                    <span class="btn btn-info btn-block">' . $countBilletsP . ' billets publiés</span>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <a class="btn btn-success btn-block" href="index.php?v=b&amp;f=a&amp;a=cf">Créer un Billet</a>
                </div>
            </div>
        </div>
    </header>
</section>
';
if (!isset($_GET['a']) OR isset($_GET['a']) AND $_GET['a'] === 's') {
    echo'
    <section id="listBillets" class="standardBlock paddingB2 container">
        ' . $listBillets . '
    </section>
    ';
}
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
elseif (isset($_GET['a']) AND $_GET['a'] === 'up' AND !isset($_GET['m'])) {

    echo'
    <section id="listBillets" class="standardBlock paddingB2 container">
        ' . $catchUpdateBillets . '
    </section>
    ';

    
}
