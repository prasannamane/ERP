<?php  
 defined('BASEPATH') OR exit('No direct script access allowed');  
 class Crud extends CI_Controller {  
      //functions  
      public function index(){  
           $data["title"] = "Codeigniter Ajax CRUD with Data Tables and Bootstrap Modals";  
           $this->load->view('crud/crud_view', $data);  
      }  
      public function fetch_user(){  
           $this->load->model("Crud_model");  
           $fetch_data = $this->Crud_model->make_datatables();
           //print_r($fetch_data);
           $data = array();  
           foreach($fetch_data as $row)  
           {  
                $i=1;
                $sub_array = array();  
                //$sub_array[] = '<img src="'.base_url().'upload/'.$row->image.'" class="img-thumbnail" width="50" height="35" />';  
                //$sub_array[] = $i;
                $sub_array[] = $row->firstname;  
                $sub_array[] = $row->lastname;  
                $sub_array[] = $row->email;  
                $sub_array[] = $row->mobileno;
                $sub_array[] = $row->wallet_balance;
                $sub_array[] = '<a href="'.site_url('crud/addwalletbal/').''.$row->id.'" class ="btn btn-primary btn-xs"><i class="fa fa-money"></i>Add Money</a>';  
                $sub_array[] = '<button type="button" name="delete" id="'.$row->id.'" class="btn btn-danger btn-xs">Delete</button>';  
                $data[] = $sub_array;  
                $i++;
           }  
           $output = array(  
                "draw"                    =>     intval($_POST["draw"]),  
                "recordsTotal"          =>      $this->Crud_model->get_all_data(),  
                "recordsFiltered"     =>     $this->Crud_model->get_filtered_data(),  
                "data"                    =>     $data  
           );  
           echo json_encode($output);  
      }

      public function addwalletbal($id)
        {
          print_r($id);die;
        }  
 }  