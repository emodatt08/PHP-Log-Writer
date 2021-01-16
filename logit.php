<?php
include('LaravelLog.php');
$log = (new LaravelLog);
    //set path
    $log->setPath(getcwd());

    //set filename
    $log->setFileName('requests');

    //log arrays, objects, integers or strings in either .log, .json and .csv file formats by setting the extension in the second argument 
    $log->logData((object) $_SERVER, 'json');