<?php
class AuthenticationModel extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function login($data) {
        if($this->db->where('email',$data['email'])->get('users')->num_rows() == 1)
    	{
            //checks for email id and password combination in database
            $con = "email ="."'".$data['email']."' AND password ="."'".$data['password']."'";
            // echo $con;die;
    		$query = $this->db->get_where('users',$con,1);

            //if both are true proceed
    		if($query->num_rows() != 0) 
    		{
                //check for users verified  or not
    			$q = "email ="."'".$data['email']."' AND verified = 1";
    			$query1 = $this->db->get_where('users',$q);

                //if verified proceed
    			if($query1->num_rows() != 0 )
    			{
    			    //check for users activated  or not
        			$q = "email ="."'".$data['email']."' AND status = 0";
        			$query2 = $this->db->get_where('users',$q);
    			    if($query2->num_rows() != 0 )
    			    {
    			    
        				$verified = $query2->result();                      
                        $session_data = array(               
                            'email'         => $verified[0]->email,
                            'name'          => $verified[0]->name,
                            'id'            => $verified[0]->id,
                            'mobile_no'     => $verified[0]->mobile_no,
                            'last_name'     => $verified[0]->last_name,
                            'profile_img'   => $verified[0]->profile_img,
                            'type'          => $verified[0]->type,
                            'admin_role_id' => $verified[0]->admin_role_id
                        );
                        switch ($session_data['type']) {
                            case '1':
                                    $this->session->set_userdata('fi_session',$session_data);
                                    redirect('fi_home');
                                    break;
                            case '2':
                                    // Add user data in session, start session
                                    $this->session->set_userdata('hod_session',$session_data);
    
                                    //redirect user to user specific controller
                                    redirect('hod');
                                    break;
    
                            case '3':
                                    // Add user data in session, start session
                                    $this->session->set_userdata('mr_session',$session_data);
    
                                    //redirect user to user specific controller
                                    redirect('mr');
                                    break;
    
                            case '4':
                                    // Add user data in session, start session
                                    $this->session->set_userdata('dr_session',$session_data);
    
                                    //redirect user to user specific controller
                                    redirect('director');
                                    break;
    
                            default:
                                # code...
                                break;
                        }
    			    }
    			    
    			    return 5;
    			}

                //return 2 if user not verified
    			return 2;
    		}

            //return 3 if username/password combination is wrong
    		return 3;
        }

        //return 4 if user not exists
        return 4;
    }
}
?>
