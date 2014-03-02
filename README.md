php-rest-api
============

A simple php rest api. Presented during "Vadå Web - Del 2: RESTen" 7 march 2014. Based on the [Slim PHP Microframework](http://www.slimframework.com/).

##Installation
Is somewhat manual, but keeps the repo clean and intuitive:

1. Create a database (with possible user)
2. Create a table named "books" with the following columns:
  * "id" - INT, primary key, auto incrementing
  * "title" - VARCHAR
  * "author" - VARCHAR
  * "year" - INT (to keep it simple)

Fill in your details in `database/config.php`.

##Usage
Use as data source for any HTTP-request capable client (JQuery, Angular, AndroidSDK, Curl, Postman, HTML form, plain javascript xmlhttp request).
