<?php foreach ($this->posts as $postItem) : ?>
    <h2><a href="<?= url('/posts/item?id' . $postItem['title']) ?>"><?= $postItem['title'] ?></a></h2>
    <div><?= $postItem['text'] ?></div>

    <div>Автор: <?= $postItem['title'] ?></div>
<?php endforeach; ?>

