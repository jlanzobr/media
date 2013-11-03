#!/bin/sh
php app/tasks/worker.php
php composer.phar self-update
php composer.phar update
