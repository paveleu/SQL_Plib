<?php

/*
Autor: Pawel Swiderek
Git: paveleu
Ver. 1.0
*/

class DB
{
	private $connect;
	public function __construct()                       //class construct
	{
        if(!isset($sql_lib_conf))                       //default connection config
        {
            $sql_lib_conf = [
                'host'=>'127.0.0.1',        
                'login'=>'root',
                'pass'=>'root',
                'name'=>'database',
            ];
        }
		$this->connect = mysqli_connect($sql_lib_conf['host'], $sql_lib_conf['login'], $sql_lib_conf['pass'], $sql_lib_conf['name']);   //conection
		if(!$this->connect){                               //test conection
    		return false;
		}else{
            return true;
        }
    }
    
	public function connect_error()                        //return conection error
	{
		if(!$this->connect){
    		return mysqli_connect_error();
		}else{
            return false;
        }
	}    
    
    
    
	public function insert($sql)                            //insert sql
	{
		if(mysqli_query($this->connect, $sql)){
    		return true;
		} else {
    		return false;
			echo mysql_error($this);
		}
	}
	
	public function getRow($sql)                            //Get one row from table
	{
		$result = mysqli_query($this->connect, $sql);
		if (mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
			return $row;
		} else {
			return array();}
	}

    public function select($sql)                            //select sql and fetch assoc for evry row
    {
        $rows = array();
        $result = mysqli_query($this->connect, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $record = array();
                foreach ($row as $key => $value) {
                    $record[$key] = $row[$key];
                }
                $rows[] = $record;
            };
            return $rows;
        } else {
            return array();
        }
    }
	
	public function update($sql)                        //update sql
	{
		if(mysqli_query($this->connect, $sql)){
    		return true;
		} else {
    		return false;
		}
	}

	public function __desctruct()                         //destruct conection
	{
		mysqli_close($this->connect);
	}
}