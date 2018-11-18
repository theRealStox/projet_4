<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= $title ?></title>
        <meta name="description" content="Projet de blog pour la formation OC">
        <link href="public/CSS/normalize.css" rel="stylesheet" /> 
        <link href="public/CSS/bootstrap.css" rel="stylesheet">
        <link href="public/CSS/bootstrap-select.css" rel="stylesheet">
        <link href="public/CSS/root.css" rel="stylesheet" /> 
        <link href="public/CSS/generique.css" rel="stylesheet" /> 
        <link href="public/CSS/bloc.css" rel="stylesheet" /> 
        <link href="public/CSS/color.css" rel="stylesheet" /> 
        <link rel="shortcut icon" type="image/x-icon" href="../img/icon/longTermLoc.png" />
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link href="https://fonts.googleapis.com/css?family=Pattaya" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">  
        <script defer src="https://use.fontawesome.com/releases/v5.4.1/js/all.js" integrity="sha384-L469/ELG4Bg9sDQbl0hvjMq8pOcqFgkSpwhwnslzvVVGpDjYJ6wJJyYjvG3u8XW7" crossorigin="anonymous"></script>
    </head>
    
    
    <body>
        
        <?= $content ?>
        
        <script src="public/JS/script.js"></script>
        <script src="public/JS/jquery.js"></script>
        <!-- Javascript de Bootstrap -->
        <script src="public/JS/bootstrap.min.js"></script>
        <script src="public/JS/bootstrap-select.js"></script>
        <script src="public/JS/jquery.tinymce.min.js"></script>
        <script src="public/JS/tinymce.min.js"></script>
        <script>tinymce.init({ selector:'textarea.editme' });</script>
    </body>
    

</html>