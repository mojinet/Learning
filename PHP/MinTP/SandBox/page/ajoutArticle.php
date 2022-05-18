<?php ob_start(); ?>
<h2>Ajouter un article</h2>
    <form action="/post_ajout_article" method="post">
        <label for="title">Titre</label>
        <input type="text" name="title" id="title"><br><br>
        <label for="content">Contenu</label><br>
        <textarea name="content" id="content" cols="90vh" rows="30"></textarea><br>
        <input type="submit" value="Envoyer">
    </form>
<?php $pageContent = ob_get_clean(); ?>