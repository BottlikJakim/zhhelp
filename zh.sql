DROP SCHEMA if exists allatkert;
CREATE SCHEMA allatkert;
USE allatkert;

CREATE TABLE allat (

	id int PRIMARY KEY,
    nev nvarchar(20),
    faj nvarchar(20)
);

CREATE TABLE gondozo (

	id int PRIMARY KEY,
    nev nvarchar(20),
    eletkor int
);

CREATE TABLE gondozza (

	allatid int,
    gondozoid int,
    PRIMARY KEY (allatid, gondozoid),
    FOREIGN KEY (allatid) REFERENCES allat(id),
    FOREIGN KEY (gondozoid) REFERENCES gondozo(id)
);

INSERT INTO allat VALUES (1, 'Meng', 'panda');
INSERT INTO allat VALUES (2, 'Glória', 'víziló');
INSERT INTO allat VALUES (3, 'Bálint', 'víziló');
INSERT INTO allat VALUES (4, 'Theo', 'zsiráf');

INSERT INTO gondozo VALUES (1, 'Kiss Anna', 28);
INSERT INTO gondozo VALUES (2, 'Közepes Béla', 42);
INSERT INTO gondozo VALUES (3, 'Nagy Cecil', 56);

INSERT INTO gondozza VALUES (1,1);
INSERT INTO gondozza VALUES (2,1);
INSERT INTO gondozza VALUES (3,2);
INSERT INTO gondozza VALUES (3,3);
INSERT INTO gondozza VALUES (4,1);

SELECT allat.nev, allat.faj, gondozo.nev
FROM allat join gondozza on allatid = allat.id
join gondozo on gondozoid = gondozo.id; 
