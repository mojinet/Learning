-- https://fxjollois.github.io/cours-sql/
-- Section 1 - Requete simple

-- 2.1- Lister le contenu de la table Produit
SELECT * FROM Produit
-- 2.2- N'afficher que les 10 premiers produits
SELECT * FROM Produit
LIMIT 10 -- limite les resultat a 10
-- 2.3- Trier tous les produits par leur prix unitaire (attribut PrixUnit)
SELECT * FROM Produit
ORDER BY PrixUnit -- ordonne ASC par default
-- 2.4- Lister les trois produits les plus chers
SELECT * FROM Produit
ORDER BY PrixUnit DESC
LIMIT 3

-- 3.1- Lister les clients français installés à Paris
SELECT * FROM Client
WHERE Pays = "France"
AND UPPER(Ville) = "PARIS" -- Compare les valeur convertie en majuscule a "PARIS"
-- 3.2- Lister les clients suisses, allemands et belges
SELECT * FROM Client
WHERE Pays IN ('Suisse','Belgique','Allemagne') -- pour tout les clients dont le pays est...
-- 3.3- Lister les clients dont le numéro de fax n'est pas renseigné
SELECT * FROM Client
WHERE Fax IS NULL
-- 3.4- Lister les clients dont le nom contient "restaurant" (nom présent dans la colonne Societe)
SELECT * FROM Client
WHERE Societe LIKE '%restaurant%' -- Dont le nom a la chaine de caractere restaurant

-- 4.1- Lister uniquement la description des catégories de produits (table Categorie)
SELECT Description FROM Categorie
-- 4.2- Lister les différents pays des clients
SELECT DISTINCT Pays FROM Client -- Distinct permet de ne pas récupérer les doublon
-- 4.3- Idem en ajoutant les villes, le tout trié par ordre alphabétique du pays et de la ville
SELECT DISTINCT Pays, ville FROM Client
ORDER BY Pays, Ville

-- 5.1- Lister tous les produits vendus en bouteilles ou en canettes
SELECT * FROM Produit
WHERE QteParUnit LIKE '%bouteille%'
   OR QteParUnit LIKE '%canette%'
-- 5.2- Lister les fournisseurs français, en affichant uniquement le nom, le contact.php et la ville, triés par ville
SELECT Societe, Contact, Ville FROM Fournisseur
WHERE Pays = "France"
ORDER BY Ville
-- 5.3- Lister les produits (nom en majuscule et référence) du fournisseur n° 8 dont le prix unitaire est entre 10 et 100 euros, en renommant les attributs pour que ce soit explicite
SELECT UPPER(Nomprod), Refprod FROM Produit
WHERE NoFour = 8
  AND PrixUnit BETWEEN 10 AND 100 -- Entre 10 et 100
-- 5.4- Lister les numéros d'employés ayant réalisé une commande (cf table Commande) à livrer en France, à Lille, Lyon ou Nantes
SELECT DISTINCT NoEmp FROM Commande
WHERE PaysLiv = "France"
  AND VilleLiv IN ('Lille','Lyon','Nantes')
-- 5.5- Lister les produits dont le nom contient le terme "tofu" ou le terme "choco", dont le prix est inférieur à 100 euros (attention à la condition à écrire)
SELECT * FROM produit
WHERE (Nomprod LIKE '%tofu%'
    OR Nomprod LIKE '%choco%')
    AND PrixUnit < 100