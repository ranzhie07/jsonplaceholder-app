# 📚 JSONPlaceholder Laravel Application

A professional Laravel application that fetches data from [JSONPlaceholder](https://jsonplaceholder.typicode.com/), stores it using Eloquent ORM, and provides a secured RESTful API with Basic Authentication.

---

## 🚀 Installation Guide

### 1️⃣ Clone the Repository
```bash
git clone https://github.com/ranzhie07/jsonplaceholder-app.git
cd jsonplaceholder-app
```

### 2️⃣ Install Dependencies
```bash
composer install
```

### 3️⃣ Configure Environment Variables
```bash
cp .env.example .env    # Or 'copy .env.example .env' on Windows CMD
```
- Update `.env` with your database credentials:
    - `DB_CONNECTION=mysql`
    - `DB_HOST=127.0.0.1`
    - `DB_PORT=3306`
    - `DB_DATABASE=laravel`
    - `DB_USERNAME=root`
    - `DB_PASSWORD=`
- Set `SESSION_DRIVER=file`

### 4️⃣ Run Application Setup
```bash
php artisan key:generate
php artisan migrate --seed
php artisan populate:database
php artisan serve
```

---

## 🔐 Authentication

This application uses **Basic Authentication** for securing API endpoints.

**Default API Credentials:**
- **Username:** `admin@surefirelocal.com`
- **Password:** `surefirelocal`

---

## 📡 Available API Endpoints

All endpoints require **Basic Authentication** credentials.

### 📂 Users
| Method | Endpoint            | Description   |
|--------|----------------------|---------------|
| GET    | `/api/users`         | List all users |
| GET    | `/api/users/{id}`    | View a single user |

### 📝 Posts
| Method | Endpoint               | Description        |
|--------|-------------------------|--------------------|
| GET    | `/api/posts`            | List all posts      |
| GET    | `/api/posts?userId=1`   | Filter posts by userId |
| GET    | `/api/posts/{id}`       | View a single post   |
| POST   | `/api/posts`            | Create a new post    |
| PUT    | `/api/posts/{id}`       | Fully update a post  |
| PATCH  | `/api/posts/{id}`       | Partially update a post |
| DELETE | `/api/posts/{id}`       | Delete a post        |
| GET    | `/api/posts/{id}/comments` | View comments for a post |

### 💬 Comments
| Method | Endpoint      | Description    |
|--------|----------------|----------------|
| GET    | `/api/comments` | List comments  |

### 📸 Albums & Photos
| Method | Endpoint      | Description   |
|--------|----------------|---------------|
| GET    | `/api/albums`  | List albums   |
| GET    | `/api/photos`  | List photos   |

### ✅ Todos
| Method | Endpoint      | Description   |
|--------|----------------|---------------|
| GET    | `/api/todos`   | List todos    |

---

## 📝 License

This project was created as part of a technical exam for Surefire Local.
