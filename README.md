# TinkyLinky

TinkyLinky is a simple URL shortening API built on the Laravel framework. The API provides functionality to create, retrieve, and manage shortened URLs. Each API endpoint is thoroughly tested to ensure reliability.

## Installation

1. Clone the repository:
    ```bash
    git clone https://github.com/soulshockers/tinkylinky_backend.git
    ```

2. Navigate to the project directory:
    ```bash
    cd tinkylinky_backend
    ```

3. Install dependencies:
    ```bash
    composer install
    ```

4. Set up the environment file:
    ```bash
    cp .env.example .env
    ```

5. Generate the application key:
    ```bash
    php artisan key:generate
    ```
    
6. Build docker images and run the project
    ```bash
    ./vendor/bin/sail up -d
    ```

7. Set up the database:
    ```bash
    ./vendor/bin/sail artisan migrate
    ```

8. Run the tests to ensure everything is working:
    ```bash
    ./vendor/bin/sail artisan test
    ```

9. Generate API docs:
    ```bash
    ./vendor/bin/sail artisan scribe:generate
    ```

10. Visit API docs at http://localhost/docs

## Testing
Each API endpoint is covered by tests to ensure the functionality is working as expected. To run the tests, use the following command:
```bash
./vendor/bin/sail artisan test
```

## License
This project is licensed under the MIT License.

Feel free to contribute by opening issues or submitting pull requests. For any questions or feedback, please contact soulshockers[at]gmail[dot]com.
