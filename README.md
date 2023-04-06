## Instructions to Build and Run the Application Using Docker

To build and run the application using Docker, please follow the steps below:

### Prerequisites
Docker and Docker Compose should be installed on your machine.

### Build and Run the Application
1. Open your terminal and navigate to the root folder of the application.

2. Run the following command to build and run the Docker images:

<code> docker compose up --build nginx -d </code>

This command will build and run the Docker images and start the containers in the background.

3. Verify that the Nginx web server is accessible by visiting http://localhost in your browser. If you see the Nginx welcome page, it means that the server is up and running.

4. Verify that the PHP-FPM is running on port 9000 by visiting http://localhost:9000 in your browser. If you see a blank page or an error message, it means that the PHP-FPM is running properly.

5. The MySQL database is running on localhost:3306. The database credentials are:

```
	DB_USER = user <br>
	DB_PASSWORD = user <br>
```

You can modify these credentials in the `.env` file located in the backend folder.

6. Run the frontend of the application using the following command in the terminal:

```
	npm start
```


This command will start the frontend on http://localhost:3000.

7. Install composer dependencies by running the following command in the terminal:

```
	docker compose run composer install
```

This command will install the dependencies listed in the `composer.json` file.

You can now start using the application.