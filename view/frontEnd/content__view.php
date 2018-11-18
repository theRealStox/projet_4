<?php
if (!isset($_GET['f']) OR isset($_GET['f']) AND $_GET['f'] === 's') {
    echo'
    <section id="content__listBillets" class="standardBlock paddingB2 container allBillets">
        ' . $listBillets . '
    </section>
    ';
}
elseif (isset($_GET['f']) AND $_GET['f'] === 'r') {
    echo'
    <section id="content__listBillets" class="standardBlock paddingB2 container">
        ' . $content__showDetailsBillet . '
    </section>

    <section id="content__listComments" class="paddingB2 container">
        ' . $content__showCommentsBillet . '
    </section>

    <section id="content__createComments" class="paddingB2 container">
        ' . $content__showInputCommentBillet . '
    </section>
    ';
}