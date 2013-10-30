## Media Indexing System

### Usage

Create an SQL database to hold the data and add it to app/config/database.php, as well as the SQL username and password you wish to use.

Run "php artisan migrate" to create the Users, Films, and Television SQL database tables.

Add a user to the users table. This can be accomplished by editing database/seeds/DatabaseSeeder.php and running "php artisan db:seed" or by manually adding users in SQL.

### License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
The Media Indexing System is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
