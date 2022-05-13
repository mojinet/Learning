-- https://fxjollois.github.io/cours-sql/
-- Section 2 - Calculs et fonctions

-- 1.1- Calculer, pour la commande numéro 10251, pour chaque produit acheté dans celle-ci, le montant de la ligne d'achat en incluant la remise (stockée en proportion dans la table)
SELECT *,
       ROUND((PrixUnit*Qte)*(1-Remise),2) AS "prix remisé" -- Créer un champs prix calcule avec la remise arondi
FROM DetailCommande
WHERE Nocom = 10251

-- 2.1- Concaténer les champs Adresse, Ville, CodePostal et Pays dans un nouveau champ nommé Adresse complète, pour avoir : Adresse, CodePostal Ville, Pays
SELECT Adresse || " " || CodePostal || " " || Ville || " " || Pays AS "Adresse Complete" -- Concatene plusieurs colonne
FROM Client
-- 2.2- Extraire les deux derniers caractères des codes clients
SELECT SUBSTR(CodeCli,1,2) AS ShortRef, * -- Extrait les 2 premier caracteres de la colonne CodeCli
FROM Client
-- 2.3- Mettre en minuscule le nom des sociétés
SELECT DISTINCT LOWER(Societe)
FROM Client
-- 2.4- Remplacer le terme "marketing" par "mercatique" dans la fonction des contacts
SELECT CodeCli, Societe, REPLACE(Fonction,"marketing","Mercatique") AS Fonction
FROM Client
-- 2.5- Indiquer la présence du terme "Chef" dans la fonction du contact
SELECT *,
    INSTR(Fonction,"Chef") AS Chef -- Recherche la chain "Chef" Si existe renvois position sinon 0
FROM Client

-- 3.1- Calculer pour chaque commande le jour de la semaine, le numéro de semaine dans l'année et le mois
SELECT NoCom,
       STRFTIME("%w", DateCom) AS "Jour de la semaine", -- Extrait le jour de la semaine depuis DateCom : 0 pour dimanche 6 pour samedi
       STRFTIME("%W", DateCom) AS "N° semaine dans l'année", -- semaine de 0 a 52/53
       STRFTIME("%m", DateCom) AS "Mois"
FROM Commande
-- 3.2- Lister les commandes ayant eu lieu un dimanche
SELECT *
FROM Commande
WHERE STRFTIME("%w", DateCom) LIKE 0
-- 3.3- Calculer le nombre de jours entre la date de la commande (DateCom) et la date butoir de livraison (ALivAvant), pour chaque commande
SELECT NoCom, DateCom, ALivAvant,
       (JULIANDAY(ALivAvant) - JULIANDAY(DateCom)) AS "interval" -- Interval en jours entre 2 dates
FROM Commande
-- 3.4- On souhaite aussi contacter les clients 1 an, 1 mois et 1 semaine après leur commande. Calculer les dates correspondantes pour chaque commande
SELECT NoCom, DateCom,
    DATE(DateCom, "+1 year", "+1 month", "+1 day") AS "Contacter le"
FROM Commande

-- 4.1- A partir de la table Produit, afficher "Produit non disponible" lorsque l'attribut Indisponible vaut 1, et "Produit disponible" sinon.
SELECT Refprod,Indisponible,
       CASE
           WHEN Indisponible == 1 THEN "Disponible"
           ELSE "pas disponible"
           END AS Status
FROM Produit
-- 4.2- Dans la table DetailCommande, indiquer les infos suivantes en fonction de la remise
-- si elle vaut 0 : "aucune remise"
-- si elle vaut entre 1 et 5% (inclus) : "petite remise"
-- si elle vaut entre 6 et 15% (inclus) : "remise modérée"
-- sinon :"remise importante"
SELECT Nocom, Remise,
       CASE
           WHEN Remise == 0 THEN "Pas de remise"
           WHEN Remise > 0 AND Remise <= 0.05 THEN "Petite remise"
           WHEN Remise > 0.05 AND Remise <= 0.15 THEN "Moyenne remise"
           WHEN Remise > 0.15 THEN "Grande remise"
           END AS "Detail remise"
FROM DetailCommande
-- 4.3- Indiquer pour les commandes envoyées si elles ont été envoyées en retard (date d'envoi DateEnv supérieure (ou égale) à la date butoir ALivAvant) ou à temps
SELECT NoCom, DateEnv, ALivAvant,
       CASE
           WHEN (JULIANDAY(ALivAvant) - JULIANDAY(DateEnv)) >= 0 THEN "A temps"
           ELSE "En retard"
           END AS "Timing livraison"

FROM Commande

-- TODO
-- 5.1- Récupérer l'année de naissance et l'année d'embauche des employés
-- 5.2- Calculer à l'aide de la requête précédente l'âge d'embauche et le nombre d'années dans l'entreprise
-- 5.3- Afficher le prix unitaire original, la remise en pourcentage, le montant de la remise et le prix unitaire avec remise (tous deux arrondis aux centimes), pour les lignes de commande dont la remise est strictement supérieure à 10%
-- 5.4- Calculer le délai d'envoi (en jours) pour les commandes dont l'envoi est après la date butoir, ainsi que le nombre de jours de retard
-- 5.5- Rechercher les sociétés clientes, dont le nom de la société contient le nom du contact de celle-ci