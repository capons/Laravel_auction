<?php
namespace App\Library;


    class UpBid
    {
        private $sql_data = array();
        private $update_val = '';
        private $update_key = '';
        private $update_sql = array();
        public function test($array)
        {
            $this->sql_data = $array;
            if(is_array($this->sql_data)){
                if(count($this->sql_data) == 1){ //if auction have only 1 winner

                    $this->update_val = reset($this->sql_data);
                    $this->update_key = key($this->sql_data);
                    $this->update_sql['check_data']['user_id'] =  $this->update_key;
                    $this->update_sql['check_data']['user_old_bit'] =  $this->update_val;
                    return $this->update_sql;
                } else {                        //if auction have multiple winner
                    asort($this->sql_data);
                    $this->update_val = reset($this->sql_data);
                    $this->update_key = key($this->sql_data);
                    $this->update_sql['update_data']['user_id'] =  $this->update_key;
                    $this->update_sql['update_data']['user_old_bit'] =  $this->update_val;
                    $this->update_val = end($this->sql_data);
                    $this->update_key = key($this->sql_data);
                    $this->update_sql['check_data']['user_id'] =  $this->update_key;
                    $this->update_sql['check_data']['user_old_bit'] =  $this->update_val;
                    return $this->update_sql;

                }
            }
        }
    }