# Kareem Online Store

A simple online shopping website built with PHP and MySQL. It supports product browsing by category, a shopping cart, user accounts, and product management pages.

## Requirements

- Windows with [XAMPP](https://www.apachefriends.org/)
- PHP 8.2 or newer with the `mysqli` extension
- MySQL or MariaDB
- A web browser

## Run locally with XAMPP

1. Start **MySQL** from the XAMPP Control Panel. You do not need to move this project into `htdocs` when using PHP's built-in development server.
2. Open phpMyAdmin and create a database named `ka` if it does not already exist.
3. Select the `ka` database, choose **Import**, and import `ka.sql`.
4. Check the database connection settings in `config.php`. The current settings use `127.0.0.1:3307`, user `root`, and a blank password. Update them to match your local MySQL configuration.
5. Open PowerShell in the project folder and run:

   ```powershell
   C:\xampp\php\php.exe -S localhost:8000
   ```

6. Open <http://localhost:8000> in your browser. Stop the server by pressing `Ctrl+C` in PowerShell.

## Accounts and roles

- Create an account from the **Register** page. Public registration creates a `user` account.
- To grant administrator access in a local setup, open the `ka` database and `users` table in phpMyAdmin, then change the account's `role` value to `admin`.
- Do not expose administrator registration publicly when deploying the website.

## Project files

- `home.php`, `phone.php`, `headphone.php`, `accessories.php`: storefront and product category pages.
- `cart.php`, `insert_cart.php`, `update_quantity.php`, `del_cart.php`: shopping cart operations.
- `products.php`, `insert.php`, `update.php`, `delete.php`: product management.
- `login.php`, `register.php`, `logout.php`: accounts and sessions.
- `config.php`: database connection settings.
- `ka.sql`: database schema and initial data.
- `css/`, CSS files in the project root, `img/`, and `iamges/`: styles and images.

## Security notes

This project is intended for learning and local use. Before deploying it online, review administrator page protection, input validation, file upload security, and password and session handling. Do not publish real database credentials or passwords in a public repository.

## Credits and rights

© 2025 Kareem Abuayyash. All rights reserved. The project credits Kareem Abuayyash as its developer, as shown on the website. This README does not grant a license to redistribute or use the project commercially; contact the rights holder for permission. Third-party frameworks, libraries, images, and fonts remain subject to their respective owners' licenses and rights.
