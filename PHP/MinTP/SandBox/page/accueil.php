<?php ob_start(); ?>
<h1>Articles</h1>
<?php foreach ($articles ?? '' as $article):?>
<div class="article" style="background-color: #2a7575">
    <h2><?= $article['title']?> <span style="font-size: 1rem; color: #31b572">par <?= User::getUserName($article['id_author']) ?></span></h2>
    <div><?= $article['content']?></div>
</div>
<?php endforeach ?>
<?php $pageContent = ob_get_clean(); ?>

