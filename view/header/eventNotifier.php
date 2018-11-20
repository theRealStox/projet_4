<section class="container-fluid menuNotif">

<?php
if (isset($returnNotif) AND !empty($returnNotif)) {          
echo'
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
        ';
            /*
             ██████╗ ███████╗███╗   ██╗       ███╗   ██╗ ██████╗ ████████╗██╗███████╗
            ██╔════╝ ██╔════╝████╗  ██║       ████╗  ██║██╔═══██╗╚══██╔══╝██║██╔════╝
            ██║  ███╗█████╗  ██╔██╗ ██║       ██╔██╗ ██║██║   ██║   ██║   ██║█████╗  
            ██║   ██║██╔══╝  ██║╚██╗██║       ██║╚██╗██║██║   ██║   ██║   ██║██╔══╝  
            ╚██████╔╝███████╗██║ ╚████║██╗    ██║ ╚████║╚██████╔╝   ██║   ██║██║     
             ╚═════╝ ╚══════╝╚═╝  ╚═══╝╚═╝    ╚═╝  ╚═══╝ ╚═════╝    ╚═╝   ╚═╝╚═╝     
                                                                                     
            */
            if ($returnNotif === 'notLoggedAsAdmin') {
                echo'
                <div class="alert-danger">Vous devez être connecté en temps qu\'administrateur pour accéder à cette page</div>
                ';
            }
            elseif ($returnNotif === 'USER_CO_SET') {
                echo'
                <div class="alert-success">Bienvenue ' . $_SESSION['pseudo'] . ' <br />Vous êtes maintenant connecté.</div>
                ';
            }
            elseif ($returnNotif === 'userAlreadyCo') {
                echo'
                <div class="alert-info">Vous êtes déjà connecté, vous pouvez profiter du site.</div>
                ';
            }
            elseif ($returnNotif === 'tech__errorReg') {
                echo'
                <div class="alert-danger">
                    Une erreur technique est survenue, un ticket a été ouvert.<br />
                    Vous pouvez rééssayer dans quelques minutes, <br />
                    toutes nos excuses.
                </div>
                ';
            }
            /*
             ██████╗ ██████╗ ███╗   ██╗████████╗███████╗███╗   ██╗████████╗
            ██╔════╝██╔═══██╗████╗  ██║╚══██╔══╝██╔════╝████╗  ██║╚══██╔══╝
            ██║     ██║   ██║██╔██╗ ██║   ██║   █████╗  ██╔██╗ ██║   ██║   
            ██║     ██║   ██║██║╚██╗██║   ██║   ██╔══╝  ██║╚██╗██║   ██║   
            ╚██████╗╚██████╔╝██║ ╚████║   ██║   ███████╗██║ ╚████║   ██║   
             ╚═════╝ ╚═════╝ ╚═╝  ╚═══╝   ╚═╝   ╚══════╝╚═╝  ╚═══╝   ╚═╝   
            */
            elseif ($returnNotif === 'content__ErrorLoadingContent') {
                echo'
                <div class="alert-danger">
                    Une erreur technique est survenue, un ticket a été ouvert.<br />
                    Vous pouvez rééssayer dans quelques minutes, <br />
                    toutes nos excuses.
                </div>
                ';
            }
            elseif ($returnNotif === 'content__ErrorLoadingSingleBillet') {
                echo'
                <div class="alert-warning">
                    Une erreur est survenue, aucun billet ne correspond a votre recherche.
                </div>
                ';
            }
            elseif ($returnNotif === 'newCommentSave') {
                echo'
                <div class="alert-success">
                    Merci pour votre commentaire.<br />
                    Il sera publié dès qu\'un modérateur l\'aura approuvé.
                </div>
                ';
            } 
            elseif ($returnNotif === 'newCommentError') {
                echo'
                <div class="alert-danger">
                    Une erreur technique est survenue, un ticket a été ouvert.<br />
                    Votre commentaire n\'a pas pu être enregistré. <br />
                    Vous pouvez rééssayer dans quelques minutes, <br />
                    toutes nos excuses.
                </div>
                ';
            }
            /*
            ███████╗██████╗ ██████╗  ██████╗ ██████╗      ██████╗ ██████╗ 
            ██╔════╝██╔══██╗██╔══██╗██╔═══██╗██╔══██╗    ██╔════╝██╔═══██╗
            █████╗  ██████╔╝██████╔╝██║   ██║██████╔╝    ██║     ██║   ██║
            ██╔══╝  ██╔══██╗██╔══██╗██║   ██║██╔══██╗    ██║     ██║   ██║
            ███████╗██║  ██║██║  ██║╚██████╔╝██║  ██║    ╚██████╗╚██████╔╝
            ╚══════╝╚═╝  ╚═╝╚═╝  ╚═╝ ╚═════╝ ╚═╝  ╚═╝     ╚═════╝ ╚═════╝ 
            */
            elseif ($returnNotif === 'user__ErrorCo__MissingInput') {
                echo'
                <div class="alert-warning">
                    Une erreur s\'est produite pendant votre identification.<br />
                    Vous devez remplir tous les champs
                </div>
                ';
            }
            elseif ($returnNotif === 'user__ErrorCo__invalidLogAttempt') {
                echo'
                <div class="alert-warning">
                    Une erreur s\'est produite pendant votre identification.<br />
                    Le mot de passe ou l\'identifiant fourni se sont pas reconnus.
                </div>
                ';
            }
            /*
            ██████╗ ███████╗ ██████╗ ██╗███████╗████████╗███████╗██████╗ 
            ██╔══██╗██╔════╝██╔════╝ ██║██╔════╝╚══██╔══╝██╔════╝██╔══██╗
            ██████╔╝█████╗  ██║  ███╗██║███████╗   ██║   █████╗  ██████╔╝
            ██╔══██╗██╔══╝  ██║   ██║██║╚════██║   ██║   ██╔══╝  ██╔══██╗
            ██║  ██║███████╗╚██████╔╝██║███████║   ██║   ███████╗██║  ██║
            ╚═╝  ╚═╝╚══════╝ ╚═════╝ ╚═╝╚══════╝   ╚═╝   ╚══════╝╚═╝  ╚═╝
            */
            elseif ($returnNotif === 'user__successReg') {
                echo'
                <div class="alert-success">
                    Votre demande d\'inscription a été réalisée avec succès.<br />
                    Vous pouvez vous connecter
                </div>
                ';
            }
            elseif ($returnNotif === 'user__ErrorReg__MissingInput') {
                echo'
                <div class="alert-warning">
                    Une erreur s\'est produite pendant votre inscription.<br />
                    Vous devez remplir tous les champs
                </div>
                ';
            }
            elseif ($returnNotif === 'user__ErrorReg__invalidAttempt_idTaken') {
                echo'
                <div class="alert-warning">
                    Une erreur s\'est produite pendant votre inscription.<br />
                    Votre identifiant est déjà utilisé par un membre
                </div>
                ';
            }
            elseif ($returnNotif === 'user__ErrorReg__invalidAttempt_idWrongSize') {
                echo'
                <div class="alert-warning">
                    Une erreur s\'est produite pendant votre inscription.<br />
                    Votre identifiant est soit trop grand, soit trop petit
                </div>
                ';
            }
            elseif ($returnNotif === 'user__ErrorReg__invalidAttempt_passNoMatch') {
                echo'
                <div class="alert-warning">
                    Une erreur s\'est produite pendant votre inscription.<br />
                    Votre mot de passe et votre confirmation diffèrent, ou sont vides
                </div>
                ';
            }
            elseif ($returnNotif === 'user__ErrorReg__invalidAttempt_mailTaken') {
                echo'
                <div class="alert-warning">
                    Une erreur s\'est produite pendant votre inscription.<br />
                    Votre adresse email est déjà utilisée par un membre
                </div>
                ';
            }
            elseif ($returnNotif === 'user__ErrorReg__invalidAttempt_mailWrongForm') {
                echo'
                <div class="alert-warning">
                    Une erreur s\'est produite pendant votre inscription.<br />
                    Votre adresse E-Mail n\'a pas un format valide
                </div>
                ';
            }
            elseif ($returnNotif === 'user__ErrorReg__invalidAttempt_multipleError') {
                echo'
                <div class="alert-warning">
                    Plusieurs erreurs se sont produites pendant votre inscription.<br />
                    Voici les motifs potentiels : <br />
                    - Votre identifiant est déjà utilisé par un membre <br />
                    - Votre identifiant est soit trop grand, soit trop petit <br />
                    - Votre mot de passe et votre confirmation diffèrent, ou sont vides <br />
                    - Votre adresse email est déjà utilisée par un membre <br />
                    - Votre adresse E-Mail n\'a pas un format valide
                </div>
                ';
            }
            /*
            ██████╗ ██╗██╗     ██╗     ███████╗████████╗███████╗
            ██╔══██╗██║██║     ██║     ██╔════╝╚══██╔══╝██╔════╝
            ██████╔╝██║██║     ██║     █████╗     ██║   ███████╗
            ██╔══██╗██║██║     ██║     ██╔══╝     ██║   ╚════██║
            ██████╔╝██║███████╗███████╗███████╗   ██║   ███████║
            ╚═════╝ ╚═╝╚══════╝╚══════╝╚══════╝   ╚═╝   ╚══════╝
            */
            elseif ($returnNotif === 'newBilletSave') {
                echo'
                <div class="alert-success">Billet Publié</div>
                ';
            } 
            elseif ($returnNotif === 'newBilletError') {
                echo'
                <div class="alert-danger">Erreur Billet non Publié</div>
                ';
            }
            elseif ($returnNotif === 'deleteBilletOK') {
                echo'
                <div class="alert-success">Billet Supprimé</div>
                ';
            } 
            elseif ($returnNotif === 'deleteBilletError') {
                echo'
                <div class="alert-danger">Erreur Billet non Supprimé</div>
                ';
            }
            elseif ($returnNotif === 'statutBilletOK') {
                echo'
                <div class="alert-success">Statut du Billet modifié</div>
                ';
            } 
            elseif ($returnNotif === 'statutBilletError') {
                echo'
                <div class="alert-danger">Erreur modification du statut du Billet </div>
                ';
            }
            elseif ($returnNotif === 'updateBilletOK') {
                echo'
                <div class="alert-success">Billet modifié</div>
                ';
            } 
            elseif ($returnNotif === 'updateBilletError') {
                echo'
                <div class="alert-danger">Erreur modification du Billet </div>
                ';
            }
            elseif ($returnNotif === 'billet__ErrorLoadingContent') {
                echo'
                <div class="alert-danger">
                    Une erreur technique est survenue, un ticket a été ouvert.<br />
                    Vous pouvez rééssayer dans quelques minutes, <br />
                    toutes nos excuses.
                </div>
                ';
            }
            /*
             ██████╗ ██████╗ ███╗   ███╗███╗   ███╗███████╗███╗   ██╗████████╗███████╗
            ██╔════╝██╔═══██╗████╗ ████║████╗ ████║██╔════╝████╗  ██║╚══██╔══╝██╔════╝
            ██║     ██║   ██║██╔████╔██║██╔████╔██║█████╗  ██╔██╗ ██║   ██║   ███████╗
            ██║     ██║   ██║██║╚██╔╝██║██║╚██╔╝██║██╔══╝  ██║╚██╗██║   ██║   ╚════██║
            ╚██████╗╚██████╔╝██║ ╚═╝ ██║██║ ╚═╝ ██║███████╗██║ ╚████║   ██║   ███████║
             ╚═════╝ ╚═════╝ ╚═╝     ╚═╝╚═╝     ╚═╝╚══════╝╚═╝  ╚═══╝   ╚═╝   ╚══════╝
            */
            elseif ($returnNotif === 'comment__ErrorLoadingContent') {
                echo'
                <div class="alert-danger">
                    Une erreur technique est survenue, un ticket a été ouvert.<br />
                    Vous pouvez rééssayer dans quelques minutes, <br />
                    toutes nos excuses.
                </div>
                ';
            }
            elseif ($returnNotif === 'comment__ErrorLoadingSingleComment') {
                echo'
                <div class="alert-danger">
                    Une erreur technique est survenue, un ticket a été ouvert.<br />
                    "Pas de référence pour charger le commentaire à modifier." <br />
                    Vous pouvez rééssayer dans quelques minutes, <br />
                    toutes nos excuses.
                </div>
                ';
            }
            elseif ($returnNotif === 'comment__ErrorvalidatingContent') {
                echo'
                <div class="alert-danger">
                    Une erreur technique est survenue, un ticket a été ouvert.<br />
                    "validation du commentaire impossible" <br />
                    Vous pouvez rééssayer dans quelques minutes, <br />
                    toutes nos excuses.
                </div>
                ';
            }
            elseif ($returnNotif === 'comment__validatingContentOK') {
                echo'
                <div class="alert-success">
                    Le Commentaire a bien été validé.
                </div>
                ';
            }
            elseif ($returnNotif === 'comment__ErrorDenyingContent') {
                echo'
                <div class="alert-danger">
                    Une erreur technique est survenue, un ticket a été ouvert.<br />
                    "Refus du commentaire impossible" <br />
                    Vous pouvez rééssayer dans quelques minutes, <br />
                    toutes nos excuses.
                </div>
                ';
            }
            elseif ($returnNotif === 'comment__DenyingContentOK') {
                echo'
                <div class="alert-success">
                    Le Commentaire a bien été refusé.
                </div>
                ';
            }
            elseif ($returnNotif === 'content__SignalingCommentOK') {
                echo'
                <div class="alert-success">
                    Le Commentaire a bien été signalé.
                </div>
                ';
            }
            elseif ($returnNotif === 'content__ErrorSignalingComment') {
                echo'
                <div class="alert-danger">
                    Une erreur technique est survenue, un ticket a été ouvert.<br />
                    "Signalement du commentaire impossible" <br />
                    Vous pouvez rééssayer dans quelques minutes, <br />
                    toutes nos excuses.
                </div>
                ';
            }
            echo'
        </div>                
    </div>
    ';
}
?>
</section>
