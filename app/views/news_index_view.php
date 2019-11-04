<p><a href="<?= url('/news/addnews') ?>">add news</a></p>
<div>
    <?php
    $posts = models\NewsModel::getAll();
    var_dump($posts);
     
    ?>
</div>
<p><a href="<?= url('/news/addnews') ?>">add news</a></p>



