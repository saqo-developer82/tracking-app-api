# This API is made for getting sipping tracking information

**To run the API, you need to**
1. use PHP 8.2 or higher
2. Install the required packages by running `composer install`
3. Set up your environment by copying the `.env.example` file to `.env`.
4. Update the `.env` file with your database configuration and other settings.
   - If you are using SQLite, you can set `DB_CONNECTION=sqlite` and `DB_DATABASE=/your_root_path/database/trackings.sqlite` (make sure to create the `trackings.sqlite` file in the `database` directory).
   - If you are using CSV, set `TRACKING_STORAGE_DRIVER=csv` and provide the path to your CSV file in `CSV_TRACKING_FILE`.
   - add `FRONTEND_URL=http://localhost:3000` to allow CORS requests from your frontend application.
   - add `TESTING_KEY=testing` to use for testing purposes.
5. Generate the application key by running `php artisan key:generate`
6. Run the migrations to set up the database by executing `php artisan migrate`
7. (Optional) Seed the database with sample data by running `php artisan db:seed`
8. Run the API by executing `php artisan serve`
9. You can get the tracking info using GET API at `http://localhost:8000/api/track`, with a tracking_code parameter, like this: `http://localhost:8000/api/track?tracking_code=YOUR_TRACKING_CODE`
10. To test the API, you can use tools like Postman or cURL to send requests.
11. You can also run the tests by executing `php artisan test` to ensure everything is working correctly.

**Improvements can be done**
1. Implement adding new tracking data.
2. Using a more robust database system like MySQL or PostgreSQL instead of SQLite or CSV for production.
3. Implementing authentication and authorization for the API.
4. Adding more error handling and validation for the input data.
5. Implementing a more sophisticated search functionality for tracking data.
6. Implementing a more comprehensive API documentation using tools like Swagger or Postman.
7. Implementing a versioning system for the API to manage changes and updates.
8. Adding support for webhooks to notify users of tracking updates in real-time.
9. Adding support for different tracking carriers and their specific tracking formats.
10. Adding support for bulk tracking requests to allow users to track multiple shipments at once.
11. Implementing a notification system to alert users of significant tracking updates or changes.
12. Implementing DTO (Data Transfer Objects) for better data handling and validation.



