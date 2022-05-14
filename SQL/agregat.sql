-- https://fxjollois.github.io/cours-sql/
-- Section 3 - Agrégats

-- 1.1- Calculer le nombre d'employés qui sont "Représentant(e)"
SELECT COUNT(*)
FROM Employe
WHERE Fonction = "Représentant(e)"
-- 1.2- Calculer le nombre de produits de moins de 50 euros
SELECT COUNT(*)
FROM Produit
WHERE PrixUnit < 50
-- 1.3- Calculer le nombre de produits de catégorie 2 et avec plus de 10 unités en stocks
SELECT COUNT(*)
FROM Produit
WHERE CodeCateg = 2
  AND UnitesStock > 10
-- 1.4- Calculer le nombre de produits de catégorie 1, des fournisseurs 1 et 18
SELECT COUNT(*)
FROM Produit
WHERE CodeCateg = 1
  AND NoFour IN (1,18)
-- 1.5- Calculer le nombre de pays différents de livraison
SELECT COUNT(DISTINCT PaysLiv)
FROM Commande
-- 1.6- Calculer le nombre de commandes réalisées le 28/03/2016.
SELECT COUNT(*)
FROM Commande
WHERE DateCom = "2016-03-28"

-- 2.1- Calculer le coût moyen du port pour les commandes du client dont le code est "QUICK" (attribut CodeCli)
SELECT AVG(Port) AS "Port Moyen"
FROM Commande
WHERE CodeCli = "QUICK"
-- 2.2- Calculer le coût du port minimum et maximum des commandes
SELECT MIN(Port) AS "Port Min", MAX(Port) AS "Port Max"
FROM Commande
-- 2.3- Pour chaque messager (par leur numéro : 1, 2 et 3), donner le montant total des frais de port leur correspondant
SELECT SUM(Port)
FROM Commande
WHERE NoMess = 1 -- il reste juste a modifier en 2 et 3 pour tous les avoirs

-- 3.1- Donner le nombre d'employés par fonction
SELECT Fonction, COUNT(*)
FROM Employe
GROUP BY Fonction -- Toujours apres le WHERE
-- 3.2- Donner le montant moyen du port par messager
SELECT NoMess, AVG(Port)
FROM Commande
GROUP BY NoMess
-- 3.3- Donner le nombre de catégories de produits fournis par chaque fournisseur
SELECT NoFour, COUNT(CodeCateg)
FROM Produit
GROUP By NoFour
-- 3.4- Donner le prix moyen des produits pour chaque fournisseur et chaque catégorie de produits fournis par celui-ci
SELECT NoFour, CodeCateg, AVG(PrixUnit)
FROM Produit
GROUP BY NoFour, CodeCateg

-- 4.1- Lister les fournisseurs ne fournissant qu'un seul produit
SELECT NoFour, COUNT(*)
FROM Produit
GROUP BY NoFour
HAVING COUNT(*) = 1 -- Le having est un where sur le group by
-- 4.2- Lister les catégories dont les prix sont en moyenne supérieurs strictement à 150 euros
SELECT CodeCateg, AVG(PrixUnit)
FROM Produit
GROUP BY CodeCateg
HAVING AVG(PrixUnit) > 150
-- 4.3- Lister les fournisseurs ne fournissant qu'une seule catégorie de produits
SELECT NoFour, COUNT(CodeCateg)
FROM Produit
GROUP BY NoFour
HAVING COUNT(CodeCateg) = 1