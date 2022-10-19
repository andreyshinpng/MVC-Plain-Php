<?php include 'components/header.php'; ?>

<h2><?= $post['title'] ?></h2>
<p><b>Author: </b><?php echo $post['author_id']; ?></p>
<p><?= $post['body'] ?></p>

<?php include 'components/footer.php'; ?>