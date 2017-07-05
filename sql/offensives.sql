-- Author: Alex Donnelly
-- File name offensives.sql
-- Date: 2015-12-06
-- Description: -- Creates the table for offensives

-- Note that our composite primary key should work since someone should not be able to report the same user twice

DROP TABLE IF EXISTS offensives;

-- A table to hold user information
CREATE TABLE offensives (
	reporting_id VARCHAR(20) NOT NULL,
	offending_id VARCHAR(20) NOT NULL,
	PRIMARY KEY ( reporting_id, offending_id),
	status CHAR(1) NOT NULL,
	reporting_time TIMESTAMP NOT NULL
);

