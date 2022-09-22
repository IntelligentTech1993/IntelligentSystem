<?php 
class my_dashboard_model extends CI_Model{
	
	
    
    public function profile($userid)
    {
        $query = $this->db->query("SELECT * FROM `members` WHERE `USERID` = '".$userid."' AND `verified` = 0 AND `status` = 0 ;");
        $result = $query->row_array();
        return $result;          
    }

    public function get_mysubscription($userid)
    {
        $query = $this->db->query("SELECT id,username,currency_type,subscription_gigs,subscription_period,subscription_name,subscription_amount,expired_date, IF(TIMESTAMPDIFF(DAY, '".date('Y-m-d H:i:s')."', expired_date)=0, '1', TIMESTAMPDIFF(DAY, '".date('Y-m-d H:i:s')."', expired_date))  AS 'expire_days' FROM subscriptions_payments as s

                                    JOIN members m on m.USERID = s.userid 

                                    WHERE s.expired_date >= '".date('Y-m-d H:i:s')."' AND s.status = 1 AND s.subscription_payment_status = 1 AND s.userid = '".$userid."'");

        return $query->result_array();
    }

     public function subscription_count()
    {
        $query = $this->db->query("SELECT id
        FROM  `subscription` 
        WHERE STATUS =1");
                $result = $query->num_rows();
                return $result;
    }
    
    
    
    
}   
?>