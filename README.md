
# Laravel API Project

This project aims to develop a library management system using the Laravel framework and MySQL database. The system will manage relationships between books, authors, and libraries, allowing users to add, edit, and delete book and author information. It will also include features for tracking changes over time and uploading media files

## Table of Contents

- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Migrations](#migrations)
- [Running the API](#running-the-api)
- [API Documentation](#api-documentation)
- [Deployment](#deployment)
- [License](#license)

## Requirements

- PHP >= 8.0
- Composer
- Laravel >= 10.0
- MySQL database systems
- [Optional] Postman for API testing

## Installation

Follow these steps to get the project up and running locally:

1. **Clone the repository:**

   ```bash
   git clone https://github.com/your-username/your-laravel-api.git
   cd your-laravel-api
   ```

2. **Install dependencies:**

   Run Composer to install the project dependencies.

   ```bash
   composer install
   ```

3. **Environment setup:**

   Copy the `.env.example` file and set up your environment variables.

   ```bash
   cp .env.example .env
   ```

   Set up your database and other environment-specific settings inside `.env`.

4. **Generate application key:**

   ```bash
   php artisan key:generate
   ```
5. **Install additional packagesy:**

   ```bash
   composer require laravel/passport
   composer require spatie/laravel-medialibrary
   composer require spatie/laravel-versionable
   ```
5. **Run Passport installation:**

   ```bash
   php artisan passport:install
   ```


## Configuration

Make sure to configure the following in the `.env` file:

- **Database**: Set your database credentials (DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD).
- **Other configurations**: Configure cache, queues, and mail services if applicable.

## Migrations

To set up your database tables, run the following command:

```bash
php artisan migrate
```

To seed the database with test data :

```bash
php artisan db:seed
```

## Running the API

To serve the application, use Laravel's built-in development server:

```bash
php artisan serve
```

The API will be accessible at `http://localhost:8000`.

## API Documentation

The API exposes the following endpoints:

| Method | Endpoint                      | Description                     | Auth Required |
|--------|-------------------------------|---------------------------------|---------------|
| GET    | `/api/book`                   | Retrieve a list of all books    | Yes           |
| POST   | `/api/book/create`            | Create a new book               | Yes           |
| GET    | `/api/book/{id}`              | Retrieve a specific book by ID  | Yes           |
| PUT    | `/api/book/{id}`              | Update a specific book by ID    | Yes           |
| DELETE | `/api/book/{id}`              | Delete a specific book by ID    | Yes           |
| GET    | `/api/book/version/{id}`      | Retrieve  previous record by ID | Yes           |
| POST   | `/api/book/add-media/{id}`    | Create images of book by ID     | Yes           |
| DELETE | `/api/book/delete-media/{id}` | Delete images of book by ID     | Yes           |
| POST   | `/api/login`                  | User login and retrieve a token | No            |

> Authentication for secured routes is handled via JWT or Passport tokens.

### Example Requests:

#### 1. Retrieve a List of Books

```bash
GET /api/book
```

Example Response:

```json
{
    "status": true,
    "messages": "Books are listed Successfully",
    "data": {
        "books": [
          
            {
                "id": 2,
                "name": "Educated",
                "subtitle": "A memoir of transformation",
                "summary": "A memoir of transformation",
                "published_year": "2018-02-20",
                "categories": [
                    {
                        "id": 2,
                        "name": "Memoir"
                    }
                ],
                "author": {
                    "id": 102,
                    "name": "Tara Westover",
                    "bio": "Tara Westover is an American memoirist, essayist, and historian. She is known for her memoir 'Educated'."
                }
            },
            {
                "id": 1,
                "name": "The Silent Patient",
                "subtitle": "A psychological thriller",
                "summary": "A psychological thriller",
                "published_year": "2019-02-05",
                "categories": [
                    {
                        "id": 1,
                        "name": "Thriller"
                    }
                ],
                "author": {
                    "id": 101,
                    "name": "Alex Michaelides",
                    "bio": "Alex Michaelides is a British-Cypriot author best known for his debut novel 'The Silent Patient'."
                }
            }
        ]
    }
}
```

#### 2. Create a New Book

```bash
POST /api/book
```

Request Body:

```json
{
    "name": "test",
    "subtitle": "test",
    "author_id": 111,
    "summary": "test",
    "published_year": "1951-07-16",
    "library_ids":[2,3],
    "category_ids":[5,7]

}
```
## Deployment

For deploying your API to a live server, follow these steps:

1. **Set up your server**: Ensure PHP, Composer, and your database are installed and configured on your server.
2. **Clone the repository**: Clone the project to your server.
3. **Install dependencies**: Run `composer install` on the server.
4. **Set environment variables**: Configure the `.env` file with production settings.
5. **Run migrations**: Run `php artisan migrate --force` to create production database tables.
6. **Cache config and routes** (optional for performance):

   ```bash
   php artisan config:cache
   php artisan route:cache
   ```

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details.
