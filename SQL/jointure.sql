-- https://fxjollois.github.io/cours-sql/
-- Section 4 - Jointure

-- 1.1- Récupérer les informations des fournisseurs pour chaque produit
SELECT *
FROM Produit NATURAL JOIN Fournisseur;
-- 1.2- Afficher les informations des commandes du client "Lazy K Kountry Store"
SELECT *
FROM Produit
NATURAL JOIN Commande
WHERE Destinataire = "Lazy K Kountry Store"
-- 1.3- Afficher le nombre de commande pour chaque messager (en indiquant son nom)
SELECT NomMess,COUNT(*) AS "Nombre de commandes"
FROM Commande NATURAL JOIN Messager
GROUP BY NoMess

-- 2.1- Récupérer les informations des fournisseurs pour chaque produit, avec une jointure interne
SELECT *
FROM produit
INNER JOIN Fournisseur USING(NoFour)
-- 2.2- Afficher les informations des commandes du client "Lazy K Kountry Store", avec une jointure interne
SELECT *
FROM Commande
INNER JOIN Messager USING(NoMess)
WHERE Destinataire = "Lazy K Kountry Store"
-- 2.3- Afficher le nombre de commande pour chaque messager (en indiquant son nom), avec une jointure interne
SELECT COUNT(*), *
FROM Commande AS C -- on donne un alias
    INNER JOIN Messager AS M
    ON C.NoMess = M.NoMess -- alternative a USING()
GROUP BY C.NoMess
-- 2.4- Afficher pour chaque employé le nom et le prénom de son responsable
SELECT *
FROM Employe AS E
    INNER JOIN Employe AS R
    ON E.RendCompteA = R.NoEmp

-- 3.1- Compter pour chaque produit, le nombre de commandes où il apparaît, même pour ceux dans aucune commande
SELECT RefProd, COUNT(D.RefProd) AS "Nombre de commande"
FROM Produit AS P
    LEFT OUTER JOIN DetailCommande AS D
    USING (RefProd)
GROUP BY RefProd
-- 3.2- Lister les produits n'apparaissant dans aucune commande
SELECT RefProd, COUNT(D.RefProd) AS "Nombre de commande"
FROM Produit AS P
    LEFT OUTER JOIN DetailCommande AS D
    USING (RefProd)
GROUP BY RefProd
HAVING COUNT(D.RefProd) = 0
-- 3.3- Existe-t'il un employé n'ayant enregistré aucune commande ?
SELECT NoEmp, COUNT(C.NoEmp)
FROM Employe AS E
    LEFT OUTER JOIN Commande AS C
    USING(NoEmp)
GROUP BY NoEmp
HAVING COUNT(C.NoEmp) = 0

-- 4.1- Récupérer les informations des fournisseurs pour chaque produit, avec jointure à la main
SELECT *
FROM Fournisseur AS F, Produit AS P
WHERE F.NoFour = P.NoFOur
-- 4.2- Afficher les informations des commandes du client "Lazy K Kountry Store", avec jointure à la main
SELECT *
FROM Commande AS C, Messager AS M
WHERE C.Destinataire = "Lazy K Kountry Store"
  AND C.NoMess = M.NoMess
-- 4.3- Afficher le nombre de commande pour chaque messager (en indiquant son nom), avec jointure à la main
SELECT NomMess,COUNT(*) AS "Nombre de commandes"
FROM Commande AS C, Messager AS M
WHERE C.NoMess = M.NoMess
GROUP BY NomMess