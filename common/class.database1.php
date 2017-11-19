<?php

/**
 * @name Smart DB Class
 * @author Muhammad Hanif <thehanif@msn.com>
 * @category MySQL PDO Database
 * Smart Database Class that proccess most posible PDO Queries in smart way.
 * This class provides various methods to handle query as eazy as posible.
 * Class contains CRUD method includind various JOIN functionalities
 * Class also provides column and fiels selection mehods
 * You can also find biding methors for custom queries or special JOINs.
 * 
 * a extra _date method is available for customizing dates or get current date customized.
 *
 */
class Database {

    public $_DB;
    public $_query;
    public $_where = array();
    public $_select = array();
    public $_action;
    public $_limit;
    public $_table;
    public $_data = array();
    public $_joins = array();

    /**
     * Connect Database
     */
    public function __construct() {
        try {
            $this->_DB = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
            $this->_DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

    /**
     * Where condition
     * @param  string $column_name table column name
     * @param  mix $value       Value to match in column
     * @return none
     */
    public function where($column_name, $value, $operator = '=') {
        $this->_where[$column_name] = array();
        $this->_where[$column_name][] = $value;
        $this->_where[$column_name][] = $operator;
    }

    /**
     * Define columns to select
     * @param array $columns
     */
    public function select($columns) {
        foreach ($columns as $column => $name) {
            $this->_select[$column] = $name;
        }
    }

    /**
     * Bind params, alias where()
     * in query use :param after binding.
     * @param  array $data array('param'=>'value')
     * @return none       
     */
    public function bind($data) {
        foreach ($data as $key => $value) {
            where($key, $value);
        }
    }

    /**
     * Returns the ID of the last inserted row or sequence value 
     * @param strinf $name Name of the sequence object from which the ID should be returned. 
     * @return Int
     */
    public function last_id($name = NULL) {
        return $this->_DB->lastInsertId($name);
    }

    /**
     * Custom query method, please bind prams first
     * @param  String $query mysql query
     * @return none        
     */
    public function query($query) {
        // echo $query;
        try {
            $this->_query = $this->_DB->prepare(filter_var($query, FILTER_SANITIZE_STRING));
            $this->bind_results();
            $this->_query->execute();

            // Reset
            $this->_where = array();
            $this->_select = array();
            $this->_data = array();
            $this->_joins = array();


            // $this->_query = '';
            // unset($this->_action, $this->_where, $this->_limit, $this->_table, $this->_select, $this->_joins);
        } catch (PDOException $e) {
            // print_f($e)
            $er = $e->errorInfo;
            echo '<p style="font-family:arial; background:#F00; position:absolute; z-index:10000; color:#FFF; padding:5px;">ERROR: ' . $er[2] . '</p>';
        }
    }

    /**
     * Bind params and data values
     * @return none
     */
    public function bind_results() {
        if (!empty($this->_where)) {
            $ci = 0;
            foreach ($this->_where as $c => $value) {
                // $cn = $c;
                $ci++;
                if (strpos($c, '.')) {
                    $c = explode('.', $c);
                    $c = $c[1];
                }

                $this->_query->bindValue(':' . $c.$ci, $value[0], $this->get_type($value[0]));
            }
        }

        if (!empty($this->_data)) {
            $i = 0;
            foreach ($this->_data as $c => $value) {
                $this->_query->bindValue(':' . $c . $i, $value, $this->get_type($value));
                $i++;
            }
        }
    }

    /**
     * Check data type of a valuse to use in bind_result()
     * @param  mix $value param or data value
     * @return PDOdataType
     */
    public function get_type($value) {
        if (is_int($value)) {
            $param = PDO::PARAM_INT;
        } elseif (is_bool($value)) {
            $param = PDO::PARAM_BOOL;
        } elseif (is_null($value)) {
            $param = PDO::PARAM_NULL;
        } elseif (is_string($value)) {
            $param = PDO::PARAM_STR;
        } else {
            $param = FALSE;
        }
        return $param;
    }

    /**
     * Create JOIN statment
     * @param String $table_name
     * @param String $override_name
     * @param String $join_type
     * @param array $match
     * @param array $select
     */
    public function join($table_name, $override_name, $join_type = 'INNER JOIN', $match, $select = NULL) {
        // $conditions = array();
        // foreach ($match as $key1 => $key2) {
        //     $conditions[] = $key1 . '=' . $key2;
        // }
        if(isset($select))
        $this->select($select);
        // $this->_joins[] = $join_type . ' ' . $table_name . ' AS ' . $override_name . ' ON ' . implode(' AND ', $conditions);
        $this->_joins[] = $join_type . ' ' . $table_name . ' AS ' . $override_name . ' ON ' . $match;
    }

    /**
     * Create INNER JOIN statement
     * @param String $table_name
     * @param String $override_name
     * @param array $match
     * @param array $select
     */
    public function inner_join($table_name, $override_name, $match = array(), $select = NULL) {
        $this->join($table_name, $override_name, 'INNER JOIN', $match, $select);
    }

    /**
     * Create LEFT JOIN statement
     * @param String $table_name
     * @param String $override_name
     * @param array $match
     * @param array $select
     */
    public function left_join($table_name, $override_name, $match = array(), $select = NULL) {
        $this->join($table_name, $override_name, 'LEFT JOIN', $match, $select);
    }

    /**
     * Create RIGHT JOIN statement
     * @param String $table_name
     * @param String $override_name
     * @param array $match
     * @param array $select
     */
    public function right_join($table_name, $override_name, $match = array(), $select = NULL) {
        $this->join($table_name, $override_name, 'RIGHT JOIN', $match, $select);
    }

    /**
     * Build query before execute, Using the params, datas and requested query functions
     * @return none
     */
    public function build_query() {
        $query = $this->_action;
        if ($this->_action == 'SELECT') {
            if (!empty($this->_select)) {
                foreach ($this->_select as $column_name => $name) {
                    $query .=' ' . $column_name . ' as ' . $name . ', ';
                }
            } else {
                $query .= ' *';
            }
            $query = rtrim($query, ', ');
        }
        if ($this->_action != 'UPDATE' && $this->_action != 'INSERT') {
            $query .= ' FROM ';
        }
        if ($this->_action == 'INSERT') {
            $query .= ' INTO';
        }
        $query .= $this->_table;

        if (!empty($this->_joins)) {
            $query .= ' ';
            $query .= implode(' ', $this->_joins);
        }
        if ($this->_action == 'UPDATE') {
            $query .= ' SET ';
            $query .= $this->build_update_data();
        }
        if (!empty($this->_where)) {
            $query .= ' WHERE ';
            $columns = array();

            $ci = 0;
            foreach ($this->_where as $c => $v) {
                $cn = $c;
                $ci++;
                if (strpos($c, '.')) {
                    $c = explode('.', $c);
                    $c = $c[1];
                }

                $columns[] = $cn . ' ' . $v[1] . ' :' . $c.$ci;
            }
            $query .= implode(' AND ', $columns);
        }
        if ($this->_action == 'INSERT') {
            $query .= ' (';
            foreach ($this->_data as $c => $v) {
                $query .= $c . ", ";
            }
            $query = rtrim($query, ', ');
            $query .= ') VALUE (';
            $i = 0;
            foreach ($this->_data as $c => $v) {
                $query .= ":" . $c . $i . ", ";
                $i++;
            }
            $query = rtrim($query, ', ');
            $query .= ')';

        }
        if ($this->_action != 'INSERT' && !empty($this->_limit)) {
            $query .= ' LIMIT ' . $this->_limit;
        }
        $this->query($query);
    }

    /**
     * Build query to update data
     * @return string query part to use in build_query
     */
    public function build_update_data() {
        $fields = '';
        $i = 0;

        foreach ($this->_data as $c => $v) {
            $fields .= $c . " = :" . $c . $i . ", ";
            $i++;
        }

        // echo $fields ; exit;
        return rtrim($fields, ', ');
    }


    /**
     * Fetch single row, use while loop to fetch by row
     * while($row = result)
     * @return Object single object
     */
    public function result($fetch_type = PDO::FETCH_OBJ) {
        return $this->_query->fetch($fetch_type);
    }

    /**
     * Fetch all results in onces
     * @return array 
     */
    public function all_results($fetch_type = PDO::FETCH_OBJ) {
        return $this->_query->fetchAll($fetch_type);
    }

    /**
     * Get effected row counts
     * @return Int 
     */
    public function row_count() {
        return $this->_query->rowCount();
    }

    /**
     * Select result from specific table
     * @param  String $table_name
     * @param  Int $num_rows   How many rows to select
     * @return none             
     */
    public function from($table_name, $num_rows = NULL) {
        $this->_action = 'SELECT';
        $this->_table = $table_name;
        $this->_limit = $num_rows;
        $this->build_query();
    }

    /**
     * Insert row into database
     * @param  Strin $table_name 
     * @param  array $data       array('column'=>'value')
     * @return none             
     */
    public function insert($table_name, $data) {
        $this->_action = 'INSERT';
        $this->_table = ' ' . $table_name;
        $this->_data = $data;
        $this->build_query();
    }

    /**
     * Update row
     * @param  String $table_name 
     * @param  array $data        array('column'=>'value')
     * @return none
     */
    public function update($table_name, $data) {
        $this->_action = 'UPDATE';
        $this->_table = ' ' . $table_name;
        $this->_data = $data;
        $this->build_query();
    }

    /**
     * Delete row
     * @param String $table_name
     * @param Int $num_rows How many rows to select
     * @return none
     */
    public function delete($table_name, $num_rows = NULL) {
        $this->_action = 'DELETE';
        $this->_table = ' ' . $table_name;
        $this->_limit = $num_rows;
        $this->build_query();
        return $this->row_count();
    }

    /**
     * Custom date format or current date with time
     * @param  string $format formate
     * @param  string $date   old date
     * @return string         formated date
     */
    public function _date($format = 'Y-m-d H:i:s', $date = NULL) {
        if (isset($date)) {
            $date = strtotime($date);
        } else {
            $date = time();
        }
        return date($format, $date);
    }
}
