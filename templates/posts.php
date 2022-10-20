<?php include 'components/header.php'; ?>
<?php foreach ($posts as $post) : ?>
    <h2><a href="posts/<?= $post->getSlug() ?>"><?= $post->getTitle() ?></a></h2>
    <p><b>Author: </b><?= $post->getAuthorId() ?></p>
    <p><?= $post->getExcerpt() ?></p>
    <hr>
<?php endforeach ?>
<?php include 'components/footer.php'; ?>