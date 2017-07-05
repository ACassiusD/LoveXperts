-- Author: Geoffrey Veale
-- File name profession.sql
-- Date: 2015-10-08
-- Description: -- Creates the table for profession

DROP TABLE IF EXISTS profession;

CREATE TABLE profession(
    value SMALLINT PRIMARY KEY,
    property VARCHAR(100)
);

INSERT INTO profession(value, property)
VALUES (0, 'Prefer Not to say');

INSERT INTO profession(value, property)
VALUES (1, 'Student');

INSERT INTO profession(value, property)
VALUES (2, 'Legal');

INSERT INTO profession(value, property)
VALUES (4, 'IT');

INSERT INTO profession(value, property)
VALUES (8, 'Business ');

INSERT INTO profession(value, property)
VALUES (16, 'Medical');

INSERT INTO profession(value, property)
VALUES (32, 'Unemployed');

INSERT INTO profession(value, property)
VALUES (64, 'Sales');

INSERT INTO profession(value, property)
VALUES (128, 'Blue Collar');


