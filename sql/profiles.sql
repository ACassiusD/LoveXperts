-- Author: Geoffrey Veale
-- File name profiles.sql
-- Date: 2015-10-08
-- Description: -- Creates the table for profiles

DROP TABLE IF EXISTS profiles;

CREATE TABLE profiles(
	user_id VARCHAR(20) NOT NULL,
	gender CHAR(1) NOT NULL,
	gender_sought CHAR(1) NOT NULL,
	age SMALLINT NOT NULL,
	city SMALLINT NOT NULL,
	intent SMALLINT NOT NULL,
	education SMALLINT NOT NULL,
	ethnicity SMALLINT NOT NULL,
	profession SMALLINT NOT NULL,
	has_children SMALLINT NOT NULL,
	body_type SMALLINT NOT NULL,
	drinks SMALLINT NOT NULL,
	religion SMALLINT NOT NULL,
	hair_colour SMALLINT NOT NULL,
	marital_status SMALLINT NOT NULL,
	headline VARCHAR(100) NOT NULL,
	self_description VARCHAR(1000) NOT NULL,
	match_description VARCHAR(1000) NOT NULL,
	images SMALLINT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    PRIMARY KEY (user_id)
);

