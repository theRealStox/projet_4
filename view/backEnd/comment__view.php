<?php
if (!isset($_GET['f']) OR isset($_GET['f']) AND $_GET['f'] === 'a') {
    echo'
    <section id="comment__listComments" class="standardBlock paddingB2 container allBillets">
        ' . $comment__showComments . '
    </section>
    ';
}