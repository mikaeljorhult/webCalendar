# webCalendar

Fetch and display multiple Google calendars as one single schedule.

## Installation
Just place the files on your web server and run `composer install`.

## Environment variables

Database credentials as well as default password is determined by a `.env` file. Change the database credentials and
the last two lines to match your environment.

```
DB_HOST=localhost
DB_DATABASE=webcalendar
DB_USERNAME=homestead
DB_PASSWORD=secret

DEFAULT_PASSWORD=user-password
API_KEY=google-calendar-api-key
```