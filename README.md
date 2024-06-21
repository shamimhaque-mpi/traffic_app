# High Traffic Application

## Installation

1. Clone the repository:
    ```bash
    git clone <repository-url>
    ```

2. Navigate to the project directory:
    ```bash
    cd traffic_app
    ```

3. Install dependencies:
    ```bash
    composer install
    ```

4. Create a copy of the `.env` file:
    ```bash
    cp .env.example .env
    ```

5. Configure your database in the `.env` file.

6. Run migrations:
    ```bash
    php artisan migrate
    ```

7. Serve the application:
    ```bash
    php artisan serve
    ```

## API Endpoints

1. **Mock Response API**
    - Endpoint: `GET /api/mock-response`
    - Headers: `X-Mock-Status` (accepted|failed)

2. **Process Payment API**
    - Endpoint: `POST /api/process-payment`
    - Body: `user_id`, `amount`

3. **Callback API**
    - Endpoint: `POST /api/callback/{transactionId}`
    - Body: `status`
