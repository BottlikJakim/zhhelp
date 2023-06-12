DROP SCHEMA IF EXISTS kiskedvenc;
CREATE SCHEMA kiskedvenc;
USE kiskedvenc;

CREATE TABLE animal (

	id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    faj nvarchar(15)
);

CREATE TABLE feed (

	id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    eledel nvarchar(15)
);

CREATE TABLE pet (

	id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nev nvarchar(15),
    fajid int REFERENCES animal(id)
);

CREATE TABLE kedvence (

	petid int REFERENCES pet(id),
    feedid int REFERENCES feed(id)
);

INSERT INTO animal (faj) VALUES ('kutya');
INSERT INTO animal (faj) VALUES ('macska');

INSERT INTO feed (eledel) VALUES ('velős csont');
INSERT INTO feed (eledel) VALUES ('húsleves');
INSERT INTO feed (eledel) VALUES ('almás pite');

INSERT INTO pet (nev, fajid) VALUES ('Blöki',1);
INSERT INTO pet (nev, fajid) VALUES ('Mirci',2);
INSERT INTO pet (nev, fajid) VALUES ('Zokni',1);

INSERT INTO kedvence VALUES (1,1);
INSERT INTO kedvence VALUES (1,2);
INSERT INTO kedvence VALUES (2,2);
INSERT INTO kedvence VALUES (3,1);
INSERT INTO kedvence VALUES (3,3);

SELECT pet.nev as Neve, animal.faj as Faja, feed.eledel as Kedvenc_ételei
FROM pet join animal on fajid = animal.id join kedvence on petid = pet.id join feed on feedid = feed.id;

SELECT feed.eledel as Ételek, count(animal.faj)
FROM pet join animal on fajid = animal.id join kedvence on petid = pet.id right join feed on feedid = feed.id
WHERE animal.faj = 'kutya'
GROUP BY feed.eledel;
