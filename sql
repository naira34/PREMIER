CREATE DATABASE pfe;

CREATE TABLE personne (
  id_personne INT AUTO_INCREMENT PRIMARY KEY,
  nom_personne VARCHAR(50) NOT NULL,
  prenom VARCHAR(50) NOT NULL,
  email VARCHAR(100) NOT NULL,
  direction VARCHAR(100),
  departement VARCHAR(100),
  atelier VARCHAR(100),
  structure VARCHAR(100),
  fonction VARCHAR(100),
  username VARCHAR(50) NOT NULL,
  password VARCHAR(255) NOT NULL,
  role VARCHAR(20) NOT NULL
);
CREATE TABLE demandeinfo (
  id_demande INT AUTO_INCREMENT PRIMARY KEY,
  demandeur VARCHAR(100) NOT NULL,
  direction VARCHAR(100),
  departement VARCHAR(100),
  atelier VARCHAR(100) NOT NULL,
  titre VARCHAR(100) NOT NULL,
  document_ecrit VARCHAR(255) NOT NULL,
  document_cartographie VARCHAR(255) NOT NULL,
  raster VARCHAR(100),
  echelle VARCHAR(100) NOT NULL,
  date DATE NOT NULL,
  valide BOOLEAN NOT NULL DEFAULT 0,
  id_personne INT,
  FOREIGN KEY (id_personne) REFERENCES personne(id_personne)
);
