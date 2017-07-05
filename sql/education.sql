-- Author: Geoffrey Veale
-- File name education.sql
-- Date: 2015-10-08
-- Description: -- Creates the table for education

DROP TABLE IF EXISTS education;

CREATE TABLE education(
    value SMALLINT PRIMARY KEY,
    property VARCHAR(100)
);

INSERT INTO education(value, property)
VALUES (0, 'Prefer Not to say');

INSERT INTO education(value, property)
VALUES (1, 'High school');

INSERT INTO education(value, property)
VALUES (2, 'Some college');

INSERT INTO education(value, property)
VALUES (4, 'College');

INSERT INTO education(value, property)
VALUES (8, 'Some University');

INSERT INTO education(value, property)
VALUES (16, 'Associates Degree');

INSERT INTO education(value, property)
VALUES (32, 'Bachelors Degree');

INSERT INTO education(value, property)
VALUES (64, 'Masters Degree');





