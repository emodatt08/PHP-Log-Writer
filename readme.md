"# PHP-Log-Writer" 

## Usage

Include class 
```sh
    include('LaravelLog.php');
```

Set  file name
```sh
    $log->setFileName('requests');
```

Log arrays, objects, integers or strings in either .log, .json and .csv file formats by setting the extension in the second argument 
```sh
    $log->logData((object) $_SERVER, 'json');
```







