<?php include 'components/header.php'; ?>
<?php foreach (array_reverse($posts) as $key => $value) : ?>
    <h2><a href="posts/<?= $value['slug'] ?>"><?= $value['title'] ?></a></h2>
    <p><b>Author: </b><?php echo $db; ?></p>
    <p><?= $value['excerpt'] ?></p>
    <hr>
<?php endforeach ?>
<?php include 'components/footer.php'; ?>