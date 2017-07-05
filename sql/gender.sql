-- Author: Geoffrey Veale
-- File name gender.sql
-- Date: 2015-10-08
-- Description: -- Creates the table for gender

DROP TABLE IF EXISTS gender;

CREATE TABLE gender(
    value SMALLINT PRIMARY KEY,
    property VARCHAR(100)
);

INSERT INTO gender(value, property)
VALUES (0, 'Male');

INSERT INTO gender(value, property)
VALUES (1, 'Female');

