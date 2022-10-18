<?php include 'components/header.php'; ?>

<h2><?= $post->title ?></h2>
<p><b>Author: </b><?= $post->author->getName() ?></p>
<p><?= $post->body ?></p>

<?php include 'components/footer.php'; ?>