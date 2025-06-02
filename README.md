# This API is made for getting sipping tracking information

**To run the API, you need to**
1. Install the required packages by running `composer install`
2. Set up your environment by copying the `.env.example` file to `.env` and configuring it as needed.
3. Generate the application key by running `php artisan key:generate`
4. Run the migrations to set up the database by executing `php artisan migrate`
5. (Optional) Seed the database with sample data by running `php artisan db:seed`
6. Run the API by executing `php artisan serve`
7. You can get the tracking info using GET API at `http://localhost:8000/api/track`, with a tracking_code parameter, like this: `http://localhost:8000/api/track?tracking_code=YOUR_TRACKING_CODE`
9. To test the API, you can use tools like Postman or cURL to send requests.
10. You can also run the tests by executing `php artisan test` to ensure everything is working correctly.

Set these environment variables in your `.env` file:
```aiignore
TRACKING_STORAGE_DRIVER=sqlite or csv # select the driver you want to use
CSV_TRACKING_FILE= your csv file path # this is required if you are using csv driver , for example: tracking.csv
FRONTEND_URL=http://localhost:3000 # this is the URL of your frontend application, used for CORS
TESTING_KEY=testing_key123 # this is used for testing purposes, you can change it to any value you want
```

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



