# 🛒 Shopping List API

A modern RESTful API for managing shopping lists, products, categories, and list items. Built with Laravel 12, leverages Laravel Sanctum for authentication, ships with a developer-friendly Docker setup, and supports rapid local development.

<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300" alt="Laravel Logo">
  </a>
</p>

---

## 🗂️ Table of Contents
- [Features](#features)
- [Tech Stack](#tech-stack)
- [Quick Start](#quick-start)
- [API Documentation](#api-documentation)
- [Testing](#testing)
- [Development](#development)
- [Contributing](#contributing)
- [License](#license)

---

## ✨ Features
- **User Registration & Authentication** — token-based (Laravel Sanctum)
- **Shopping List CRUD** — create, update, delete, list your shopping lists
- **List Item CRUD** — manage items within shopping lists (quantity, units, checked state)
- **Products & Categories** — full product and category management
- **User-specific Data** — all lists/items are associated to each authenticated user

## ⚙️ Tech Stack
- **Framework:** [Laravel 12](https://laravel.com/) (PHP 8.2)
- **Authentication:** [Sanctum](https://laravel.com/docs/sanctum)
- **Testing:** PHPUnit & Pest
- **Containerization:** Docker, Docker Compose
- **Database:** MySQL (default Docker setup)
- **Web Server:** Nginx (provided in Docker setup)

## 🚀 Quick Start

### With Docker (Recommended)
1. **Clone the repository:**
   ```bash
   git clone <repo-url> && cd shopping-list-api
   ```
2. **Configure your environment:**
   - Copy `.env.example` to `.env` and adjust config if needed
3. **Build and launch containers:**
   ```bash
   docker-compose up --build
   ```
4. **Install dependencies:**
   ```bash
   docker-compose exec app composer install
   ```
5. **Generate app key & run migrations:**
   ```bash
   docker-compose exec app php artisan key:generate
   docker-compose exec app php artisan migrate
   ```

API is accessible at [http://localhost:8080](http://localhost:8080).

### Stopping Containers
```bash
docker-compose down
```

### Manual/Dev
- You may run `composer install`, `npm install`, etc. for non-Docker setups.

---

## 📚 API Documentation

### Authentication
- All endpoints (except `POST /v1/register`, `POST /v1/login`, and `/v1/health`) require an `Authorization: Bearer <token>` header.
- Obtain a token via `/v1/register` or `/v1/login`.

#### Register
```http
POST /api/v1/register
Content-Type: application/json

{
  "name": "Jane Doe",
  "email": "jane@example.com",
  "password": "secret",
  "password_confirmation": "secret"
}
```
Response:
```json
{
  "user": { "id": 1, "name": "Jane Doe", "email": "jane@example.com" },
  "token": "TOKEN_STRING"
}
```

#### Login
```http
POST /api/v1/login
Content-Type: application/json

{
  "email": "jane@example.com",
  "password": "secret"
}
```
Response:
```json
{
  "user": { "id": 1, "name": "Jane Doe", "email": "jane@example.com" },
  "token": "TOKEN_STRING"
}
```

#### Using Your Token
For all protected requests, add:
```
Authorization: Bearer TOKEN_STRING
```

### Core Endpoints (all under `/api/v1/`)

| Method | Endpoint                | Description                          |
|--------|-------------------------|--------------------------------------|
| POST   | register                | Register a new user                  |
| POST   | login                   | Log in a user                        |
| POST   | logout                  | Log out (revoke token)               |
| GET    | health                  | Healthcheck endpoint (public)        |
| GET    | categories              | List all categories                  |
| POST   | categories              | Create a category                    |
| PUT    | categories/{id}         | Update a category                    |
| DELETE | categories/{id}         | Delete a category                    |
| GET    | products                | List all products                    |
| POST   | products                | Create a product                     |
| PUT    | products/{id}           | Update a product                     |
| DELETE | products/{id}           | Delete a product                     |
| GET    | product-lists           | List user’s product lists            |
| POST   | product-lists           | Create a shopping/product list       |
| PUT    | product-lists/{id}      | Update a shopping/product list       |
| DELETE | product-lists/{id}      | Delete a shopping/product list       |
| GET    | users/{user}/product-lists | Lists for a specific user        |
| GET    | product-list-items      | List all list items                  |
| POST   | product-list-items      | Create a list item                   |
| PUT    | product-list-items/{id} | Update a list item                   |
| DELETE | product-list-items/{id} | Remove a list item                   |

#### Example: Create a Product List
```
POST /api/v1/product-lists
Authorization: Bearer TOKEN
Content-Type: application/json

{
  "title": "Weekly Groceries"
}
```
*Response:*
```json
{
  "id": 1,
  "user_id": 1,
  "title": "Weekly Groceries",
  "created_at": "...",
  "updated_at": "..."
}
```

#### Example: Add an Item to a List
```
POST /api/v1/product-list-items
Authorization: Bearer TOKEN
Content-Type: application/json

{
  "product_list_id": 1,
  "product_id": 1,
  "quantity": 2,
  "unit": "kg",
  "is_checked": 0
}
```
*Response:*
```json
{
  "id": 1,
  "product_list_id": 1,
  "product_id": 1,
  "quantity": 2,
  "unit": "kg",
  "is_checked": 0,
  "created_at": "...",
  "updated_at": "..."
}
```

#### Error Example
```
{
  "message": "Invalid credentials"
}
```

---

## 🧪 Testing
To run tests:
- With Docker:
  ```bash
  docker-compose exec app ./vendor/bin/pest
  ```
- Or, with PHPUnit:
  ```bash
  docker-compose exec app php artisan test
  ```

## 🛠️ Development
- Hot reload: Use Laravel's built-in `php artisan serve` (local/dev)
- Docker Nginx and PHP-FPM for production parity

