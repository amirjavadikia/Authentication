<?php



class CustomError{
    protected $error = [];

    public function set_error($key,$desc){
        return $this -> error[$key][] = $desc;
     }
    public function has_error($field){
        return isset($this -> error[$field]);
    }
    public function count_error(){
        return count( $this -> error);
    }
    public function key_error($key){
        if($this -> has_error($key)){
            return $this -> error[$key][0];
        }
        return null;
    }
}