<?php


class Supplier {

    private $_fdb,
            $_fdata;

    public function __construct($view = null){
        $this->_fdb = DB::getInstance();
        
    }

    public function create($fields = array()){
        if(!$this->_fdb->insert('suppliers', $fields)){
            throw new Exception('Three was a problem creating an account');
        }
    }

    public function update($fields = array(), $id = null){
        if(!$id && $this->isLoggedIn()){
            $id = $this->fdata()->id;
        }

        if(!$this->_fdb->update('suppliers', $id, $fields)){
            throw new Exception('There was a problem updating.');
        }
    }

    // find and set users data to _data
    public function find($view = null){
        if($view){
            $field = (is_numeric($view)) ? 'id' : 'supplier_code';
            $data = $this->_fdb->get('suppliers', array($field, '=', $user));

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

    public function search($same, $keyword, $field){
        $search = DB::getInstance()->query("SELECT * FROM suppliers WHERE $same = '$keyword'");
        foreach($search->results() as $s) {
          return $s->$field;
        }
    }


        // $sd = 't001';
        // echo $supplier->search('supplier_code', $sd, 'f_name');


} 