<?php
require('model/billets__model.php');

/*
 ██████╗██████╗ ███████╗ █████╗ ████████╗███████╗
██╔════╝██╔══██╗██╔════╝██╔══██╗╚══██╔══╝██╔════╝
██║     ██████╔╝█████╗  ███████║   ██║   █████╗  
██║     ██╔══██╗██╔══╝  ██╔══██║   ██║   ██╔══╝  
╚██████╗██║  ██║███████╗██║  ██║   ██║   ███████╗
 ╚═════╝╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝   ╚═╝   ╚══════╝
*/
if (isset($_GET['a']) AND $_GET['a'] === 'cv') {

    if (isset($_POST['titleNewBillet']) 
        AND isset($_POST['coreNewBillet']) 
        AND !empty($_POST['titleNewBillet']) 
        AND !empty($_POST['coreNewBillet'])) {
            
        $newBillet = addNewBillet($_SESSION['pseudo'], $_POST['titleNewBillet'], $_POST['coreNewBillet']);

        header('Location: index.php?v=b&f=a&return=' . $newBillet . '');
    }
}
/*
██╗   ██╗██████╗ ██████╗  █████╗ ████████╗███████╗
██║   ██║██╔══██╗██╔══██╗██╔══██╗╚══██╔══╝██╔════╝
██║   ██║██████╔╝██║  ██║███████║   ██║   █████╗  
██║   ██║██╔═══╝ ██║  ██║██╔══██║   ██║   ██╔══╝  
╚██████╔╝██║     ██████╔╝██║  ██║   ██║   ███████╗
 ╚═════╝ ╚═╝     ╚═════╝ ╚═╝  ╚═╝   ╚═╝   ╚══════╝
                                                  
*/
if (isset($_GET['a']) AND $_GET['a'] === 'up') {

    if (isset($_GET['r']) AND !empty($_GET['r'])) {

        $referenceBillet = htmlspecialchars($_GET['r']);

        $updateBillet = updateBillet($referenceBillet);

        if (isset($_GET['m']) AND $_GET['m'] == 1) {

            if (isset($_POST['titleNewBillet']) 
                AND isset($_POST['coreNewBillet']) 
                AND !empty($_POST['titleNewBillet']) 
                AND !empty($_POST['coreNewBillet'])) {
                    
                $titleNewBillet = htmlspecialchars($_POST['titleNewBillet']);
                $coreNewBillet = htmlspecialchars($_POST['coreNewBillet']);

                $majBillets = majBillets($referenceBillet, $titleNewBillet, $coreNewBillet);

                header('Location: index.php?v=b&f=a&return=' . $majBillets . '');
            }
        }
        else {
            
            if ($updateBillet == true)    
            {
                ob_start();
    
                    while ($data = $updateBillet->fetch())
                    {
                        $dataJF_billets_title = $data['JF_billets_title'];
                        $dataJF_billets_content = $data['JF_billets_content'];
    
                        echo'
                        <form method="POST" action="index.php?v=b&f=a&a=up&m=1&r=' . $referenceBillet . '" class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                <input type="text" name="titleNewBillet" class="form-control" value="' . $dataJF_billets_title . '"/>
                            </div>    
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                <textarea type="text" rows="12" name="coreNewBillet" class="form-control">' . $dataJF_billets_content . '</textarea>
                            </div>   
                            <div class="col-lg-offset-5 col-md-offset-5 col-sm-offset-5 col-xs-offset-5 col-lg-2 col-md-2 col-sm-2 col-xs-2 form-group">
                                <input type="submit" value="Publier" class="form-control btn btn-success"/>
                            </div>       
                        </form>
                        ';
                    }
                    $updateBillet->CloseCursor();  
    
                $catchUpdateBillets = ob_get_clean();
            }
            else
            {
                echo'Erreur sur la réponse a la requete SQL d\'update';
            }
        }        
    }
}
/*
██████╗ ███████╗██╗     ███████╗████████╗███████╗            
██╔══██╗██╔════╝██║     ██╔════╝╚══██╔══╝██╔════╝            
██║  ██║█████╗  ██║     █████╗     ██║   █████╗              
██║  ██║██╔══╝  ██║     ██╔══╝     ██║   ██╔══╝              
██████╔╝███████╗███████╗███████╗   ██║   ███████╗            
╚═════╝ ╚══════╝╚══════╝╚══════╝   ╚═╝   ╚══════╝
*/
if (isset($_GET['a']) AND $_GET['a'] === 'd') {

    if (isset($_GET['r']) AND !empty($_GET['r'])) {

        $deleteBillet = deleteBillet($_GET['r']);

        header('Location: index.php?v=b&f=a&return=' . $deleteBillet . '');
    }
}

/*
███████╗████████╗ █████╗ ████████╗██╗   ██╗████████╗
██╔════╝╚══██╔══╝██╔══██╗╚══██╔══╝██║   ██║╚══██╔══╝
███████╗   ██║   ███████║   ██║   ██║   ██║   ██║   
╚════██║   ██║   ██╔══██║   ██║   ██║   ██║   ██║   
███████║   ██║   ██║  ██║   ██║   ╚██████╔╝   ██║   
╚══════╝   ╚═╝   ╚═╝  ╚═╝   ╚═╝    ╚═════╝    ╚═╝   
                                                    
*/
if (isset($_GET['a']) AND $_GET['a'] === 's') {

    if (isset($_GET['r']) AND !empty($_GET['r'])) {         
    
        if ($_GET['k'] == 0 OR $_GET['k'] == 1) {
            
            $statutBillet = statutBillet($_GET['r'], $_GET['k']);

            header('Location: index.php?v=b&f=a&return=' . $statutBillet . '');                
        }
    }
}

/*
 ██████╗ ██████╗ ██╗   ██╗███╗   ██╗████████╗
██╔════╝██╔═══██╗██║   ██║████╗  ██║╚══██╔══╝
██║     ██║   ██║██║   ██║██╔██╗ ██║   ██║   
██║     ██║   ██║██║   ██║██║╚██╗██║   ██║   
╚██████╗╚██████╔╝╚██████╔╝██║ ╚████║   ██║   
 ╚═════╝ ╚═════╝  ╚═════╝ ╚═╝  ╚═══╝   ╚═╝   
*/
$countBillets = countBillets();
$countBilletsP = countBilletsP();

/*
██████╗ ███████╗ █████╗ ██████╗ 
██╔══██╗██╔════╝██╔══██╗██╔══██╗
██████╔╝█████╗  ███████║██║  ██║
██╔══██╗██╔══╝  ██╔══██║██║  ██║
██║  ██║███████╗██║  ██║██████╔╝
╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝╚═════╝ 
*/
$listBillets = showBillet();
if ($listBillets == true)    
{
    ob_start();

    while ($data = $listBillets->fetch())
    {
        echo"
        <div class='row'>
            <header class='col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'>
                <div class='row'>
                    <div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 DC JC AIC height40px marginB2_xs'>
                        <div>Dernière mise à jour le " . dateFrench($data['JF_billets_lastUpdate'], 0) . "</div>
                    </div>
                    <div class='col-lg-2 col-md-2 col-sm-2 col-xs-4 DR JC AIC'>
                        ";
                        if ($data['JF_billets_state'] == 1) {
                            echo'
                            <div class="divButton btn btn-success">                             
                                <a class="" href="index.php?v=b&amp;f=a&amp;a=s&amp;k=0&amp;r=' . $data["JF_billets_uniqID"] . '">                            
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                            ';
                        }
                        elseif ($data['JF_billets_state'] == 0) {
                            echo'
                            <div class="divButton btn btn-warning">
                                <a class="" href="index.php?v=b&amp;f=a&amp;a=s&amp;k=1&amp;r=' . $data["JF_billets_uniqID"] . '">                            
                                    <i class="fas fa-eye-slash"></i>
                                </a>
                            </div>
                            ';
                        }
                        echo"
                    </div>
                    <div class='col-lg-2 col-md-2 col-sm-2 col-xs-4 DR JC AIC'>
                        <div class='divButton btn btn-info'>
                            <a class='' href='index.php?v=b&amp;f=a&amp;a=up&amp;r=" . $data['JF_billets_uniqID'] . "'>
                                <i class='fas fa-edit'></i>
                            </a>
                        </div>
                    </div>
                    <div class='col-lg-2 col-md-2 col-sm-2 col-xs-4 DR JC AIC'>
                        <div class='divButton btn btn-danger'>
                            <a class='' href='index.php?v=b&amp;f=a&amp;a=d&amp;r=" . $data['JF_billets_uniqID'] . "'>                            
                                <i class='fas fa-trash'></i>
                            </a>
                        </div>
                    </div>
                </div>
            </header>
            <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                <div class='row'>
                    <h3>" . $data['JF_billets_title'] . "</h3>
                    <h4>Par " . $data['JF_billets_author'] . " publié le " . dateFrench($data['JF_billets_date'], 1) . "</h4>
                    <div class='coreBillet'>" . html_entity_decode($data['JF_billets_content']) . "</div>
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
    echo'Erreur sur la réponse a la requete SQL de lecture des billets';
}



require('view/backEnd/billets__view.php');
