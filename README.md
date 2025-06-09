# AdminFLow - Company Dashboard

An application for managing companies and employees.

## Tech Stack

- [Laravel 12](https://laravel.com/)
- [Inertia.js](https://inertiajs.com/)
- [Vue 3](https://vuejs.org/)
- [Vite](https://vitejs.dev/) (frontend build)

## Requirements

- PHP 8.2+
- Composer
- Node.js & npm

## Local Setup

1. **Clone the repository**
    ```sh
    git clone <repo-url>
    cd company-employee-dashboard
    ```

2. **Install PHP dependencies**
    ```sh
    composer install
    ```

3. **Install JavaScript dependencies**
    ```sh
    npm install
    ```

4. **Copy and configure environment**
    ```sh
    cp .env.example .env
    # Edit .env to set DB and app config
    ```

5. **Generate application key**
    ```sh
    php artisan key:generate
    ```

6. **Run migrations**
    ```sh
    php artisan migrate
    ```

7. **Build frontend assets**
    ```sh
    npm run build
    ```

8. **Start the development server**
    ```sh
    npm run dev
    ```

## Usage

- Visit [http://localhost:8000](http://localhost:8000) in your browser.
- Register a user and start managing companies and employees.


## Testing

```sh
php artisan test
```

## License

MIT

---
