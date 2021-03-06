<?php


class Validation {

    private $_passed = false,
            $_errors = array(),
            $_db     = null;

    public function __construct(){
        $this->_db = DB::getInstance();
    }

    public function check($source, $items = array()){
        foreach($items as $item => $rules){
            foreach($rules as $rule => $rule_value){

                $value = trim($source[$item]);
                $item = escape($item);

                if($rule === 'required' && empty($value)){
                    $this->addError("{$item} is rquired.");
                }else if(!empty($value)){
                    switch($rule){
                        case 'min':
                            if(strlen($value) < $rule_value){
                                $this->addError("{$item} must be a minimum of {$rule_value} characters.");
                            }
                            break;
                        case 'max':
                            if(strlen($value) > $rule_value){
                                $this->addError("{$item} should not exceed {$rule_value} characters.");
                            }
                            break;
                        case 'matches':
                            if($value != $source[$rule_value]){
                                $this->addError("{$rule_value} must match {$item}");
                            }
                            break;
                        case 'unique':
                            $check = $this->_db->get($rule_value, array($item, '=', $value));
                            if($check->count()){
                                $this->addError("{$item} already exists.");
                            }
                            break;
                        case 'notmatch':
                            $check = $this->_db->get($rule_value, array($item, '=', $value));
                            if(!$check->count()){
                                $this->addError("{$item}".' '.'not registered in our system. <a href="supplier_registation.php"><i class="fa fa-user-plus"></i>  Add Suppliers</a>');
                            }
                            break;
                        case 'num':
                            if(!is_numeric($value)){
                                $this->addError("This {$item} not a number");
                            }
                            break;
                        
                   //     case 'nic':
                      //      if(strlen($value))
                    } 
                }
            }
        }

        if(empty($this->_errors)){
            $this->_passed = true;
        }

        return $this;
    }

    private function addError($error){
        $this->_errors[] = $error;
    }

    public function errors(){
        return $this->_errors;
    }

    public function passed(){
        return $this->_passed;
    }

} 

?> 