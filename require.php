<?php
session_start();
date_default_timezone_set('Europe/Stockholm');

require 'vendor/autoload.php';

require 'util/Template.php';
require 'util/Authentication.php';
require 'util/Arrays.php';

require 'integration/Database.php';

require 'model/Info.php';
require 'model/Product.php';
require 'model/Review.php';
require 'model/RFP.php';
require 'model/User.php';
require 'model/Event.php';
require 'model/Calendar.php';
