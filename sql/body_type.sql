-- Author: Geoffrey Veale
-- File name body_type.sql
-- Date: 2015-10-08
-- Description: -- Creates the table for bodyType

DROP TABLE IF EXISTS body_type;

CREATE TABLE body_type(
    value SMALLINT PRIMARY KEY,
    property VARCHAR(100)
);

INSERT INTO body_type(value, property)
VALUES (0, 'Prefer Not to say');

INSERT INTO body_type(value, property)
VALUES (1, 'Thin');

INSERT INTO body_type(value, property)
VALUES (2, 'Athletic');

INSERT INTO body_type(value, property)
VALUES (4, 'Average');

INSERT INTO body_type(value, property)
VALUES (8, 'Curvy');

INSERT INTO body_type(value, property)
VALUES (16, 'Big');

