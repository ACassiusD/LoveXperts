-- Author: Geoffrey Veale
-- File name user_admin_populate.sql
-- Date: 2015-10-08
-- Description: -- Insert admin acounts 



-- NOTE: will have to drop users table and reset them up if script as already run  


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















