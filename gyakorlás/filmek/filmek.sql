DROP SCHEMA IF EXISTS filmek;
CREATE SCHEMA filmek;
USE filmek;

CREATE TABLE színész (

	id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nev nvarchar(20)
);

CREATE TABLE film (

	id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    cím nvarchar(35),
    színészid int REFERENCES színész(id)
);

INSERT INTO színész (id, nev) VALUES (1,'George Clooney');
INSERT INTO színész (nev) VALUES ('Graham Chaoman');
INSERT INTO színész (nev) VALUES ('Selena Gomez');
INSERT INTO színész (nev) VALUES ('Sandra Bullock');

INSERT INTO film (cím, színészid) VALUES ('Gravity', 1);
INSERT INTO film (cím, színészid) VALUES ('The Ides of March',1);
INSERT INTO film (cím, színészid) VALUES ('Vészhelyzet',1);
INSERT INTO film (cím, színészid) VALUES ('Monty Python and the Holy Grail',2);
INSERT INTO film (cím, színészid) VALUES ('Hotel Transylvania',3);
INSERT INTO film (cím, színészid) VALUES ('Gravity',4);
INSERT INTO film (cím, színészid) VALUES ('Miss Congeniality',4);
INSERT INTO film (cím, színészid) VALUES ('The Proposal',4);

SELECT sz.nev as Színész, f.cím as Film
FROM színész sz JOIN film f ON sz.id = színészid;