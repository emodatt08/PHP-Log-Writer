"# PHP-Log-Writer" 

## Usage

include class 
```sh
    include('LaravelLog.php');
```

set  file name
```sh
    $log->setFileName('requests');
```

log arrays, objects, integers or strings in either .log, .json and .csv file formats by setting the extension in the second argument 
```sh
    $log->logData((object) $_SERVER, 'json');
```







