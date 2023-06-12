DROP SCHEMA IF EXISTS uzletlanc;
CREATE SCHEMA uzletlanc;
USE uzletlanc;

CREATE TABLE feltolto(

	id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nev nvarchar(25),
    fizetes int
);

CREATE TABLE bolt(

	id int PRIMARY KEY,
    cim nvarchar(25),
    terulet int,
    feltoltoid int,
    FOREIGN KEY(feltoltoid) REFERENCES feltolto(id)
);

CREATE TABLE elado(

	id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nev nvarchar(25),
    fizetes int,
    boltid int,
    eletkor int,
    FOREIGN KEY(boltid) REFERENCES bolt(id)
);

INSERT INTO feltolto VALUES (1,'Nagy Dénes',255000);
INSERT INTO feltolto VALUES (2,'Nagy Erika',255000);
INSERT INTO feltolto VALUES (3,'Kiss János',200000);

INSERT INTO bolt VALUES (1,'Kő utca 3',200,1);
INSERT INTO bolt VALUES (2,'Fa út 4/B',150,2);
INSERT INTO bolt VALUES (3,'Fa út 224',300,1);
INSERT INTO bolt VALUES (4,'Nagy tér 1',125,3);

INSERT INTO elado (id,nev,fizetes,boltid) VALUES (1,'Kiss Anna',300000,1);
INSERT INTO elado (id,nev,fizetes,boltid) VALUES (2,'Nagy Cecil',370000,1);
INSERT INTO elado (id,nev,fizetes,boltid) VALUES (3,'Közepes Béla',350000,2);

SELECT elado.nev as Eladó, bolt.cim, bolt.terulet, feltolto.nev as Árufeltöltő
FROM elado RIGHT JOIN bolt ON boltid = bolt.id
JOIN feltolto ON feltoltoid = feltolto.id
ORDER BY bolt.id;

SELECT feltolto.fizetes as Fizetés, feltolto.nev as Árufeltöltő, SUM(bolt.terulet) as Területösszeg, COUNT(bolt.id) as Boltszám
FROM bolt JOIN feltolto ON feltoltoid = feltolto.id
GROUP BY Fizetés, Árufeltöltő
ORDER BY bolt.id;