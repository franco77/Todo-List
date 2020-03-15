
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
		public function __construct(){
			parent::__construct();
			$this->load->model('welcome_model', 'welcomeDB');
		}

	public function index()
	{		$result =$this->welcomeDB->getTodos();
		$data = array(
			"result"  => $result
		);

		$this->load->view('home', $data);
	}

	
	public function getTodos()
	{	
		 return $this->welcomeDB->getTodos();
	}
	

	public function setTodos()
	{	
		
		 return $this->welcomeDB->setTodos();
	}


	public function updateTodos($id)
	{
		 return $this->welcomeDB->updateTodos($id);
	}

	public function updateTodosToggle($id)
	{
		 return $this->welcomeDB->updateTodosToggle($id);
	}

	public function deleteTodos($id)
	{
		 return $this->welcomeDB->deleteTodos($id);
	}


	public function AjaxSearch($query='')
	{
		if ($query == ''){
			echo 'please type something';
	}else {
		return $this->welcomeDB->AjaxSearch($query);
		}
 	}
		



	public function getTodos_Json(){

        $data['result']=$this->getTodos();

        print_r(json_encode($data));

     }
	
}
