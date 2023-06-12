DROP SCHEMA IF EXISTS kollega;
CREATE SCHEMA kollega;
USE kollega;

CREATE TABLE szoba (

	id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    szam nchar(5) NOT NULL
);

CREATE TABLE tel (

	id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    num int NOT NULL
);

CREATE TABLE colleague (

	id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nev nvarchar(20) NOT NULL,
    szobaid int REFERENCES szoba(id),
    telefonid int REFERENCES tel(id)
);

INSERT INTO szoba (szam) VALUES ('QB226');
INSERT INTO szoba (szam) VALUES ('QB207');

INSERT INTO tel (num) VALUES (3702);
INSERT INTO tel (num) VALUES (2870);
INSERT INTO tel (num) VALUES (2884);

INSERT INTO colleague (nev, szobaid, telefonid) VALUES ('Csorba Kristóf',1,1);
INSERT INTO colleague (nev, szobaid, telefonid) VALUES ('Ekler Péter',1,1);
INSERT INTO colleague (nev, szobaid, telefonid) VALUES ('Almási Nóra',2,2);
INSERT INTO colleague (nev, szobaid, telefonid) VALUES ('Táborszki Anna',2,3);

SELECT c.nev as Kolléga, t.num as Mellék, sz.szam as Szoba
FROM colleague c JOIN szoba sz ON c.szobaid = sz.id
JOIN tel t ON c.telefonid = t.id;

filmSELECT c.nev as Kolléga,  t.num as Telefon
FROM colleague c JOIN szoba sz ON c.szobaid = sz.id JOIN tel t ON c.telefonid = t.id
WHERE sz.szam = 'QB226';