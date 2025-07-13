# 📝 SmartTask – Laravel API for Task Management

SmartTask is a powerful task management back-end API built with Laravel 12.
It includes:
1) Secure user authentication using sanctum
2) Full CRUD for tasks
3) Email and database weekly notifications
4) Weekly statistics
6) Scheduled reports

---

## 🚀 Features

- 🔐 User authentication with Laravel Sanctum
- 📝 Full CRUD operations for todos (linked to each user)
- 📁 Full CRUD for categories
- 📬 Notifications when tasks are completed (Email + stored in DB)
- 📊 Weekly statistics endpoint
- 🕒 Scheduled weekly report via email and database
- 🌱 Seeders for test data population
- 📦 Form Requests for validation handling
- 🧩 API Resources for clean and consistent JSON responses
- 🧪 API documentation with Postman collection
- 📸 Screenshots included for quick reference


---

## 🛠️ Technologies Used

This project was built using the following technologies and tools:

- **Laravel 12** – PHP framework for web applications
- **PHP 8.x** – Core programming language
- **MySQL** – Relational database for storing tasks and users
- **Laravel Sanctum** – For API token authentication
- **Form Requests** – For input validation and clean controller logic
- **API Resources** – For formatting consistent JSON responses
- **Mail & Notifications** – For sending email and database notifications
- **Queue System** – For background email delivery (async notifications)
- **Task Scheduling** – For sending weekly reports via email
- **Postman** – For API testing and documentation
- **Seeder & Faker** – For generating test data during development
- **Git & GitHub** – For version control and project sharing

---

## ⚙️ Installation

```bash
git clone [https://github.com/USERNAME/smarttask-api.git](https://github.com/tasnimalshair/Todolist-App.git)
cd Todolist-App
composer install
cp .env.example .env
php artisan key:generate
php artisan db:seed
php artisan migrate
php artisan serve
````

> To enable scheduled reports and notifications:

```bash
php artisan queue:work
php artisan schedule:work
```

---

## 🔐 Authentication – API Endpoints

### 📌 Auth

| Method | Endpoint      | Description          |
| ------ | ------------- | -------------------- |
| POST   | /api/register | Register a new user  |
| POST   | /api/login    | Log in and get token |

### 📝 Todos

| Method | Endpoint        | Description            |
| ------ | --------------- | ---------------------- |
| GET    | /api/todos      | Get all user tasks     |
| GET    | /api/todos/{id} | Get a specific task    |
| POST   | /api/todos      | Create a new task      |
| PUT    | /api/todos/{id} | Update a specific task |
| DELETE | /api/todos/{id} | Delete a task          |
| PUT    | /api/todos/{id}/ops |Toggle a task status|

### 📁 Categories

| Method | Endpoint             | Description                |
|--------|----------------------|----------------------------|
| GET    | /api/categories      | Get all categories         |
| GET    | /api/categories/{id} | Get a specific category     |
| POST   | /api/categories      | Create a new category       |
| PUT    | /api/categories/{id} | Update a specific category  |
| DELETE | /api/categories/{id} | Delete a category           |

### 📊 Statistics

| Method | Endpoint   | Description               |
| ------ | ---------- | ------------------------- |
| GET    | /api/stats | Weekly stats for the user |

---

## 🧪 Token Usage (in Postman)

After logging in, copy the `token` from the response and use it in Postman:

> Authorization → Bearer Token → `your_token_here`

---

## 📄 API Documentation

🧩 A Postman collection is included in the `docs` folder:
`Todolist.postman_collection.json`

You can import it directly into Postman and test all endpoints.

---

## 📸 Screenshots

Available in the `docs/screenshots/` directory:

The following screenshot shows the full list of available API endpoints in Postman.
<img width="1366" height="768" alt="endpoints" src="https://github.com/user-attachments/assets/fa5c1d97-7f9b-4e4c-87e8-adfb2a39a240" />

Example of login request and response
<img width="1366" height="768" alt="login" src="https://github.com/user-attachments/assets/01cab810-a724-4b27-b7bc-04dc50ef3b2e" />

---

## 👩‍💻 Author

Tasnim Alshair – [GitHub Profile](https://github.com/tasnimalshair)
