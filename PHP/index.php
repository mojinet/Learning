<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulaire</title>
</head>
<body>
    <h1>Formulaire</h1>
    <form action="form.php" method="post" enctype="multipart/form-data">
        <!-- userName -->
        <label for="userName">Votre nom</label><br>
        <input type="text" name="userName" id="userName"> <br><br>
        <!-- userMail -->
        <label for="userMail">Votre mail</label><br>
        <input type="text" name="userMail" id="userMail"> <br><br>
        <!-- commentaire -->
        <label for="commentaire">Commentaire</label><br>
        <textarea cols="50" rows="10" name="commentaire" id="commentaire"> </textarea> <br><br>
        <!-- userFile -->
        <input type="file" name="userFile" id="userFile"><br>
        <!-- agree -->
        <input type="checkbox" name="agree" id="agree">
        <label for="agree">J'accepte les conditions</label><br><br>
        <!-- submit -->
        <input type="submit" value="Envoyé">
    </form>
</body>
</html>