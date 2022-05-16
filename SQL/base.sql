-- Notion de base SQL

-- Créer une base de données
CREATE DATABASE cms;

-- Créer une table
CREATE TABLE article(
    id INT NOT NULL PRIMARY KEY, -- clé primaine
    titre VARCHAR(255) NOT NULL,
    sous_titre VARCHAR(255) NOT NULL,
    contenu TEXT NULL
);

-- Modifier une table
ALTER TABLE article ADD COLUMN auteur VARCHAR(30); -- ajout d'une colonne
ALTER TABLE article DROP COLUMN sous_titre; -- supression d'une colonne
ALTER TABLE article ADD INDEX mon_index_01(titre); -- ajoute un index sur la colonne titre, on peux mettre plusieurs colonne dans 1 seul index
DROP TABLE article; -- supprime la table article

-- Inserer des données
INSERT INTO article (titre, auteur, contenu)
VALUES ('Comment etre riche', 'Bill Gates', 'Lire et echouer');

INSERT INTO article (titre, auteur, contenu) VALUES -- insere plusieurs ligne a la fois
    ('Comment etre riche', 'Bill Gates', 'Lire et echouer'),
    ('Comment arreter de fumer', 'Gainsbourg', 'Boire des bierres'),
    ('Comment etre en forme', 'Bill Gates', 'Courir plus vite');

-- Mettre a jour UPDATE
UPDATE article SET auteur = "Connor Mc Gregor"
WHERE id = 5;

-- supprimer
DELETE FROM article
WHERE id = 1;

-- selectionner
SELECT *
FROM article