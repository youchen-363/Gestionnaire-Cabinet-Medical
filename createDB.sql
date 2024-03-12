-- Création de la base de données
CREATE DATABASE IF NOT EXISTS cabinet;

-- Sélection de la base de données nouvellement créée
USE cabinet;

-- Création de la table médecin
CREATE TABLE Medecin(
   idMedecin INT auto_increment,
   civilite VARCHAR(5),
   nom VARCHAR(50),
   prenom VARCHAR(50),
   PRIMARY KEY(idMedecin)
);

-- création de la table usager
CREATE TABLE Usager(
   idUsager INT auto_increment,
   civilite VARCHAR(5),
   numSecu CHAR(13),
   nom VARCHAR(50),
   prenom VARCHAR(50),
   adresse VARCHAR(50),
   cp CHAR(5),
   cpNaissance CHAR(5),
   ville VARCHAR(50),
   dateNaissance DATE,
   villeNaissance VARCHAR(50),
   idMedecin INT,
   PRIMARY KEY(idUsager),
   FOREIGN KEY(idMedecin) REFERENCES Medecin(idMedecin)
);

-- création de la table consulter
CREATE TABLE Consulter(
   idMedecin INT,
   DateHeure datetime,
   Duree int,
   idUsager INT NOT NULL,
   PRIMARY KEY(idMedecin, DateHeure),
   FOREIGN KEY(idMedecin) REFERENCES Medecin(idMedecin),
   FOREIGN KEY(idUsager) REFERENCES Usager(idUsager)
);-- Création de la base de données
CREATE DATABASE IF NOT EXISTS cabinet;

-- Sélection de la base de données nouvellement créée
USE cabinet;

-- Création de la table médecin
CREATE TABLE Medecin(
   idMedecin INT auto_increment,
   civilite VARCHAR(5),
   nom VARCHAR(50),
   prenom VARCHAR(50),
   PRIMARY KEY(idMedecin)
);

-- création de la table usager
CREATE TABLE Usager(
   idUsager INT auto_increment,
   civilite VARCHAR(5),
   numSecu CHAR(13),
   nom VARCHAR(50),
   prenom VARCHAR(50),
   adresse VARCHAR(50),
   cp CHAR(5),
   cpNaissance CHAR(5),
   ville VARCHAR(50),
   dateNaissance DATE,
   villeNaissance VARCHAR(50),
   idMedecin INT,
   PRIMARY KEY(idUsager),
   FOREIGN KEY(idMedecin) REFERENCES Medecin(idMedecin)
);

-- création de la table consulter
CREATE TABLE Consulter(
   idMedecin INT,
   DateHeure datetime,
   Duree int,
   idUsager INT NOT NULL,
   PRIMARY KEY(idMedecin, DateHeure),
   FOREIGN KEY(idMedecin) REFERENCES Medecin(idMedecin),
   FOREIGN KEY(idUsager) REFERENCES Usager(idUsager)
);