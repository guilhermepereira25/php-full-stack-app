## Instructions to build the application using docker 

**Please, certified that you have docker compose installed**

In the root folder run this command

<code> docker compose up --build nginx -d </code>

Now we have the docker images running 

The nginx is acessible and running on port 80

PHP-FPM not acessible running in port 9000

**MySQL** is running on localhost:3306

DB_USER = user <br>
DB_PASSWORD = user <br>

This has to be setup up in the .env in your backend folder

---

## Run the frontend

<code> npm start </code>

Run the application on localhost:3000, you can know more about it in README.MD file in the frontend folder

**Remember to run the frontend you have to install nodejs**

---

## Install composer dependecies

Composer is running in the docker image

To install the dependecies in composer.json file you need to

<code> docker compose run composer install </code>

Now, you are free to go