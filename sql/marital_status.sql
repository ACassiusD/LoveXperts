-- Author: Geoffrey Veale
-- File name marital_status.sql
-- Date: 2015-10-08
-- Description: -- Creates the table for marital_status

DROP TABLE IF EXISTS marital_status;

CREATE TABLE marital_status(
    value SMALLINT PRIMARY KEY,
    property VARCHAR(100)
);

INSERT INTO marital_status(value, property)
VALUES (0, 'Prefer Not to say');

INSERT INTO marital_status(value, property)
VALUES (1, 'Single');

INSERT INTO marital_status(value, property)
VALUES (2, 'Married');

INSERT INTO marital_status(value, property)
VALUES (4, 'Widowed');

INSERT INTO marital_status(value, property)
VALUES (8, 'Living together');

INSERT INTO marital_status(value, property)
VALUES (16, 'Divorced');

INSERT INTO marital_status(value, property)
VALUES (32, 'Not Single/Not Looking');
