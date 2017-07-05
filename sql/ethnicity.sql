-- Author: Geoffrey Veale
-- File name ethnicity.sql
-- Date: 2015-10-08
-- Description: -- Creates the table for ethnicity

DROP TABLE IF EXISTS ethnicity;

CREATE TABLE ethnicity(
    value SMALLINT PRIMARY KEY,
    property VARCHAR(100)
);

INSERT INTO ethnicity(value, property)
VALUES (0, 'Prefer Not to say');

INSERT INTO ethnicity(value, property)
VALUES (1, 'Caucasian');

INSERT INTO ethnicity(value, property)
VALUES (2, 'Black');

INSERT INTO ethnicity(value, property)
VALUES (4, 'Hispanic');

INSERT INTO ethnicity(value, property)
VALUES (8, 'Indian');

INSERT INTO ethnicity(value, property)
VALUES (16, 'Middle Eastern');

INSERT INTO ethnicity(value, property)
VALUES (32, 'Native American');

INSERT INTO ethnicity(value, property)
VALUES (64, 'Asian');

INSERT INTO ethnicity(value, property)
VALUES (128, 'Mixed Race');

INSERT INTO ethnicity(value, property)
VALUES (256, 'Borg');

