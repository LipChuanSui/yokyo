<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sports extends CI_Controller {

  public function create_sport(){
    if(!$this->session->userdata('logged_in')){
            redirect('users/login');
    }

    $data['title'] = 'Create Sports';

    $this->form_validation->set_rules('sport_name', 'Sport Name', 'required|callback_check_sport_exists');

    if($this->form_validation->run() === FALSE){
      $this->load->view('templates/header');
      $this->load->view('sport/create_sport', $data);
      $this->load->view('templates/footer');
    }else{
      $config['upload_path'] = './assets/images/sports/';
			$config['allowed_types'] = 'png';

				$this->load->library('upload', $config);

				if(!$this->upload->do_upload('userfile')){
					$errors = array('error' => $this->upload->display_errors());
          $this->session->set_flashdata('event_created', implode("",$errors));
          redirect('sports/create_sport');

					//$sport_image = 'noimage.jpg';
				} else {
					$data = array('upload_data' => $this->upload->data());
					$sport_image = $_FILES['userfile']['name'];
				}

      $this->sport_model->create_sport($sport_image);
      $this->session->set_flashdata('event_created', 'New sport has been created!');
      redirect('timetable');
    }
  }

  // Check if sport exists
  public function check_sport_exists($title){
    $this->form_validation->set_message('check_sport_exists', 'The sport is already been created.');
    if($this->sport_model->check_sport_exists($title)){
      return true;
    } else {
      return false;
    }
  }



}
?>
