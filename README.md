# Subscription Platform API

## Description
This API allows users to subscribe to websites and receive notifications for new posts. It includes endpoints for creating posts and subscribing users to websites. The project uses Laravel with a MySQL database.

## Installation

### Prerequisites
- PHP 7.* or 8.*
- Composer
- MySQL

### Steps

1. **Clone the Repository**
   ```
   git clone  git@github.com:Bostigger/subscribers-platform-api.git
   cd subscribers-platform-api
   ```

2. **Install Dependencies**
```composer install```

3. **Environment Setup**
- Copy `.env.example` to `.env`
- Configure your database settings in the `.env` file

4. **Generate Application Key**
```php artisan key:generate```

5. **Run Migrations**

   ```php artisan migrate```

   
6. **Seed the Database**
- Since the project does not include endpoints for creating users and websites, use seeders to populate these entities.
```php artisan db:seed```


## Usage

### Endpoints

1. **Create a Post for a Website**
- **URL**: `/api/v1/websites/{website}/posts`
- **Method**: `POST`
- **Body**:
  - `title`: String
  - `description`: String

2. **Subscribe to a Website**
- **URL**: `/api/v1/websites/{website}/subscribe`
- **Method**: `POST`
- **Body**:
  - `user_id`: Integer

### Running the Project

- Start the local development server:
```php artisan serve```

- Access the API at: `http://localhost:8000/api/v1/`


## Additional Commands

- **Send Emails to Subscribers** (Manual execution)
- This command sends emails to subscribers for new posts.
  ```
  php artisan app:send-emails-to-subscribers
  ```





   
