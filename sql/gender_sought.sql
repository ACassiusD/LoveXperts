-- Author: Geoffrey Veale
-- File name gender_sought.sql
-- Date: 2015-10-08
-- Description: -- Creates the table for gender_sought

DROP TABLE IF EXISTS gender_sought;

CREATE TABLE gender_sought(
    value SMALLINT PRIMARY KEY,
    property VARCHAR(100)
);

INSERT INTO gender_sought(value, property)
VALUES (0, 'Male');

INSERT INTO gender_sought(value, property)
VALUES (1, 'Female');

INSERT INTO gender_sought(value, property)
VALUES (2, 'Both');
