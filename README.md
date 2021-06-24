# Configuration Before Using

## Creating a Database
### For Localhost
1. Create a database with the name `experteze` `/includes/config.php` with your mysql `host name`, `user name` and `password`
2. Import the database from `db/experteze.sql` file
3. You are all set! navigate to `http://localhost/YourFolderName/`

### For Custom Hosting
1. Create a database with the name of your choice
2. Navigate to `/includes/config.php` and change the values of the variable `host` to your hostname, `user` and `password` to your PhpMyAdmin username and password
3. Import the database from `db` directory to your PhpMyAdmin (Choose anyone from the below)
    1. Sample database - Has some pre-existing data for demo
    2. Empty database - Only Contains the structure of the database and Roles.
3. You are all set!

## Testing Credentials for Sample Database
### Patient
1. Patient P1
    email       : patient1@email.com
    password    : PATI2021
### Nurse
1. Nurse N1
    email       : nurse1@email.com
    password    : NURS2021
2. Nurse N2
    email       : nurse2@email.com
    password    : NURS2021
### Doctor
1. Doctor D1
    email       : doctor1@email.com
    password    : DOCT2021
2. Doctor D2
    email       : doctor2@email.com
    password    : DOCT2021
### Admin
1. Admin A1
    email       : admin1@email.com
    password    : Admin1
