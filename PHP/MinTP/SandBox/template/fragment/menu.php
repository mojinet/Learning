<menu id="menu">
    <a href="/">ποΈ Accueil</a>
    <?php if(isset($_SESSION['connected']) && $_SESSION['connected'] === true): ?>
        <a href="/compte">π€ Mon compte</a>
        <a href="/deconnection">β Se deconnecter</a>
    <?php else: ?>
        <a href="/connection">π€ Se connecter</a>
        <a href="/inscription">π S'inscrire</a>
    <?php endif ?>
    <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
        <a href="/ajoutArticle">βοΈ CrΓ©er article</a>
    <?php endif ?>
    <a href="/contact">π Contact</a>
</menu>