## Build Amazing Coffee Shop Management System with PHP MySQL Bootstrap PayPal and PDO
A simple Coffee Shop Management System with BOOKING TABLE,ORDERING COFFEE WITH PAYPAL AND PHP PDO AND MYSQL

🚀 Features

# ADMIN-PANEL

1)Manage Admin User
2)Adding Products 
3)Order list & Updating Status
4)Booking list & Updating Status

# Normal User 

1)Register User
2)Login User 
3)Booking Table
4) Cart Functionalities
5) Paypal Integration 
6) Feedback


🛠️ Tech Stack

    -PHP

    -MySQL (Database)

    -Bootstrap 

## Table Strucuture 

📘 bookings Table Structure

| Column Name  | Data Type      | Constraints                              | Description                               |
| ------------ | -------------- | ---------------------------------------- | ----------------------------------------- |
| `id`         | `int(11)`      | `NOT NULL`                               | Primary booking ID                        |
| `firstname`  | `varchar(50)`  | `NOT NULL`                               | First name of the customer                |
| `lastname`   | `varchar(50)`  | `NOT NULL`                               | Last name of the customer                 |
| `date`       | `date`         | `NOT NULL`                               | Booking date                              |
| `time`       | `time`         | `NOT NULL`                               | Booking time                              |
| `phone`      | `int(50)`      | `NOT NULL`                               | Customer phone number                     |
| `message`    | `varchar(255)` | `NOT NULL`                               | Message or note                           |
| `user_id`    | `int(11)`      | `NOT NULL`                               | Associated user ID (foreign key)          |
| `status`     | `varchar(25)`  | `NOT NULL` DEFAULT 'Pending'             | Booking status (e.g., Pending, Confirmed) |
| `created_at` | `timestamp`    | `NOT NULL` DEFAULT `current_timestamp()` | Record creation timestamp                 |

🛒 cart Table Structure

| Column Name   | Data Type      | Constraints                            | Description                            |
| ------------- | -------------- | -------------------------------------- | -------------------------------------- |
| `id`          | `int(11)`      | `NOT NULL`                             | Primary cart item ID                   |
| `product_id`  | `int(11)`      | `NOT NULL`                             | Associated product ID                  |
| `name`        | `varchar(50)`  | `NOT NULL`                             | Product name                           |
| `image`       | `varchar(60)`  | `NOT NULL`                             | Product image path or filename         |
| `description` | `varchar(255)` | `NOT NULL`                             | Product description                    |
| `price`       | `varchar(50)`  | `NOT NULL`                             | Product price                          |
| `quantity`    | `int(10)`      | `NOT NULL`                             | Quantity of the product                |
| `user_id`     | `int(11)`      | `NOT NULL`                             | Associated user ID (foreign key)       |
| `created_at`  | `text`         | `NOT NULL DEFAULT current_timestamp()` | Timestamp when the cart item was added |

☕ coffee-shop-admins Table Structure

| Column Name  | Data Type      | Constraints                            | Description                           |
| ------------ | -------------- | -------------------------------------- | ------------------------------------- |
| `id`         | `int(11)`      | `NOT NULL`                             | Unique admin ID                       |
| `name`       | `varchar(20)`  | `NOT NULL`                             | Admin name                            |
| `password`   | `varchar(255)` | `NOT NULL`                             | Admin password (hashed)               |
| `created_at` | `int(11)`      | `NOT NULL DEFAULT current_timestamp()` | Creation timestamp *(Incorrect type)* |

📦 orders Table Structure

| Column Name   | Data Type       | Constraints                             | Description                             |
| ------------- | --------------- | --------------------------------------- | --------------------------------------- |
| `id`          | `int(11)`       | `NOT NULL`                              | Unique order ID                         |
| `name`        | `varchar(50)`   | `NOT NULL`                              | Customer name                           |
| `country`     | `varchar(50)`   | `NOT NULL`                              | Country of delivery                     |
| `address`     | `varchar(100)`  | `NOT NULL`                              | Street address                          |
| `town`        | `varchar(80)`   | `NOT NULL`                              | Town/City                               |
| `zipcode`     | `varchar(20)`   | `NOT NULL`                              | ZIP or postal code                      |
| `phone`       | `varchar(20)`   | `NOT NULL`                              | Phone number                            |
| `email`       | `varchar(50)`   | `NOT NULL`                              | Email address                           |
| `total_price` | `decimal(11,2)` | `NOT NULL`                              | Total price of the order                |
| `user_id`     | `int(11)`       | `NOT NULL`                              | Associated user ID (foreign key)        |
| `status`      | `varchar(10)`   | `DEFAULT NULL`                          | Order status (e.g., Pending, Completed) |
| `created_at`  | `timestamp(6)`  | `NOT NULL DEFAULT current_timestamp(6)` | Timestamp with microsecond precision    |

🛍️ products Table Structure

| Column Name   | Data Type      | Constraints                            | Description                                 |
| ------------- | -------------- | -------------------------------------- | ------------------------------------------- |
| `id`          | `int(11)`      | `NOT NULL`                             | Unique product ID                           |
| `name`        | `varchar(255)` | `NOT NULL`                             | Product name                                |
| `image`       | `varchar(255)` | `NOT NULL`                             | Image filename or URL                       |
| `description` | `text`         | `NOT NULL`                             | Detailed product description                |
| `category`    | `varchar(20)`  | `NOT NULL`                             | Product category (e.g., Coffee, Tea)        |
| `price`       | `varchar(10)`  | `NOT NULL`                             | Product price *(should ideally be numeric)* |
| `created_at`  | `timestamp`    | `NOT NULL DEFAULT current_timestamp()` | Record creation timestamp                   |

⭐ reviews Table Structure

| Column Name  | Data Type      | Constraints                            | Description                          |
| ------------ | -------------- | -------------------------------------- | ------------------------------------ |
| `id`         | `int(11)`      | `NOT NULL`                             | Unique review ID                     |
| `review`     | `varchar(255)` | `NOT NULL`                             | Customer review content              |
| `username`   | `varchar(60)`  | `NOT NULL`                             | Name or handle of the reviewer       |
| `created_at` | `timestamp`    | `NOT NULL DEFAULT current_timestamp()` | Timestamp when the review was posted |

👤 users Table Structure

| Column Name  | Data Type      | Constraints                             | Description                |
| ------------ | -------------- | --------------------------------------- | -------------------------- |
| `id`         | `int(11)`      | `NOT NULL`                              | Unique user ID             |
| `username`   | `varchar(50)`  | `NOT NULL`                              | Username                   |
| `email`      | `varchar(50)`  | `NOT NULL`                              | User email                 |
| `password`   | `varchar(255)` | `NOT NULL`                              | User password (hashed)     |
| `created_at` | `timestamp(6)` | `NOT NULL DEFAULT current_timestamp(6)` | Account creation timestamp |


###  Installation Steps

## 1) Clone the repo

git clone https://github.com/WorldUma/coffee-blend

cd coffee-blend

## 2) 🗄️ Database Setup
Create the Database
First, make sure you have a MySQL or MariaDB server running. Then create a database coffee-blend

## 3)Using phpMyAdmin:

    Log in to phpMyAdmin.

    Select your database (coffee-blend).

    Go to the Import tab.and upload sql file which is in Database sql files folder

    Replace with your database credentials in config\config.php


### 🧪 PayPal Sandbox Setup and Token Generation 

1. Create Sandbox Accounts

    Go to PayPal Developer Dashboard.

    Log in with your main PayPal account.

    Navigate to Sandbox > Accounts.

    Create two accounts:

        Business (Merchant): to receive payments.

        Personal (Buyer): to test payment as a customer.

2. Create a PayPal App

    In the Dashboard, go to My Apps & Credentials.

    Under Sandbox, click Create App.

    Give it a name (e.g., TestApp) and select your business sandbox account.

    Once created, copy your:
   ### replace with your client_id and secret

        Client ID

        Client Secret

   Finally , Run the project after the setup
   http://localhost/coffee-blend/
