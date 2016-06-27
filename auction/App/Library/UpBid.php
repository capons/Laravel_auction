<?php
namespace App\Library;


    class UpBid
    {
        private $sql_data = array();
        private $update_val = '';
        private $update_key = '';
        private $update_sql = array();
        public function changeBid($array)
        {
            //$this->sql_data = $array;
                if(count($array) == 1){ //if auction have only 1 winner
                    foreach($array as $row){
                        $this->sql_data[$row['winner_id']] = $row['bid'];
                    }

                    $this->update_val = reset($this->sql_data);
                    $this->update_key = key($this->sql_data);
                    $this->update_sql['check_data']['user_id'] =  $this->update_key;
                    $this->update_sql['check_data']['user_old_bid'] =  $this->update_val;
                    $this->update_sql['update_data']['user_id'] = $this->update_key;
                    $this->update_sql['update_data']['user_old_bid'] =  $this->update_val;
                    return $this->update_sql;
                } else {                        //if auction have multiple winner
                    asort($this->sql_data);
                    $this->update_val = reset($this->sql_data);
                    $this->update_key = key($this->sql_data);
                    $this->update_sql['update_data']['user_id'] =  $this->update_key;
                    $this->update_sql['update_data']['user_old_bid'] =  $this->update_val;
                    $this->update_val = end($this->sql_data);
                    $this->update_key = key($this->sql_data);
                    $this->update_sql['check_data']['user_id'] =  $this->update_key;
                    $this->update_sql['check_data']['user_old_bid'] =  $this->update_val;
                    return $this->update_sql;

                }
            }
    }