-- Author: Geoffrey Veale
-- File name: hair_colour.sql
-- Date: 2015-10-08
-- Description: -- Creates the table for hair_colour

DROP TABLE IF EXISTS hair_colour;

CREATE TABLE hair_colour(
    value SMALLINT PRIMARY KEY,
    property VARCHAR(100)
);

INSERT INTO hair_colour(value, property)
VALUES (0, 'Prefer Not to say');

INSERT INTO hair_colour(value, property)
VALUES (1, 'Black');

INSERT INTO hair_colour(value, property)
VALUES (2, 'Blond');

INSERT INTO hair_colour(value, property)
VALUES (4, 'Red');

INSERT INTO hair_colour(value, property)
VALUES (8, 'Grey');

INSERT INTO hair_colour(value, property)
VALUES (16, 'Bald');

INSERT INTO hair_colour(value, property)
VALUES (32, 'Mixed Coloured/Dyed');