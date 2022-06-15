<?php
	class Timetable extends CI_Controller{
    public function index(){

			$data['title'] = 'Timetable';

			$data['compeition'] = $this->timetable_model->getTimetable_competition();

			$data['class'] = $this->timetable_model->getTimetable_class();

			$data['title2'] = 'List of Sports';
			$data['sports'] = $this->timetable_model->get_sport();

			$this->load->view('templates/header');
			$this->load->view('timetable/index', $data);
			$this->load->view('templates/footer');
		}

		public function create(){
			if(!$this->session->userdata('logged_in')){
							redirect('users/login');
			}

			$data['title'] = 'Create Event';

			$data['sports'] = $this->timetable_model->get_sport();

			$data['venues'] = $this->timetable_model->get_venue();

			$data['types'] = $this->timetable_model->get_type();

			$this->form_validation->set_rules('title', 'Title', 'required|callback_check_event_exists');
			$this->form_validation->set_rules('time_start', 'Time Start', 'required');

			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('timetable/create', $data);
				$this->load->view('templates/footer');
			}else{

				$this->timetable_model->create_event();

				$this->session->set_flashdata('event_created', 'Your event has been created!');
				redirect('timetable');

			}
		}


		//display all timetable of that sports
		public function sports($sports = NULL , $type = NULL ){
			if(empty($sports)){
				redirect('timetable');

			}else{
				$data['sports']  = $this->timetable_model->get_sportInfo($sports);

				if(empty($data['sports'])){
					show_404();
				}

				$type =  $this->uri->segment(4);

				$data['title'] =  $data['sports']->sport_name;

				$id = $this->timetable_model->get_sportInfo($sports)->id;
				$data['events'] = $this->timetable_model->get_events_by_sport($id, $type);

				$this->load->view('templates/header');
				$this->load->view('timetable/view', $data);
				$this->load->view('templates/footer');
			}

		}
		//book
		public function book($slug = NULL){
			if(empty($slug)){
				redirect('timetable');
			}else{
				$data['event'] = $this->timetable_model->get_events_by_slug($slug);

				if(empty($data['event'])){
					show_404();
				}
				$data['title'] = $data['event']['title'];
				$this->load->view('templates/header');
				$this->load->view('timetable/book', $data);
				//$this->load->view('posts/view2', $data);
				$this->load->view('templates/footer');
			}

		}

		//delete event
		public function delete($id){
			$this->timetable_model->delete_event($id);

			$this->session->set_flashdata('post_deleted', 'Your event has been deleted');

			redirect('timetable');
		}

		//canvel book
		public function cancel(){

		$id =  $this->uri->segment(3);
	  $event_id =  $this->uri->segment(4);
		$number =  $this->uri->segment(5);

		if($this->timetable_model->delete_book($event_id  , $id, $number)){
			$this->session->set_flashdata('event_created', 'You have cancelled your booking.');
		}else{
			$this->session->set_flashdata('event_created', 'Booking is adready cancelled.');
		}

		redirect('timetable');

		}

		function sendMail($data,$info,$rand){
			$this->load->config('email');
			$this->load->library('email');

			$time_start = date("d-m-Y g:i a", strtotime($info['time_started']));

			$from = $this->config->item('smtp_user');
			$to = $data['email'];
			$subject = 'Validation Email for Booking at FunOlyimpic Games';
			$message = "Dear  ".$data['name'].
									"\n You booked ".$data['number']." seats for ".$info['sport_name']." ".$info['title'].
									".\n The event is held on ".$time_start." at ".$info['venue_name'].
									".\n Your passcode is ".$rand.
									".\n If you wish to cancel the book please click this link.".
									base_url("timetable/cancel/".$data['id']."/".$info['id']."/".$data['number']).
									".\n We are looking forward to your arrival.";


			$this->email->set_newline("\r\n");
			$this->email->from($from);
			$this->email->to($to);
			$this->email->subject($subject);
			$this->email->message($message);

			if ($this->email->send()) {
				$this->session->set_flashdata('event_booked', 'You have booked the event!');
				redirect('timetable');
			} else {
				show_error($this->email->print_debugger());
			}

		}

		public function booking(){

			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required');

			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('users/register', $data);
				$this->load->view('templates/footer');

			} else {
				$rand = random_string('alnum', 10);

				$this->timetable_model->update_seat();

				$data['id'] = $this->timetable_model->booking_record($rand);

				$data['name'] = $this->input->post('name');
				$data['email'] = $this->input->post('email');
				$data['number'] = $this->input->post('number');

				$info = $this->timetable_model->get_events_by_ID($this->input->post('event_id'));

				$this->sendMail($data,$info,$rand);
			}

		}

		public function edit($slug){
			if(!$this->session->userdata('logged_in')){
				redirect('users/login');
			}

			$data['event'] = $this->timetable_model->get_events_by_slug($slug);

			if(empty($data['event'])){
				show_404();
			}

			$data['sports'] = $this->timetable_model->get_sport();

			$data['venues'] = $this->timetable_model->get_venue();

			$data['types'] = $this->timetable_model->get_type();

			$data['title'] = $data['event']['title'];

			$this->load->view('templates/header');
			$this->load->view('timetable/edit', $data);
			//$this->load->view('posts/view2', $data);
			$this->load->view('templates/footer');
		}

		public function update(){
			if(!$this->session->userdata('logged_in')){
				redirect('users/login');
			}
			$this->timetable_model->update_event();
			$this->session->set_flashdata('post_updated', 'Your event has been updated.');
			redirect('timetable');
		}

		// Check if sport exists
	  public function check_event_exists($title){
	    $this->form_validation->set_message('check_event_exists', 'The event is already been created.');
	    if($this->timetable_model->check_event_exists($title)){
	      return true;
	    } else {
	      return false;
	    }
	  }

  }
