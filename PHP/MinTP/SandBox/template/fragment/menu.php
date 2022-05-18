<menu id="menu">
    <a href="/">🏘️ Accueil</a>
    <?php if(isset($_SESSION['connected']) && $_SESSION['connected'] === true): ?>
        <a href="/compte">👤 Mon compte</a>
        <a href="/deconnection">✋ Se deconnecter</a>
    <?php else: ?>
        <a href="/connection">👤 Se connecter</a>
        <a href="/inscription">👉 S'inscrire</a>
    <?php endif ?>
    <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
        <a href="/ajoutArticle">✍️ Créer article</a>
    <?php endif ?>
    <a href="/contact">💌 Contact</a>
</menu>