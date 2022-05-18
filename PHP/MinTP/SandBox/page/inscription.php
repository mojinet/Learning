<?php ob_start(); ?>
<h2>Inscription</h2>
    <form action="/post_inscription" method="post">
        <label for="name">Nom</label>
        <input type="text" name="name" id="name"><br>
        <label for="password">Password</label>
        <input type="password" name="password" id="password"><br>
        <label for="password2">Confirmer Password</label>
        <input type="password" name="password2" id="password2"><br>
        <input type="submit" value="Inscription">
        <?= $error ?? '' ?>
    </form>
<?php $pageContent = ob_get_clean(); ?>