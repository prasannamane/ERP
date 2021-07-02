<?php
    
class DashboardModel extends CI_Model {

    function __construct(){
        
        parent::__construct();
        //initialise the autoload things for this class
        }

    public function all_upcoming_task($id) {

        if($id) {
            $id = "i.invoice_id='".$id."' AND ";
            }
        else{
                $id = '';
            }

        
         $where_con_task= $id.'task_date_started <= DATE_ADD(CURDATE(), INTERVAL 5 DAY) ORDER by i.task_id DESC';
         return $this->db->select('i.task_id, i.task_date_started, a.name as type_name,ad.name as sub_name')
        ->join("adm_task_type a", "i.task_type=a.id",'left')
        ->join("adm_subtask_type ad", "i.sub_task_type=ad.id",'left')
        ->where($where_con_task)
        //->where($id.'task_date_started <= DATE_ADD(CURDATE(), INTERVAL 5 DAY) ORDER by i.task_id DESC')
        ->get('invoice_task i')
        ->result_array();

    
        
        }

    public function all_upcomming_event($id) {

        if($id) {
            $id = "cus_id ='".$id."' AND event_date >= CURDATE()";
            }
        else{
                $id = 'event_date >= CURDATE()';
            }

        //AND event_date <= DATE_ADD(CURDATE(), INTERVAL 2 WEEK)  'event_date >= CURDATE()'

             return $this->db->select('r.cus_id,r.event_id,r.event_type,r.event_name,r.event_date,r.event_note, e.event_id as e_event_id')
            ->join('event_location e', 'e.event_id=r.event_id', 'left')    
            ->where($id )
            ->order_by("r.event_id", "DESC")
          
            ->get('events_register r')->result_array();


      /*  return $this->db->select('cus_id,event_id,event_type,event_name,event_date')
        ->where($id.' event_date >= CURDATE() ORDER by event_id DESC') // ORDER by event_id DESC
        ->get('events_register')
        ->result_array();
*/
    
        
        }


            
    }