-- Author: Alex Donnelly
-- File name interests.sql
-- Date: 2015-12-06
-- Description: -- Creates the table for interests

-- Note that our composite primary key should work since someone should not be able to report the same user twice

DROP TABLE IF EXISTS interests;

-- A table to hold user information
CREATE TABLE interests (
	interested_id VARCHAR(20) NOT NULL,
	interested_in_id VARCHAR(20) NOT NULL,
	PRIMARY KEY ( interested_id, interested_in_id),
	interest_time TIMESTAMP NOT NULL
);

