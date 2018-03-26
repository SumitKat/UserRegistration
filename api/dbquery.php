<?php
class DbQuery
{
    public $conn;
    public $sql;
    public function __construct()
    {
        $conn = new mysqli(SERVER_NAME, USER_NAME, PASSWORD, DATABASE_NAME);
        // Check connection
        if ($conn->connect_error) {
            die( "Connection failed: " . $conn->connect_error );
        }
    }

    public function insert($table, $array)
    {
        global $sql , $conn;
        $field=$values="";
        $i=1;
        foreach ($array as $key => $value) {
            
            if ($i < count($array)) {
                $field .= $key.", ";
                $values .= "'".$value."', ";
                $i++;
            } else {
                $field .= $key;
                $values .= "'".$value."'";
            }

        }
        $sql = "INSERT INTO"." $table"." (".$field.") "." VALUES "." (".$values.")";
    }

    public function exec()
    {
        global $sql, $conn;
        if ($conn->query($sql) === true) {
            echo "Success!!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        return $conn->insert_id;
    }

    public function select($table, $array, $id1, $id2)
    {
        global $sql, $conn;
        $value = "";
        for ($i = 0; $i < count($array)-1; $i++) {
            $value .= $array[$i].", ";
        }
        $value .= $array[count($array) -1];
        $sql = "SELECT $value FROM $table where $id1 = '$id2' LIMIT 1";
        $result = $conn->query($sql);
        return $result->fetch_assoc();
    }

    public function update($table, $array, $id1, $id2)
    {
        global $sql , $conn;
        $i=0;
        $field = "";
        foreach ($array as $key => $value) {
            if ($i < count($array)-1) {
                $field .= $key."='".$value."',";
                $i++;
            } else {
                $field .= $key."='".$value."'";
            }
        }
        $sql = "UPDATE"." $table"." SET"." $field"." WHERE". " $id1"." ="."'$id2'";
        $conn->query($sql);
    }
}
