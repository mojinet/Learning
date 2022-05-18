<?php ob_start(); ?>
<h2>Connexion</h2>
    <form action="/post_connection" method="post">
        <label for="name">Nom</label>
        <input type="text" name="name" id="name"> <br>
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password"> <br>
        <input type="submit" value="Se connecter">
        <?= $error ?? '' ?>
    </form>
<?php $pageContent = ob_get_clean(); ?>