<p> Main page </p>

<?php foreach ($news as $value): ?>
    <h1><?php echo $value['title']?></h1>
    <p><?php echo $value['description']?></p>
    <br>
<?php endforeach; ?>


