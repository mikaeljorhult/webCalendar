# webCalendar2

Fetch and display multiple Google calendars as one single schedule.

## Installation
Just place the files on your web server and run `composer install`.

### Environment variables

Database credentials as well as default password is determined by a `.env.php` file.

```php
<?php

return [
	'DB_NAME' => 'webcalendar',
	'DB_USER' => 'webcalendar',
	'DB_PASS' => 'database-password',
	'DEFAULT_PASSWORD' => 'user-password'
];
```