# Restaurant Orders Management Restful API

This project is a web application designed to help manage restaurant orders and streamline the ordering process. The application allows restaurant staff to create and manage menu items, view and fulfill orders, and track customer feedback and reviews. Additionally, customers can use the application to place and track their orders, as well as leave feedback and ratings for menu items and overall restaurant experience.

The application is intended for restaurant owners and staff who are looking to improve their order management process and provide a better experience for their customers. It was built using Laravel, a popular PHP web framework, and utilizes various technologies and tools to provide a seamless and intuitive user experience.

## Features

* Authentication: Users can register, log in, and log out of the application using the provided authentication routes.
* Categories: The application provides RESTful resource routes for managing categories, including creating, reading, updating, and deleting categories.
* Menu items: The application provides RESTful resource routes for managing menu items, including creating, reading, updating, and deleting menu items.
* Menu item images: The application provides RESTful resource routes for managing menu item images, including creating, reading, updating, and deleting menu item images.
* Offers: The application provides RESTful resource routes for managing offers, including creating, reading, updating, and deleting offers.
* Roles: The application provides RESTful resource routes for managing roles, which can be used to restrict access to certain routes or actions.
* Posts: The application provides RESTful resource routes for managing posts, including creating, reading, updating, and deleting posts.
* Reviews: The application provides RESTful resource routes for managing reviews, which can be used to allow users to rate and review menu items or other aspects of the application.
* Orders: The application provides RESTful resource routes for managing orders, including creating, reading, updating, and deleting orders.
* Comments: The application provides RESTful resource routes for managing comments, which can be usedto allow users to leave feedback or comments on various aspects of the application.
* Soft-deleted menu items: The application provides routes for retrieving, restoring, and permanently deleting soft-deleted menu items, which can be useful for managing deleted data.
* Middleware protection: The application uses Laravel middleware to protect certain routes and actions, such as requiring authentication for accessing certain resources, or requiring users to have the "admin" role to access certain routes.

## Prerequisites

* Before running this application, you need to have the following installed on your machine:
* PHP 7.3 or higher
* MySQL or any other database system
* Composer
* PHP 7.3 or higher
* MySQL or any other database system

## Run Locally

Clone the repository to your local machine using the following command:
```shell
git clone https://github.com/hossamsoliuman/restaurant-orders-management.git
cd restaurant-orders-management
```

Generate .envfile
```shell
cp .env.example .env
```

Then, configure the .env file according to your use case.\Install the dependencies and then compile the assets
```shell
composer install
npm install
npm run dev
```

Populate the tables to the database.
Create a new database for the project and run migration to create the necessary tables:
```shell
php artisan migrate
```

Optional: Seed data to the database
```shell
php aritsan db:seed
```

Generate app key
```shell
php artisan key:generate
```

Run the application
```shell
php artisan serve
```

Access the application in your web browser at http://localhost:8000.

## Documentation

Check out the documentation at https://documenter.getpostman.com/view/26153121/2s93m63NRu
## User Logins

- Admin login: email: admin@gmail.com, password: admin@gmail.com.
- User: email: user@gmail.com, password: user@gmail.com.

## Note

I developed this project out of my head, not on YouTube