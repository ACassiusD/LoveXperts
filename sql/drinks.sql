-- Author: Geoffrey Veale
-- File name drinks.sql
-- Date: 2015-10-08
-- Description: -- Creates the table for drinks

DROP TABLE IF EXISTS drinks;

CREATE TABLE drinks(
    value SMALLINT PRIMARY KEY,
    property VARCHAR(100)
);

INSERT INTO drinks(value, property)
VALUES (0, 'Prefer Not to say');

INSERT INTO drinks(value, property)
VALUES (1, 'Never');

INSERT INTO drinks(value, property)
VALUES (2, 'Rarely');

INSERT INTO drinks(value, property)
VALUES (4, 'Socially');

INSERT INTO drinks(value, property)
VALUES (8, 'Usually');

INSERT INTO drinks(value, property)
VALUES (16, 'I may have a problem..');
