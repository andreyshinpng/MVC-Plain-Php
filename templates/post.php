<?php include 'components/header.php'; ?>

<h2><?= $post->getTitle() ?></h2>
<p><b>Author: </b><?= $post->getAuthor()->getUsername() ?></p>
<p><?= $post->getBody() ?></p>

<?php include 'components/footer.php'; ?>