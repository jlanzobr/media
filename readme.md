## Media Indexing System

### Usage

Create an SQL database to hold the data and add it to app/config/database.php, as well as the SQL username and password you wish to use. The simplest way would be to install either MySQL or MariaDB on the server,  setup a database called "media" and a user with access to that database,  and to then modify the 'mysql' entry in app/config/database.php accordingly.

Run "php artisan migrate" to create the Users, Films, and Television SQL database tables.

Add a user to the users table. This can be accomplished by editing database/seeds/DatabaseSeeder.php and running "php artisan db:seed" (which adds a default user with username "guest" and password "password") or by manually adding users in SQL.

Specify the paths to your media directories in app/tasks/worker.php. Note that media must be of the format: Media Title (year).extension. The extension is optional. For example,  Man Of Steel (2013).mkv,  Man Of Steel (2013),  and Man of Steel.mkv are all valid. Then, execute the worker by changing to the app's root directory and executing "php app/tasks/worker.php" or adding it to cron.

### Updating

Run "./update.sh" to update the local database and the Laravel backend.

### License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

The Media Indexing System is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
