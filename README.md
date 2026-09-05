# Tourism Management API

A full-stack tourism management application for managing tourism destinations (`wisata`). The project demonstrates a Laravel REST API consumed by a React frontend, with image upload, validation, and MySQL persistence.

## Features

- Tourism destination CRUD
- REST API with Laravel 8
- React 17 frontend
- MySQL database
- Image upload and replacement
- Request validation for tourism data and images
- Laravel API Resources for consistent responses
- Laravel Sanctum available for authenticated user endpoints
- Toast/alert feedback in the frontend

## Tech Stack

### Backend

- PHP 7.3+
- Laravel 8
- Laravel Eloquent
- Laravel Sanctum
- MySQL

### Frontend

- React 17
- React Router DOM
- Axios
- Bootstrap 5
- React Toastify
- SweetAlert2

## Architecture

```text
React Frontend
     |
     | HTTP / JSON / Multipart Form Data
     v
Laravel REST API
     |
     v
Eloquent ORM
     |
     v
MySQL
```

Uploaded images are stored on Laravel's public filesystem and referenced by their generated server-side filename.

## Project Structure

```text
app/
├── Http/
│   ├── Controllers/
│   │   └── WisataController.php
│   └── Resources/
│       └── WisataResource.php
├── Models/
│   └── WisataModel.php
routes/
└── api.php
resources/
└── js/
```

## Requirements

- PHP 7.3 or newer
- Composer
- Node.js 16+
- npm
- MySQL 5.7+ / 8.x

## Installation

### 1. Clone the repository

```bash
git clone https://github.com/shiinobu/tourism-management-api.git
cd tourism-management-api
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Configure environment

Copy the example environment file:

```bash
cp .env.example .env
```

On Windows PowerShell:

```powershell
Copy-Item .env.example .env
```

Generate the Laravel application key:

```bash
php artisan key:generate
```

Update the database settings in `.env`.

### 4. Prepare the database

Create the configured MySQL database, then run migrations:

```bash
php artisan migrate
```

### 5. Install frontend dependencies

```bash
npm install
```

Build/watch frontend assets during development:

```bash
npm run dev
```

### 6. Prepare public storage

```bash
php artisan storage:link
```

### 7. Start Laravel

In another terminal:

```bash
php artisan serve
```

The API will normally be available at:

```text
http://127.0.0.1:8000
```

## API Endpoints

| Method | Endpoint | Description |
|---|---|---|
| GET | `/api/wisatas` | List tourism destinations |
| POST | `/api/wisatas` | Create a tourism destination |
| GET | `/api/wisatas/{id}/detail` | Get destination detail |
| GET | `/api/wisatas/{id}/edit` | Get destination data for editing |
| PUT | `/api/wisatas/{id}` | Update a destination |
| DELETE | `/api/wisatas/{id}` | Delete a destination |
| GET | `/api/user` | Get authenticated user through Sanctum |

### Create / Update Fields

```text
nama_wisata  string, required, max 255 characters
deskripsi    string, required
foto         image, jpeg/png/jpg/gif, max 2 MB
```

`foto` is required when creating a destination and optional when updating one.

## Authentication

The project includes Laravel Sanctum configuration for authenticated API access. The tourism CRUD routes are currently public, while the default `/api/user` route requires Sanctum authentication.

## Development

Run frontend development assets:

```bash
npm run dev
```

Run Laravel locally:

```bash
php artisan serve
```

Run the Laravel test suite:

```bash
php artisan test
```

## Security Notes

- Do not commit `.env` files or production credentials.
- Use `.env.example` as the configuration template.
- Uploaded images are validated by MIME/type and file size.
- Uploaded filenames are generated server-side instead of trusting the original filename.
- Existing images are removed through Laravel's filesystem abstraction when replaced or deleted.

See [`SECURITY.md`](SECURITY.md) for the security policy.

## Status

This is a portfolio/supporting project demonstrating a Laravel + React REST API with CRUD and file-upload workflows.
