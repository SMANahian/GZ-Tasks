Run 
`composer require --dev phpunit/phpunit`

Add these to your .env file for password reset to work

```
host = 
email = 
password = 
port = 

app.baseURL = 
```

Add these to your .env file for database to work

```
database.default.hostname = localhost
database.default.database = database
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
database.default.DBPrefix =
database.default.port = 3306

database.tests.hostname = localhost
database.tests.database = ci4_test
database.tests.username = root
database.tests.password = 
database.tests.DBDriver = MySQLi
database.tests.DBPrefix =
database.tests.port = 3306

```

Run 

`php spark migrate`

And then 

`php spark serve`
