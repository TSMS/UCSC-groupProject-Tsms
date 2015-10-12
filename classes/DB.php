<?php

class DB {
    private static $_instance = null;
    private     $_pdo,
                $_query,
                $_error = false,
                $_results,
                $_count = 0;

    public function __construct(){
        try{
            // PDO(String, username, password)
            $this->_pdo = new PDO('mysql:host='.Config::get('mysql/host').';dbname='.Config::get('mysql/db'), Config::get('mysql/username') , Config::get('mysql/password'));
            //$this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }

    // Following a singleton pattern
    public static function getInstance(){

        if(!isset(self::$_instance)){
            self::$_instance = new DB();
        }

        return self::$_instance;
    }

    public function query($sql, $params = array()){

        // pending
        $this->_error = false;

        if($this->_query = $this->_pdo->prepare($sql)){
            $x = 1;
            if(count($params)){
                foreach($params as $param){
                    $this->_query->bindValue($x, $param);
                    $x++;
                }
            }

            if($this->_query->execute()){
                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();
            }else{
                $this->_error = true;
            }
        }

        return $this;
    }

    private function action($action, $table, $where = array()){

        if(count($where) === 3){
            $operators = array('=', '>', '<', '>=', '<=');

            $field      = $where[0];
            $operator   = $where[1];
            $value      = $where[2];

            if(in_array($operator, $operators)){
                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";
                if(!$this->query($sql, array($value))->error()){
                    return $this;
                }
            }
        }else {
            $sql = "{$action} FROM {$table}";
            if(!$this->query($sql)->error()) {
                return $this;
            }
        }

        return false;
    }

    public function get($table, $where){
        return $this->action('SELECT *', $table, $where);
    }

    public function getAll($table) {
        return $this->action('SELECT *', $table);
    }

    public function delete($table, $where = array()){
        return $this->action('DELETE', $table, $where);
    }

    /*
     * return true/false
     * */
    // Insert into Table
    public function insert($table, $fields = array()){

        if(count($fields)){
            $keys   = array_keys($fields);
            $values = '';
            $x      = 1;

            foreach($fields as $field){
                $values .= '?';
                if($x < count($fields)){
                    $values .= ', ';
                }
                $x++;
            }

            $sql = "INSERT INTO {$table} (".implode(', ', $keys).") VALUES ({$values})";


            if(!$this->query($sql, $fields)->error()){
                return true;
            }
        }

        return false;
    }

    public function update($table, $id, $fields){
        $set = '';
        $x = 1;

        foreach($fields as $name => $value){
            $set .= "{$name} = ?";
            if($x < count($fields)) {
                $set .= ', ';
            }
            $x++;
        }

        $sql = "UPDATE {$table} SET {$set} WHERE id = {$id}";

        if(!$this->query($sql, $fields)->error()){
            return true;
        }
    }

    public function raw($sql){
        $this->result = $this->db->query($sql);
        return $this;
    }

    static protected function _is_plain($data){
        if ( ! is_scalar($data))
            return false;
        return is_string($data)? ! preg_match( '/\W/i',$data) : true;
    }

    static protected function _is_list(array $array){
        foreach ( array_keys($array) as $key)
            if ( ! is_int($key))
                return false;
        return true;
    }
    /* Remove all (inline & multiline bloc) comments from SQL query
     * @param  string $sql SQL query string
     * @return string SQL query string without comments
     */
    static protected function _uncomment ( $sql ) {
        /* '@
        (([\'"`]).*?[^\\\]\2) # $1 : Skip single & double quoted expressions
        |(                    # $3 : Match comments
          (?:\#|--).*?$       # - Single line comments
          |                   # - Multi line (nested) comments
          /\*                 #   . comment open marker
            (?: [^/*]         #   . non comment-marker characters
              |/(?!\*)        #   . ! not a comment open
              |\*(?!/)        #   . ! not a comment close
              |(?R)           #   . recursive case
            )*                #   . repeat eventually
          \*\/                #   . comment close marker
        )\s*                  # Trim after comments
        |(?<=;)\s+            # Trim after semi-colon
        @msx' */
        return trim( preg_replace( '@(([\'"`]).*?[^\\\]\2)|((?:\#|--).*?$|/\*(?:[^/*]|/(?!\*)|\*(?!/)|(?R))*\*\/)\s*|(?<=;)\s+@ms', '$1', $sql ) );
    }

    /**
     * Format query parameters
     * @uses   self::_escape
     * @param  string|array $data     Data to format
     * @param  string       $operator [Optional] 
     * @param  string       $glue     [Optional] 
     * @return string       SQL params query chunk
     * @todo   Handle integer keys like in self::_conditions
     */
    static protected function _params ( $data, $operator = '=', $glue = ', ' ) {
        $params = is_string( $data) ? array( $data ) : array_keys( (array) $data );
        foreach ( $params as &$param )
            $param = implode( ' ', array( self::_escape( $param ), $operator, ':' . $param ) );
        return implode( $glue, $params );
    }

    public function error(){
        return $this->_error;
    }

    public function count(){
        return $this->_count;
    }

    public function results(){
        return $this->_results;
    }

    public function first(){
        return $this->results()[0];
    }

    public function pre(){
        echo '<pre>';
        var_dump($this);
        echo '</pre>';
    }

    public function simple(){
        echo '<pre>';
        print_r($this);
        echo '</pre>';
    }





} 