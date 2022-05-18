<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title><?= $pageTitle ?? 'SandBox' ?></title>
</head>
<body>
    <!-- Main wrap -->
    <div id="l_main-wrapper">
        <!-- Header -->
        <header id="l_header">
            <h1>SandBox</h1>
            <?php require 'fragment/menu.php' ?>
        </header>
        <!-- Main -->
        <main id="l_main">
            <?= $pageContent ?? '' ?>
        </main>
    </div>
    <!-- Footer -->
    <footer id="l_footer">
        <span  style="color:red">INFO : </span>
        <span><b style="color:green">Role</b> : <?= $_SESSION['role'] ?? 'anonyme' ?></span>
        <span><b style="color:green">Name</b> : <?= $_SESSION['name'] ?? 'anonyme' ?></span>
    </footer>
</body>
</html>