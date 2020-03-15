<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class welcome_model extends CI_Model {

        public $name;
        public $date;
        public $status;
   

    public function getTodos()
    { $query = $this->db->get('todos');
        $result = $query->result_array();
            return $result;
    }

    public function setTodos()
    {
            $this->name    = $_POST['name']; 
            $this->date  =  NOW;
            $this->status     = 0;

            $this->db->insert('todos', $this);
    }

    public function updateTodos($id)
    {
            $this->name    = $_POST['name']; 
            $this->date  =  NOW;
            $this->status     = $_POST['status'];
            $this->db->update('todos', $this, array('id' => $id));
    }


    public function updateTodosToggle($id)
    {       $this->name    = $_POST['name']; 
            $this->status     = $_POST['status'];
            $this->db->update('todos', $this, array('id' => $id));
    }


    public function deleteTodos($id)
    {
            $this->id    = $id; 
            $this->db->delete('todos', array('id' => $id)); 
    }


    public function AjaxSearch($query)
    {
            if ($query == ''){
                    echo 'please type something';
            }else {
                $this->db->select("*");
                $this->db->from("todos");
                $this->db->like('name', $query); 
                $this->db->order_by('name', 'DESC');
                //$this->db->limit(5);
                $quer2y= $this->db->get();
                $quer2y2= $quer2y->result_array();
                echo json_encode($quer2y2);
            }
        
        }
}