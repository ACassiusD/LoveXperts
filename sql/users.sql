-- Author: Geoffrey Veale
-- File name users.sql
-- Date: 2015-10-08
-- Description: -- Creates the table for users

DROP TABLE IF EXISTS users CASCADE;

-- A table to hold user information
CREATE TABLE users (
	user_id VARCHAR(20) PRIMARY KEY,
	password VARCHAR(35) NOT NULL,
	user_type CHAR(1) NOT NULL,
	email_address VARCHAR(256) NOT NULL,
	first_name VARCHAR(128) NOT NULL,
	last_name VARCHAR(128) NOT NULL,
	birth_date DATE NOT NULL,
	enroll_date DATE NOT NULL,
	last_access DATE NOT NULL
);

