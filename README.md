# Modification Required
## Create a Database
### 1. Create a database with any name of your choice and add that name in `/includes/config.php` with your mysql `host name`, `user name` and `password`
### 2. Add 3 tables by using the following queries
```sql
    CREATE TABLE users (
    user_id INTEGER auto_increment PRIMARY KEY,
    first_name varchar(50) NOT NULL,
    last_name varchar(50) NOT NULL,
    email varchar(50) NOT NULL,
    password varchar(250) NOT NULL
    );
    CREATE TABLE roles (
    role_id INTEGER auto_increment PRIMARY KEY,
    name varchar(50) NOT NULL
    );
    CREATE TABLE user_role (
    user_id INTEGER,
    role_id INTEGER,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (role_id) REFERENCES roles(role_id) ON DELETE CASCADE,
    CONSTRAINT pk_user_role PRIMARY KEY (user_id,role_id)
    );
```
### 3. You are all set!