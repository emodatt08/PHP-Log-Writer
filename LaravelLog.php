<?php
class LaravelLog{
    private $logfile;
    private $fileName;



    public function setPath($path){
        $this->logfile = $path;
    }

    private function getPath():string{
         return  $this->logfile;
    }


    public function setFileName($fileName){
        $this->fileName = $fileName;
    }

    private function getFileName():string{
         return  $this->fileName;
    }



    private function processFileType($data, $type){
      switch($type){
          case 'log':
            $this->createLogData($data);
          break;

          case 'csv':
            $this->createCsvData($data);
          break;

          case 'json':
            $this->createJsonData($data);
          break;

      }
    }

    private function createCsvData($data){
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename='.$this->getFileName().'.csv"');
        $logfile = $this->getPath().'/'.$this->getFileName().".csv"; 
        $fp = fopen($logfile, 'wb');
        foreach ( $data as $line ) {
            if(is_array($data)){       
                   $line  = implode(",",$line);                      
            }elseif(is_string($data)){
                    $line  = $line;
            }elseif(is_object($data)){
                    $line  = implode(",",(array) $line);
            }else{
                    $line  = $line;
            }
            $line = date("Y-m-d H:i:s")."--".$line;
            $val = explode(",", $line);
            fputcsv($fp, $val);
        }
    }
 
    private function createLogData($data){
        if(is_array($data)){       
                $log  = print_r($data, 1).PHP_EOL;                      
        }elseif(is_string($data)){
                $log  = $data.PHP_EOL;
        }elseif(is_object($data)){
                $log  = print_r($data, 1).PHP_EOL;
        }else{
                $log  = $data.PHP_EOL;
        }
        $log = date("Y-m-d H:i:s")."--".$log;
        $logfile = $this->getPath().'/'.$this->getFileName().".log";
        file_put_contents($logfile, $log, FILE_APPEND); 
    }

    public function createJsonData($data){   
        $params = json_encode($data);
        $logfile = $this->getPath().'/'.$this->getFileName().".json";
        $date = date("Y-m-d H:i:s")." -- ";
        $insert = "\n\n$date $params";
        file_put_contents($logfile,$insert,FILE_APPEND | LOCK_EX);
    }

    public function logData($data, $type){
        return $this->processFileType($data,$type);
    }

}