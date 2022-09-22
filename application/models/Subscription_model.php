<?php 

class Subscription_model extends CI_Model

{



    public function subscriptions()

    { 



        $where = array();

        $where['subscription_name'] = $this->input->post('subscription_name');

        $where['subscription_period'] = $this->input->post('subscription_period');

        $where['period_type'] = $this->input->post('period_type');

        $where['no_of_gigs'] = $this->input->post('no_of_gigs');

        $where['subscription_rate'] = $this->input->post('subscription_rate');

        $this->db->where($where);

        $record = $this->db->count_all_results('subscription');

        

        if($record == 1)

        {

            return false;

        }else{  



        $data = array(

        'subscription_name' => trim($this->input->post('subscription_name')),

        'subscription_period' => trim($this->input->post('subscription_period')),

        'period_type' => trim($this->input->post('period_type')),

        'no_of_gigs' => trim($this->input->post('no_of_gigs')),

        'subscription_rate' => trim($this->input->post('subscription_rate')),

        'status' => 1

        );



       $result = $this->db->insert('subscription',$data);

        return $result;

        }

    }

    public function subscription_data()

    {

        $query = $this->db->query(" SELECT * FROM subscription");

        return $query->result_array();

    }

    public function get_allsubscribers()
    {
        $query = $this->db->query("SELECT id,username,currency_type,subscription_period,subscription_gigs,subscription_name,subscription_amount,expired_date,created_at, IF(TIMESTAMPDIFF(DAY, '".date('Y-m-d H:i:s')."', expired_date)=0, '1', TIMESTAMPDIFF(DAY, '".date('Y-m-d H:i:s')."', expired_date))  AS 'expire_days' FROM subscriptions_payments as s

                                    JOIN members m on m.USERID = s.userid 

                                    WHERE s.expired_date >= '".date('Y-m-d H:i:s')."' AND s.status = 1 AND s.subscription_payment_status = 1");

        return $query->result_array();
    }

    public function get_allexpired_subscribers()
    {
         $query = $this->db->query("SELECT id,username,currency_type,subscription_period,subscription_gigs,subscription_name,subscription_amount,expired_date,created_at, IF(TIMESTAMPDIFF(DAY, '".date('Y-m-d H:i:s')."', expired_date)=0, '1', TIMESTAMPDIFF(DAY, '".date('Y-m-d H:i:s')."', expired_date))  AS 'expire_days' FROM subscriptions_payments as s

                                    JOIN members m on m.USERID = s.userid

                                    WHERE s.expired_date <= '".date('Y-m-d H:i:s')."' AND s.subscription_payment_status = 1 ");

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


       public function check_subscription($subscription)
    {
        $query = $this->db->query("SELECT * FROM `subscription` WHERE `subscription_name` =  '$subscription';");
        $result = $query->num_rows();
        return $result;                      
    }

       public function check_subscription_rate($subscription_rate)
    {
        $query = $this->db->query("SELECT * FROM `subscription` WHERE `subscription_rate` =  '$subscription_rate';");
        $result = $query->num_rows();
        return $result;                      
    }


  }

