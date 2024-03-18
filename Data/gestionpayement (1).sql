-- Création de la base de données
CREATE DATABASE gestionpayement;
GO

USE gestionpayement;
GO

-- Création de la table `etudiant`
CREATE TABLE etudiant (
    id INT NOT NULL PRIMARY KEY,
    matricule VARCHAR(50) NULL,
    noms VARCHAR(150) NOT NULL,
    genre VARCHAR(10) NOT NULL,
    lieu VARCHAR(50) NOT NULL,
    datenaissance DATE NOT NULL,
    adresse VARCHAR(100) NOT NULL
);

-- Insertion de données dans la table `etudiant`
INSERT INTO etudiant (id, matricule, noms, genre, lieu, datenaissance, adresse) VALUES
(1, '001et', 'Achille blond', 'M', 'Goma', '2024-03-04', 'Les volcans');

-- Création de la table `fixation_frais`
CREATE TABLE fixation_frais (
    id INT NOT NULL PRIMARY KEY,
    idOpt INT NULL,
    idProm INT NULL,
    montant FLOAT NULL,
    annee VARCHAR(10) NOT NULL
);

-- Création de la table `frais`
CREATE TABLE frais (
    id INT NOT NULL PRIMARY KEY,
    designation VARCHAR(200) NOT NULL,
    idFix INT NULL
);

-- Création de la table `inscription`
CREATE TABLE inscription (
    id INT NOT NULL PRIMARY KEY,
    idOpt INT NULL,
    idProm INT NULL,
    idEt INT NULL,
    annee VARCHAR(10) NOT NULL
);

-- Création de la table `options`
CREATE TABLE options (
    id INT NOT NULL PRIMARY KEY,
    idEt INT NULL,
    desoption VARCHAR(100) NOT NULL
);

-- Création de la table `promotion`
CREATE TABLE promotion (
    id INT NOT NULL PRIMARY KEY,
    idEt INT NULL,
    despromotion VARCHAR(100) NOT NULL
);

-- Ajout de contraintes et d'index
ALTER TABLE etudiant ADD CONSTRAINT matricule_unique UNIQUE (matricule);

ALTER TABLE fixation_frais ADD CONSTRAINT fa FOREIGN KEY (idOpt) REFERENCES options (id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE fixation_frais ADD CONSTRAINT fq FOREIGN KEY (idProm) REFERENCES promotion (id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE frais ADD CONSTRAINT fz FOREIGN KEY (idFix) REFERENCES fixation_frais (id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE inscription ADD CONSTRAINT fd FOREIGN KEY (idEt) REFERENCES etudiant (id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE inscription ADD CONSTRAINT fh FOREIGN KEY (idOpt) REFERENCES options (id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE inscription ADD CONSTRAINT fj FOREIGN KEY (idProm) REFERENCES promotion (id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE options ADD CONSTRAINT ft FOREIGN KEY (idEt) REFERENCES etudiant (id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE promotion ADD CONSTRAINT fk FOREIGN KEY (idEt) REFERENCES etudiant (id) ON DELETE CASCADE ON UPDATE CASCADE;
