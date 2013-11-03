<?php

require 'bootstrap/autoload.php';
require_once 'bootstrap/start.php';
require_once 'app/libraries/item.php';
require_once 'app/libraries/imdb.php';
require_once 'app/libraries/worker.php';

set_time_limit(0);

//$films_worker = new Worker('/home/user/Films', 'Film');
$television = new Worker('/home/user/Television', 'Television');
