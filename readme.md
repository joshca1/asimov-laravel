# Larticles API

> Laravel 5.8 API that uses the API resources. This is an API for an Asimov CRUD app.

## Quick Start

```bash
# Install Dependencies
composer install

# Run Migrations
php artisan migrate

# Import Articles
php artisan db:seed

# Add virtual host if using Apache

# If you get an error about an encryption key
php artisan key:generate
```

## Endpoints

### List all bookings with email,booking hours.

```bash
GET api/v1/bokings
```

### Get list of bookings in a specific day provided.

```bash
GET api/v1/bokings/{date}
```

### Add booking

```bash
POST api/v1/bookings
```

```

## App Info

### Author

Jose Antonio Cañizales

### Version

1.0.0

### License

This project is licensed under the MIT License
```
