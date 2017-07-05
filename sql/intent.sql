-- Author: Geoffrey Veale
-- File name intent.sql
-- Date: 2015-10-08
-- Description: -- Creates the table for intent

DROP TABLE IF EXISTS intent;

CREATE TABLE intent(
    value SMALLINT PRIMARY KEY,
    property VARCHAR(100)
);

INSERT INTO intent(value, property)
VALUES (0, 'Prefer Not to say');

INSERT INTO intent(value, property)
VALUES (1, 'Casual Dating');

INSERT INTO intent(value, property)
VALUES (2, 'Relationships');

INSERT INTO intent(value, property)
VALUES (4, 'Putting in serious effort to find someone');

INSERT INTO intent(value, property)
VALUES (8, 'wanting to find someone to marry');



