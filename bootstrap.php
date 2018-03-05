<?php
error_reporting(-1);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
date_default_timezone_set('Europe/Berlin');

include_once 'Request.php';
include_once 'App.php';
include_once 'View.php';
include_once 'Encryptor.php';
include_once 'PdoSqlite.php';
include_once 'Paste.php';
include_once 'PasteHydrator.php';
include_once 'PasteRepository.php';
include_once 'DbStore.php';
include_once 'UrlBuilder.php';
include_once 'Redirector.php';
