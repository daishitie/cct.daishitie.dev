# COVID19 Contact Tracing

Test Server: http://57fec02565a4.ngrok.io

Server: Ubuntu (LAMP Stack)

---

## Setup Project

1. Install XAMPP or WAMP or using LAMP Stack.

2. Copy `.env.example` file and rename it to `.env`.

3. Update `.env` file contents.

4. Import `covid19_tracing.sql` file to your database.

5. Install required dependencies:

    ```sh
    $ composer install
    ```

6. Make sure you have xampp/wamp services or apache and mysql service running.

7. Test it in your `localhost`.
