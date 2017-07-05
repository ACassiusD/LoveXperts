-- Author: Geoffrey Veale
-- File name city.sql
-- Date: 2015-10-08
-- Description: -- Creates the table for city

DROP TABLE IF EXISTS city;

CREATE TABLE city(
    value SMALLINT PRIMARY KEY,
    property VARCHAR(100)
);

INSERT INTO city(value, property)
VALUES (0, 'Prefer Not to say');

INSERT INTO city(value, property)
VALUES (1, 'Oshawa');

INSERT INTO city(value, property)
VALUES (2, 'Whitby');

INSERT INTO city(value, property)
VALUES (4, 'Ajax');

INSERT INTO city(value, property)
VALUES (8, 'Pickering');

INSERT INTO city(value, property)
VALUES (16, 'Port Perry');

INSERT INTO city(value, property)
VALUES (32, 'Clarington');

INSERT INTO city(value, property)
VALUES (64, 'Other');