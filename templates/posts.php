<?php include 'components/header.php'; ?>
<?php foreach (array_reverse($posts) as $post) : ?>
    <h2><a href="posts/<?= $post->getId() ?>"><?= $post->getTitle() ?></a></h2>
    <p><b>Author: </b><?= $post->getAuthor()->getUsername() ?></p>
    <p><?= $post->getExcerpt() ?></p>
    <hr>
<?php endforeach ?>
<?php include 'components/footer.php'; ?>