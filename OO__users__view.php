<?php

if ($_GET['f'] === 'c') {
   
    if (!isset($_POST['pseudo'])) //On est dans la page de formulaire
    {
        ?>
        <section class="coreBlock container">
            <form method="post" action="index.php?v=u&amp;f=c" class="">        
                <div class="row">
                    <div class="col-lg-offset-3 col-md-offset-3 col-sm-offset-3 col-lg-6 col-md-6 col-sm-6 col-xs-12 form-group">
                        <div>
                            <input class="form-control" placeholder="Identifiant" name="pseudo" type="text" id="pseudo" />
                        </div>  
                    </div>
                    <div class="col-lg-offset-3 col-md-offset-3 col-sm-offset-3 col-lg-6 col-md-6 col-sm-6 col-xs-12 form-group">
                        <div>
                            <input class="form-control" type="password" name="password" id="password" placeholder="Mot de passe"/>
                        </div>
                    </div>
                    <div class="col-lg-offset-3 col-md-offset-3 col-sm-offset-3 col-lg-6 col-md-6 col-sm-6 col-xs-12 form-group">           
                        <div>
                            <input class="form-control btn btn-success" type="submit" value="Connexion" />
                        </div>
                    </div>
                    <div class="col-lg-offset-3 col-md-offset-3 col-sm-offset-3 col-lg-6 col-md-6 col-sm-6 col-xs-12 form-group text-center"> 
                        <div>
                            <a class="" href="index.php?v=u&f=a">Mot de passe oublié ?</a>
                        </div>
                    </div>
                </div>       
            </form>
        </section>
        <?php
    }
}
elseif ($_GET['f'] === 'i') {
    ?>   
    <section class="coreBlock container">
        <div class="text-center marginCore">
            <form action="index.php?v=u&amp;f=iv" method="POST" class="">		
                <div class="row">
                    <div class="col-lg-offset-4 col-md-offset-3 col-lg-4 col-md-6 col-sm-12 col-xs-12">
                        <div class="row">

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                <input class="form-control" name="pseudo" type="text" id="pseudo" min="3" max="50" placeholder="Identifiant" required />
                            </div>	

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                <input class="form-control" name="MDP" type="password" id="mdp" placeholder="Mot de passe" required />
                                <span id="aideMdp"></span>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                <input class="form-control" name="confirm" type="password" id="confirm" placeholder="Confirmer le mot de passe" required />
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                <input class="form-control" name="email" type="email" id="email" placeholder="Adresse e-mail" required />
                            </div>
                        
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                <input class="form-control btn btn-success" type="submit" value="Envoyer" />
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <?php
}