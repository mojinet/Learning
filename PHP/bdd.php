<?php
#--------------------#
#------- BDD --------#
#--------------------#

// variable pour le DSN
$dbName = "db_test";
$dbHost = "localhost";
$dsn = "mysql:dbname=$dbName;host=$dbHost;charset=utf8";
$username = 'root';
$password = '';

// Connexion à la base de données
try{
    $db = new PDO($dsn,$username,$password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); # Parametre pour renvoyer les erreur sous forme d'exception, renverra une instance de PDOExeption en cas d'erreur
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); # Parametre pour l'affichage des erreur
    print("Connexion Réussite \n");
}catch (PDOException $e){
    printf("Erreur de connexion : %s", $e->getMessage());
}

/* Généralité
 Pour une requete renvoyant des resultat comme un select on utilisera query() qui retourne une instance de la class PDOStatement qui permettra d'acceder au resultat
 Pour une requete renvoyant le nombre de ligne affecter (update, insert, delete) on utilisera exec()
 */

// Requete de selection
# Afin de parcourir notre objet PDOStatement on peut utiliser fetchAll() quand les resultat sont limité (sinon prend bcp de ressouce) et fetch() qui parcours un a un les resultats (a utiliser sur de grande quantité des données)
$sql = 'SELECT * FROM user'; # Requete SQL
$stmt = $db->query($sql); # Envois de la requete et reponse dans $stmt
while($user = $stmt->fetch()){ # On parcours les resultat 1 à 1
    printf("l'user %s qui a l'id %d et pour mail %s a le role %s \n", $user['pseudo'], $user['id'], $user['mail'],$user['role']);
}

// Requete d'insertion : utiliser autant que possible les requete préparé
$sql = <<<SQL
INSERT INTO user (pseudo,mail,role)
VALUES('Kevin77','keke@gmail.com','user')
SQL;
$nbLignes = $db->exec($sql); # recupere le nombre de lignes affectés
printf('%d ligne(s) ajoutée(s), le dernier id inséré est le %d', $nbLignes, $db->lastInsertId());
// echaper les caracteres
$titreQuote = $db->quote("Le livre de l'année"); # Ajoutera des echappements pour les ' et "

// Requete préparée : protege des injections SQL
// 1.a requete préparé avec champs ?
$sql = <<<SQL
INSERT INTO user (pseudo,mail,role)
VALUES(?,?,?)
SQL;
// 1.b requete préparé avec champs nommées
$sql = <<<SQL
INSERT INTO user (pseudo,mail,role)
VALUES(:pseudo,:mail,:role)
SQL;
// 2 préparation de la requete
$stmt = $db->prepare($sql);
// 3.a lié les données et executé la requete
$stmt->execute([
    'pseudo' => 'Jean',
    'mail' => 'jean@jj.com',
    'role' => 'user',
]);
// 3.b bind des valeurs puis execution
$stmt->bindValue('pseudo', 'Marcel', PDO::PARAM_STR); # bind pseudo a la valeur Marcel de type string
$stmt->bindValue('mail', 'Marcel@m.fr', PDO::PARAM_STR);
$stmt->bindValue('role', 'user', PDO::PARAM_STR);
$stmt->execute(); # Puis on execute
// 4 fermeture
unset($stmt);

// transaction
# par defaut les transaction sont en mode auto-commit : chaque requete effectue sa propres transaction
$db->beginTransaction(); # On débute la transaction
$db->exec(); # On execute les requetes
$db->commit(); # On valide la transaction
$db->rollBack(); # On annule la transaction, sera aussi annuler si on ne commit() pas

// fermeture de la connexion
unset($db);
