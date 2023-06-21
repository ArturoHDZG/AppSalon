<?php

// Imports
require_once 'functions.php';
require_once 'database.php';
require_once __DIR__ . '/../vendor/autoload.php';

// DB Connection
use Model\ActiveRecord;
ActiveRecord::setDB($db);
