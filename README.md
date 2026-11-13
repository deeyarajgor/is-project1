# IS Project 1

A simple PHP web application with user signup, login and a feedback form, hosted on a Linux server as part of Server Administration CAT 2.

## Features
- User signup and login (passwords hashed with `password_hash()`)
- Session-based dashboard and logout
- Feedback form that saves to and reads from the database
- GitHub Actions workflow that checks PHP syntax on every push

## Tech stack
Linux (Ubuntu), Nginx, Apache2, PHP 8.3, MariaDB, Git and GitHub

## Setup
1. Clone the repo into the web root:
   `git clone https://github.com/deeyarajgor/is-project1.git`
2. Create the database `CAT2` with the `users` and `feedback` tables.
3. Copy `config.sample.php` to `config.php` and set your database password.
4. Open `http://SERVER_IP/is-project1/` in a browser.

## Files
| File | Purpose |
|---|---|
| `index.php` | Home page |
| `signup.php` | Register a new user |
| `login.php` | Log in |
| `dashboard.php` | Page for logged-in users |
| `feedback.php` | Feedback form and saved entries |
| `config.sample.php` | Database settings template (the real `config.php` is not committed) |
