<?php


class View {

    private $_fdb,
            $_fdata;

    public function __construct($view = null){
        $this->_fdb = DB::getInstance();
        
    }

    public function create($fields = array()){
        if(!$this->_fdb->insert('users', $fields)){
            throw new Exception('Three was a problem creating an account');
        }
    }

    public function update($fields = array(), $id = null){
        if(!$id && $this->isLoggedIn()){
            $id = $this->fdata()->id;
        }

        if(!$this->_fdb->update('supply', $id, $fields)){
            throw new Exception('There was a problem updating.');
        }
    }

    // find and set users data to _data
    public function find($view = null){
        if($view){
            $field = (is_numeric($view)) ? 'id' : 'username';
            $data = $this->_fdb->get('supply', array($field, '=', $user));

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

    public function apprved_user($key){
        $apprve = $this->_fdb->get('user_approved', array('id', '=', $this->data()->user_approved));
        if($apprve->count()){
            $approvedd = json_decode($apprve->first()->approvedd, true);

            if(isset($approvedd[$key])){
                if($approvedd[$key] == 1){
                    return true;
                }
            }
        }

        return false;
    }

} 