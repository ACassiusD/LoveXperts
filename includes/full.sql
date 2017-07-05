--Full SQL Script for LoveXperts

drop table users cascade;
drop table profiles cascade;


--Body Type
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

--City
DROP TABLE IF EXISTS city;

CREATE TABLE city(
    value SMALLINT PRIMARY KEY,
    property VARCHAR(100)
);

INSERT INTO city(value, property)
VALUES (0, 'Prefer Not to say');

INSERT INTO city(value, property)
VALUES (1, 'Oshawa');

INSERT INTO city(value, property)
VALUES (2, 'Whitby');

INSERT INTO city(value, property)
VALUES (4, 'Ajax');

INSERT INTO city(value, property)
VALUES (8, 'Pickering');

INSERT INTO city(value, property)
VALUES (16, 'Port Perry');

INSERT INTO city(value, property)
VALUES (32, 'Clarington');

INSERT INTO city(value, property)
VALUES (64, 'Other');

--Drinks 
DROP TABLE IF EXISTS drinks;

CREATE TABLE drinks(
    value SMALLINT PRIMARY KEY,
    property VARCHAR(100)
);

INSERT INTO drinks(value, property)
VALUES (0, 'Prefer Not to say');

INSERT INTO drinks(value, property)
VALUES (1, 'Never');

INSERT INTO drinks(value, property)
VALUES (2, 'Rarely');

INSERT INTO drinks(value, property)
VALUES (4, 'Socially');

INSERT INTO drinks(value, property)
VALUES (8, 'Usually');

INSERT INTO drinks(value, property)
VALUES (16, 'I may have a problem..');

--Education 

DROP TABLE IF EXISTS education;

CREATE TABLE education(
    value SMALLINT PRIMARY KEY,
    property VARCHAR(100)
);

INSERT INTO education(value, property)
VALUES (0, 'Prefer Not to say');

INSERT INTO education(value, property)
VALUES (1, 'High school');

INSERT INTO education(value, property)
VALUES (2, 'Some college');

INSERT INTO education(value, property)
VALUES (4, 'College');

INSERT INTO education(value, property)
VALUES (8, 'Some University');

INSERT INTO education(value, property)
VALUES (16, 'Associates Degree');

INSERT INTO education(value, property)
VALUES (32, 'Bachelors Degree');

INSERT INTO education(value, property)
VALUES (64, 'Masters Degree');

--Ethnicity

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

--Gender

DROP TABLE IF EXISTS gender;

CREATE TABLE gender(
    value SMALLINT PRIMARY KEY,
    property VARCHAR(100)
);

INSERT INTO gender(value, property)
VALUES (0, 'Male');

INSERT INTO gender(value, property)
VALUES (1, 'Female');

--Gender Saught
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

--Hair Color 
DROP TABLE IF EXISTS hair_colour;

CREATE TABLE hair_colour(
    value SMALLINT PRIMARY KEY,
    property VARCHAR(100)
);

INSERT INTO hair_colour(value, property)
VALUES (0, 'Prefer Not to say');

INSERT INTO hair_colour(value, property)
VALUES (1, 'Black');

INSERT INTO hair_colour(value, property)
VALUES (2, 'Blond');

INSERT INTO hair_colour(value, property)
VALUES (4, 'Red');

INSERT INTO hair_colour(value, property)
VALUES (8, 'Grey');

INSERT INTO hair_colour(value, property)
VALUES (16, 'Bald');

INSERT INTO hair_colour(value, property)
VALUES (32, 'Mixed Coloured/Dyed');

--Children DROP TABLE IF EXISTS has_children;
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

--Intent
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

--Interests
DROP TABLE IF EXISTS interests;

CREATE TABLE interests (
	interested_id VARCHAR(20) NOT NULL,
	interested_in_id VARCHAR(20) NOT NULL,
	PRIMARY KEY ( interested_id, interested_in_id),
	interest_time TIMESTAMP NOT NULL
);

--Marital Status
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

--Offenses
DROP TABLE IF EXISTS offensives;

-- A table to hold user information
CREATE TABLE offensives (
	reporting_id VARCHAR(20) NOT NULL,
	offending_id VARCHAR(20) NOT NULL,
	PRIMARY KEY ( reporting_id, offending_id),
	status CHAR(1) NOT NULL,
	reporting_time TIMESTAMP NOT NULL
);

--Profession
DROP TABLE IF EXISTS profession;

CREATE TABLE profession(
    value SMALLINT PRIMARY KEY,
    property VARCHAR(100)
);

INSERT INTO profession(value, property)
VALUES (0, 'Prefer Not to say');

INSERT INTO profession(value, property)
VALUES (1, 'Student');

INSERT INTO profession(value, property)
VALUES (2, 'Legal');

INSERT INTO profession(value, property)
VALUES (4, 'IT');

INSERT INTO profession(value, property)
VALUES (8, 'Business ');

INSERT INTO profession(value, property)
VALUES (16, 'Medical');

INSERT INTO profession(value, property)
VALUES (32, 'Unemployed');

INSERT INTO profession(value, property)
VALUES (64, 'Sales');

INSERT INTO profession(value, property)
VALUES (128, 'Blue Collar');

--Religion
DROP TABLE IF EXISTS religion;

CREATE TABLE religion(
    value SMALLINT PRIMARY KEY,
    property VARCHAR(100) 
);

INSERT INTO religion(value, property)
VALUES (0, 'Prefer Not to say');

INSERT INTO religion(value, property)
VALUES (1, 'Christian');

INSERT INTO religion(value, property)
VALUES (2, 'Buddism');

INSERT INTO religion(value, property)
VALUES (4, 'Muslim');

INSERT INTO religion(value, property)
VALUES (8, 'Jewish');

INSERT INTO religion(value, property)
VALUES (16, 'Voodoo');

INSERT INTO religion(value, property)
VALUES (32, 'Jediism');

INSERT INTO religion(value, property)
VALUES (64, 'Pastafarianism');

INSERT INTO religion(value, property)
VALUES (128, 'Scientology');

INSERT INTO religion(value, property)
VALUES (256, 'Atheist');

--Users
DROP TABLE IF EXISTS users CASCADE;
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

--Profiles
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

--Populate admin accounts
INSERT INTO users(user_id,password,user_type,email_address, first_name,last_name,birth_date,enroll_date,last_access)
VALUES ('pufferd', MD5('password'),'i','pufferd@gmail.com','Darren','Puffer','1980-12-25','2015-09-29','2015-09-29');

INSERT INTO users(user_id,password,user_type,email_address, first_name,last_name,birth_date,enroll_date,last_access)
VALUES ('tester',MD5('password'),'a','admin@admin.com','Borgie','Mcborg','1995-08-06','2015-09-27','2015-09-27');

INSERT INTO profiles(user_id,gender,gender_sought,age,city,intent ,education ,ethnicity ,profession ,has_children ,body_type ,drinks ,religion ,hair_colour ,marital_status,headline,self_description,match_description,images)
VALUES ('tester', 0,1,56,4,8,64,256,32,0,0,16,64,4,0,'Im just a lonely borg','Hi, Im tester a very intelligent borg, but unemployed','I am looking for another borg',0);

INSERT INTO users(user_id,password,user_type,email_address, first_name,last_name,birth_date,enroll_date,last_access)
VALUES ('geoffro0',MD5('password'),'a','geoffro@admin.com','Geoff','Veale','1967-08-06','2015-09-27','2015-09-27');

INSERT INTO profiles(user_id,gender,gender_sought,age,city,intent ,education ,ethnicity ,profession ,has_children ,body_type ,drinks ,religion ,hair_colour ,marital_status,headline,self_description,match_description,images)
VALUES ('geoffro0', 0,1,21,1,0,2,1,1,2,0,4,2,2,2,'I am a developer of this site','Hi, I am working on this site :o','Im currently not looking for anyone',0);





