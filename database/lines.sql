CREATE DATABASE sledilniktelovadbe;

CREATE TABLE uporabnik(
	ID int NOT NULL AUTO_INCREMENT,
	ime varchar(16) NOT NULL,
	geslo varchar(65) NOT NULL,
	email varchar(20) NOT NULL,
	datRegistracije DATE NOT NULL,
	rojstnIDan DATE,
	visina double(5,1),
	teza double(5,1)
	CONSTRAINT PK_uporabniki PRIMARY KEY (ID)
);

CREATE TABLE misicnaSkupina(
	ID int,
	naziv varchar(25),
	PRIMARY KEY (ID)
);

CREATE TABLE nazivVaje(
	ID int,
	misicnaSkupinaID int,
	naziv varchar(25),
	PRIMARY KEY (ID),
	FOREIGN KEY (misicnaSkupinaID) REFERENCES misicnaSkupina(ID)
);

CREATE TABLE trening(
	ID int AUTO_INCREMENT,
	uporabnikID int,
	naziv varchar(25),
	datum DATE,
	PRIMARY KEY (ID),
	FOREIGN KEY (uporabnikID) REFERENCES uporabnik(ID)
);

CREATE TABLE vaja(
	ID int AUTO_INCREMENT,
	treningID int,
	nazivVajeID int,
	sets int(5),
	reps int(10),
	volumen int(12),
	PRIMARY KEY (ID),
	FOREIGN KEY (treningID) REFERENCES trening(ID),
	FOREIGN KEY (nazivVajeID) REFERENCES nazivVaje(ID)
);