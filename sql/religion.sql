-- Author: Geoffrey Veale
-- File name religion.sql
-- Date: 2015-10-08
-- Description: -- Creates the table for religion

DROP TABLE IF EXISTS religion;

CREATE TABLE religion(
    value SMALLINT PRIMARY KEY,
    property VARCHAR(100) 
);

INSERT INTO religion(value, property)
VALUES (0, 'Prefer Not to say');

INSERT INTO religion(value, property)
VALUES (1, 'Christian');

INSERT INTO religion(value, property)
VALUES (2, 'Buddism');

INSERT INTO religion(value, property)
VALUES (4, 'Muslim');

INSERT INTO religion(value, property)
VALUES (8, 'Jewish');

INSERT INTO religion(value, property)
VALUES (16, 'Voodoo');

INSERT INTO religion(value, property)
VALUES (32, 'Jediism');

INSERT INTO religion(value, property)
VALUES (64, 'Pastafarianism');

INSERT INTO religion(value, property)
VALUES (128, 'Scientology');

INSERT INTO religion(value, property)
VALUES (256, 'Atheist');
