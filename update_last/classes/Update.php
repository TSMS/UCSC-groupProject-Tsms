<?php


class Update {

    private $_udb,
            $_udata;

    public function __construct($up = null){
        $this->_udb = DB::getInstance();
        
    }

    public function create($fields = array()){
        if(!$this->_udb->insert('today_supply', $fields)){
            throw new Exception('Three was a problem creating');
        }
    }

    public function addtodayservice($fields = array()){
        if(!$this->_udb->insert('today_service', $fields)){
            throw new Exception('Three was a problem today supply');
        }
    }


    public function update($fields = array(), $id = null){
        if(!$id && $this->isLoggedIn()){
            $id = $this->fdata()->id;
        }

        if(!$this->_udb->update('today_supply', $id, $fields)){
            throw new Exception('There was a problem updating.');
        }
    }

    // find and set users data to _data
    public function find($view = null){
        if($view){
            $field = (is_numeric($view)) ? 'id' : 'username';
            $data = $this->_udb->get('today_supply', array($field, '=', $user));

            if($data->count()){
                $this->_fdata = $data->first();
                return true;
            }
        }

        return false;
    }

    public function data(){
        return $this->_fdata;
    }

    public function exists(){
        return (!empty($this->_fdata)) ? true : false;
    }

    public function search($table, $same, $keyword, $field){
        $search = DB::getInstance()->query("SELECT * FROM $table WHERE $same = '$keyword'");
        if(!$search->count()){
            echo '<p class="alert text-yellow">There is no '.$field.' data to retrive</p>';
        }else{
            foreach($search->results() as $s) {
                return $s->$field;
            }
        }
    }
} 