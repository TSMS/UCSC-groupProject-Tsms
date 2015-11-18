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

    public function sms($id){
        $sql = $sql = "UPDATE  `message` SET  `read` =1 WHERE  `id` =  $id";
        if(!$this->query($sql, $fields)->error()){
            return true;
        }

    }

    

    public function sum($field)  {
        if($field)
        return $this->db->single("SELECT sum(" . $field . ")" . " FROM " . $this->table);
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

    public function first($n = 0){
        return $this->results()[$n];
    }

    public function pre(){
        echo '<pre>';
        var_dump($this);
        echo '</pre>';
    }


    public function selectoder($table, $rows = '*', $where = null, $order = null)
    {
        $q = 'SELECT '.$rows.' FROM '.$table;
        if($where != null)
            $q .= ' WHERE '.$where;
        if($order != null)
            $q .= ' ORDER BY '.$order;
        if($this->tableExists($table))
       {
        $query = @mysql_query($q);
        if($query)
        {
            $this->numResults = mysql_num_rows($query);
            for($i = 0; $i < $this->numResults; $i++)
            {
                $r = mysql_fetch_array($query);
                $key = array_keys($r); 
                for($x = 0; $x < count($key); $x++)
                {
                    // Sanitizes keys so only alphavalues are allowed
                    if(!is_int($key[$x]))
                    {
                        if(mysql_num_rows($query) > 1)
                            $this->result[$i][$key[$x]] = $r[$key[$x]];
                        else if(mysql_num_rows($query) < 1)
                            $this->result = null; 
                        else
                            $this->result[$key[$x]] = $r[$key[$x]]; 
                    }
                }
            }            
            return true; 
        }
        else
        {
            return false; 
        }
        }
    else
      return false; 
    }

    public function Getsum($tatol, $table ,$sup_code){

        $query = $this->_pdo->prepare("SELECT SUM($tatol) FROM $table WHERE `supplier_code` = ?" );
        $query->bindValue(1, $sup_code);

        try{ $query->execute();   

        $total = $query->fetch(PDO::FETCH_NUM);
        $summ = $total[0]; // 0 is the first array. here array is only one.
        return $summ; 

        } catch(PDOException $e){
            die($e->getMessage());
        }   
    }
    public function search($same, $keyword, $field){
        $search = DB::getInstance()->query("SELECT * FROM users WHERE $same = '$keyword'");
        foreach($search->results() as $s) {
          return $s->$field;
        }
    }

} 