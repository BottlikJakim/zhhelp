DROP SCHEMA IF EXISTS uzletlanc2;
CREATE SCHEMA uzletlanc2;
USE uzletlanc2;

CREATE TABLE elado (

	id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nev nvarchar(20),
    fizetes int,
    kor int,
    boltid int REFERENCES kisbolt(id)
);

CREATE TABLE feltolto (

	id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nev nvarchar(20),
    fizetes int
);

CREATE TABLE kisbolt (

	id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    feltoltoid int REFERENCES feltolto(id),
    terulet int,
    cim nvarchar(30)
);

INSERT INTO feltolto (nev, fizetes) VALUES ('Nagy Dénes',255000);
INSERT INTO feltolto (nev, fizetes) VALUES ('Nagy Erika',255000);
INSERT INTO feltolto (nev, fizetes) VALUES ('Kiss János',200000);

INSERT INTO kisbolt (feltoltoid, terulet, cim) VALUES (1,200,'Kő utca 3');
INSERT INTO kisbolt (feltoltoid, terulet, cim) VALUES (2,150,'Fa út 4/B');
INSERT INTO kisbolt (feltoltoid, terulet, cim) VALUES (1,300,'Fa út 224');
INSERT INTO kisbolt (feltoltoid, terulet, cim) VALUES (3,125,'Nagy tér 1');

INSERT INTO elado (nev, fizetes, boltid) VALUES ('Kiss Anna',300000,1);
INSERT INTO elado (nev, fizetes, boltid) VALUES ('Nagy Cecil',370000,1);
INSERT INTO elado (nev, fizetes, boltid) VALUES ('Közepes Béla',350000,2);

SELECT f.nev as Árufeltöltő, count(k.id) as Boltszám, sum(k.terulet) as Terület
FROM feltolto f LEFT JOIN kisbolt k on feltoltoid = f.id
WHERE f.fizetes >= 100000
GROUP BY Árufeltöltő
ORDER BY Árufeltöltő asc;