# Modification Required

## Create a Database

1. Create a database with any name of your choice and add that name in `/includes/config.php` with your mysql `host name`, `user name` and `password`
2. Add 3 tables by using the following queries

```sql
    -- creating tables
CREATE TABLE users (
  user_id INTEGER auto_increment PRIMARY KEY,
  first_name varchar(50) NOT NULL,
  last_name varchar(50) NOT NULL,
  email varchar(50) NOT NULL,
  password varchar(250) NOT NULL
);
CREATE TABLE roles (
  role_id INTEGER auto_increment PRIMARY KEY,
  role_name varchar(50) NOT NULL
);
CREATE TABLE user_role (
  user_id INTEGER,
  role_id INTEGER,
  FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (role_id) REFERENCES roles(role_id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT pk_user_role PRIMARY KEY (user_id,role_id)
);
CREATE TABLE user_added_by (
  nurse_id INTEGER,
  user_id INTEGER,
  FOREIGN KEY (nurse_id) REFERENCES users(user_id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT pk_user_added_by PRIMARY KEY (user_id,nurse_id)
);
create table user_symptoms(
  user_id INTEGER,
  has_fever boolean default false,
  has_trouble_breathing boolean default false,
  has_cough boolean default false,
  has_nosal_congest_running boolean default false,
  has_sense boolean default false,
  has_sore_throat boolean default false,
  had_contact_with_positive boolean default false,
  is_positive boolean default false,
  has_travelled boolean default false,
  felt_tired boolean default false,
  have_nausea_diarrhea boolean default false,
  has_chills boolean default false,
  has_told_quarantine boolean default false,
  date_added TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT pk_user_symptoms PRIMARY KEY (user_id,date_added)
);
create table user_details(
  user_id INTEGER,
  aadhaar_no BIGINT,
  mobile INTEGER,
  address VARCHAR(250),
  date_of_birth DATE,
  gender INTEGER,
  FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT pk_user_details PRIMARY KEY (user_id)
);

--Describe the tables
DESCRIBE users;
DESCRIBE roles;
DESCRIBE user_role;

--Show data of all the tables
SELECT * FROM users;
SELECT * FROM roles;
SELECT * FROM user_role;

--Delete the tables
DROP TABLE user_role;
DROP TABLE users;
DROP TABLE roles;

--Insert VALUES (Sample data to insert)
INSERT INTO users VALUES (1, 'ABC', 'XYZ', 'abc@email.com', 'pass');
INSERT INTO roles(role_name) VALUES ('Patient'),('Nurse'),('Doctor'),('Admin');
INSERT INTO user_role VALUES (LAST_INSERT_ID(), 1);
INSERT INTO user_symptoms(user_id, has_fever, has_cough, has_sense) VALUES (1, true, true, true);
INSERT INTO user_symptoms(user_id, has_trouble_breathing, has_chills, have_nausea_diarrhea) VALUES (1, true, true, true);
INSERT into user_details values (1, 123456789012, 0123456789, '5th Street, CA, USA', STR_TO_DATE('2020-09-14', '%Y-%m-%d'), 1);
```

3. You are all set!
