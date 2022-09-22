<?php 

class Subscriptions_model extends CI_Model

{


    public function subscription_data()

    {
       $query = $this->db->query(" SELECT * FROM subscription WHERE status=1");
       return $query->result_array();

    }

   






   


  }

