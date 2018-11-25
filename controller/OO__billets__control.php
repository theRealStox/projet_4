<?php
$db = dbConnect();    

$O__BilletManager = new BilletManager($db);

/*
 ██████╗ ██████╗ ██╗   ██╗███╗   ██╗████████╗
██╔════╝██╔═══██╗██║   ██║████╗  ██║╚══██╔══╝
██║     ██║   ██║██║   ██║██╔██╗ ██║   ██║   
██║     ██║   ██║██║   ██║██║╚██╗██║   ██║   
╚██████╗╚██████╔╝╚██████╔╝██║ ╚████║   ██║   
 ╚═════╝ ╚═════╝  ╚═════╝ ╚═╝  ╚═══╝   ╚═╝   
*/
$getCountBillets = $O__BilletManager->getCountBillets__F__BilletManager();
$getCountBilletsP = $O__BilletManager->getCountBilletsP__F__BilletManager();

/*
██████╗ ███████╗ █████╗ ██████╗ 
██╔══██╗██╔════╝██╔══██╗██╔══██╗
██████╔╝█████╗  ███████║██║  ██║
██╔══██╗██╔══╝  ██╔══██║██║  ██║
██║  ██║███████╗██║  ██║██████╔╝
╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝╚═════╝ 
*/
$mode = 0;
$getListBillets = $O__BilletManager->getListBillets__F__BilletManager($mode);

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

        $titleNewBillet = htmlspecialchars($_POST['titleNewBillet']);
        $coreNewBillet = htmlspecialchars($_POST['coreNewBillet']);
        $billetUniqID = ('billet-' . md5($titleNewBillet.NOW));
        
        $newBillet = $O__BilletManager->addNewBillet__F__BilletManager($_SESSION['pseudo'], $titleNewBillet, $coreNewBillet, $billetUniqID);

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

        $updateBillet = $O__BilletManager->getDetailsForUpdateBillet__F__BilletManager($referenceBillet);

        if (isset($_GET['m']) AND $_GET['m'] == 1) {

            if (isset($_POST['titleNewBillet']) 
                AND isset($_POST['coreNewBillet']) 
                AND !empty($_POST['titleNewBillet']) 
                AND !empty($_POST['coreNewBillet'])) {
                    
                $titleNewBillet = htmlspecialchars($_POST['titleNewBillet']);
                $coreNewBillet = htmlspecialchars($_POST['coreNewBillet']);

                $majBillets = $O__BilletManager->updateBillets__F__BilletManager($referenceBillet, $titleNewBillet, $coreNewBillet);

                header('Location: index.php?v=b&f=a&return=' . $majBillets . '');
            }
        }
        else {
            
            if ($updateBillet == true) {

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
                                <textarea type="text" rows="12" name="coreNewBillet" class="form-control editme">' . $dataJF_billets_content . '</textarea>
                            </div>   
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                <input type="submit" value="Publier" class="form-control btn btn-success"/>
                            </div>       
                        </form>
                        ';
                    }
                    $updateBillet->CloseCursor();  
    
                $catchUpdateBillets = ob_get_clean();
            }
            else {
                
                $desc = "Update du billet impossible, $ rep is false";
                $code = "302";
                $page = "OO__billets__control.php";
                $ip = get_ip();
                $saveError = errorRegister($page, $desc, $code, $ip, $uniqueID, $pseudo, 0);    
                        
                $notifyUser = "billet__ErrorLoadingContent";
                header('Location: index.php?v=c&f=a&return=' . $notifyUser . '');
            }
        }        
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

        $referenceBillet = htmlspecialchars($_GET['r']);
    
        if ($_GET['k'] == 0 OR $_GET['k'] == 1) {
            
            $mode = htmlspecialchars($_GET['k']);

            $statutBillet = $O__BilletManager->updateStatutBillet__F__BilletManager($referenceBillet, $mode);

            header('Location: index.php?v=b&f=a&return=' . $statutBillet . '');                
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

        $referenceBillet = htmlspecialchars($_GET['r']);

        $deleteBillet = $O__BilletManager->deleteBillet__F__BilletManager($referenceBillet);

        header('Location: index.php?v=b&f=a&return=' . $deleteBillet . '');
    }
}

require 'view/backEnd/OO__billet__view.php';