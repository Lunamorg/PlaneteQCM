CREATE TABLE Personnes (
  id varchar(10) NOT NULL,
  mdp varchar(20) NOT NULL,
  prenom varchar(45) NOT NULL,
  nom varchar(45) NOT NULL,
  tel varchar(15) NOT NULL,
  adresse varchar(45) NOT NULL,
  ville varchar(45) NOT NULL,
  email varchar(45) NOT NULL,
  PRIMARY KEY  (id)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
