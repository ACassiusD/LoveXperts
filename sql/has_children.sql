-- Author: Geoffrey Veale
-- File name has_children.sql
-- Date: 2015-10-08
-- Description: -- Creates the table for has_children

DROP TABLE IF EXISTS has_children;

CREATE TABLE has_children(
    value SMALLINT PRIMARY KEY,
    property VARCHAR(100)
);

INSERT INTO has_children(value, property)
VALUES (0, 'Prefer Not to say');

INSERT INTO has_children(value, property)
VALUES (1, 'No');

INSERT INTO has_children(value, property)
VALUES (2, 'Yes');

INSERT INTO has_children(value, property)
VALUES (4, 'Yes and Looking for more');