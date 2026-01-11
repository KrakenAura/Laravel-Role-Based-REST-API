# Laravel Role-Based REST API

## 📌 Project Overview

This project is a **backend REST API** built with **Laravel 12** that implements **token-based authentication**, **role-based authorization**, and **policy-driven access control**. The system simulates a simple content management workflow where users with different roles have different permissions when interacting with posts.

This project is designed as a **backend portfolio** to demonstrate real-world backend practices such as authentication, authorization, database relationships, and clean architecture.

---

## 🛠 Tech Stack

-   **Laravel 12**
-   **PHP 8+**
-   **MySQL 8**
-   **Laravel Sanctum** (API Token Authentication)
-   **Docker & Docker Compose**
-   **Postman** (API Testing)

---

## 🔐 Authentication

Authentication is implemented using **Laravel Sanctum (API Token mode)**.

### Login

```
POST /api/login
```

Request body:

```json
{
    "email": "admin@app.com",
    "password": "password"
}
```

Response:

```json
{
    "data": {
        "token": "{BEARER_TOKEN}"
    }
}
```

All protected endpoints require the header:

```
Authorization: Bearer {BEARER_TOKEN}
```

---

## 👥 User Roles

The system supports three roles:

| Role   | Description                         |
| ------ | ----------------------------------- |
| Admin  | Full access to all resources        |
| Editor | Can create and update own posts     |
| User   | Read-only access to published posts |

Roles are stored directly on the `users` table.

---

## 📝 Post Resource

### Post Fields

-   `id`
-   `title`
-   `content`
-   `status` (`draft` / `published`)
-   `user_id`
-   `created_at`
-   `updated_at`

---

## 🔒 Authorization (Policy)

Authorization rules are handled using **Laravel Policy** (`PostPolicy`).

### Policy Rules

-   **Admin**: can create, update, and delete any post
-   **Editor**: can create posts and update only their own posts
-   **User**: cannot create, update, or delete posts

Policies are enforced inside controllers using:

```php
$this->authorize('action', $post);
```

---

## 📡 API Endpoints

### Public

```
GET /api/posts
```

Returns only published posts.

---

### Protected (Authentication Required)

#### Create Post (Admin, Editor)

```
POST /api/posts
```

#### Update Post (Admin, Editor - own post)

```
PUT /api/posts/{id}
```

#### Delete Post (Admin only)

```
DELETE /api/posts/{id}
```

---

## 🧪 Database Seeder

The project includes seeders for quick testing:

### Seeded Users

| Email                                   | Role   | Password |
| --------------------------------------- | ------ | -------- |
| [admin@app.com](mailto:admin@app.com)   | admin  | password |
| [editor@app.com](mailto:editor@app.com) | editor | password |
| [user@app.com](mailto:user@app.com)     | user   | password |

### Seeded Posts

-   Published and draft posts
-   Posts owned by different roles

Run seeder:

```bash
php artisan db:seed
```

---

## 🐳 Running with Docker

1. Clone repository
2. Copy environment file

```bash
cp .env.example .env
```

3. Start containers

```bash
docker-compose up -d
```

4. Install dependencies & migrate

```bash
docker-compose exec app composer install
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate --seed
```

---

## 🎯 Project Highlights

-   Clean separation between authentication and authorization
-   Role-based access using middleware
-   Ownership-based authorization using policies
-   Token-based API authentication (no session / cookie dependency)
-   Dockerized environment for consistency

---

## 📎 Notes

This project focuses purely on **backend API functionality** and does not include a frontend interface. API testing and demonstration are done using Postman.

---

## 👤 Author

**Abdul Karim**
Backend / Web Developer
