<?php
namespace FireBirdClassic\Query;

/**
* ibase query
*/

class IbaseQuery
{
	var $connected,$con;

    function __construct() {
    	$host     = config('database.connections.firebird.host');
        $username = config('database.connections.firebird.username');
        $password = config('database.connections.firebird.password');
        $database = config('database.connections.firebird.database');

        $dns = $host.':'.$database;

        $this->connected = false;
        if ($this->con = @ibase_connect($dns, $username, $password)) {
            $this->connected = true;
        } else {
            trigger_error('Cannot connect to Firebird Database, no username or password supplied');
        }
    }

    function __destruct() {
        @ibase_close();
    }

    function execute($query) {
        return @ibase_query($this->con, $query);
    }

    function fetchAssoc($query) {
        return @ibase_fetch_assoc($query);
    }

    function numRows($query){
        $i = 0;
        while( $a = self::fetchAssoc($q) ){
            $i++;
        }
        return($i);
    }
    
    function insert($table, $values) {
        
        $keys  = array_keys($values);
        $values = array_values($values);

        $valstr = "'".implode("', '", $values) ."'";

        return "INSERT INTO " . $table . " (" . implode(', ', $keys) . ") VALUES (" . $valstr . ");";
    }

    function update($table, $values, $where, $orderby = array(), $limit = FALSE) {

        foreach ($values as $key => $val) {
            $valstr[] = $key . " = " .  " '" .$val. "' ";
        }

        foreach ($where as $key => $val) {
            $wherestr[] = $key . " = " .  " '" .$val. "' ";
        }

        $limit = (!$limit) ? '' : ' ROWS ' . $limit;
        $orderby = (count($orderby) >= 1) ? ' ORDER BY ' . implode(", ", $orderby) : '';
        $sql = "UPDATE " . $table . " SET " . implode(', ', $valstr);
        $sql .= ($where != '' AND count($where) >= 1) ? " WHERE " . implode(" AND ", $wherestr) : '';
        $sql .= $orderby . $limit;
        return $sql;
    }

    function delete($table, $where , $limit = FALSE) {

        foreach ($where as $key => $val) {
            $wherestr[] = $key . " = " .  " '" .$val. "' ";
        }

        $conditions = " WHERE ".implode(" AND ", $wherestr);

        
        $limit = (!$limit) ? '' : ' ROWS ' . $limit;
        return "DELETE FROM " . $table . $conditions . $limit;
    }
}