<?php
	class Users extends CI_Controller{
		// Register user
		public function register(){
			if(!$this->session->userdata('logged_in')){
				redirect('users/login');
			}

			// Check user
			if($this->session->userdata('authority_id') == 1 ){
				redirect('posts');
			}

			$data['title'] = 'Register';

			$data['authorities'] = $this->user_model->get_authorities();

			$this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists');
			$this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]');

			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('users/register', $data);
				$this->load->view('templates/footer');
			} else {
				// Encrypt password
				$enc_password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
				$this->user_model->register($enc_password);

				// Set message
				$this->session->set_flashdata('user_registered', 'You have registered a new user.');

				redirect('posts');
			}
		}

		// Log in user
		public function login(){
			if($this->session->userdata('logged_in')){
				redirect('/');
			}

			$data['title'] = 'Sign In';

			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');

			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('users/login', $data);
				$this->load->view('templates/footer');
			} else {

				// Get username
				$username = $this->input->post('username');
				// Get and encrypt the password
				$password = $this->input->post('password');
				// Login user
				$authentication = $this->user_model->login($username, $password);

				if($authentication){
					// Create session
					$user_data = array(
						'user_id' => $authentication['user_id'],
						'username' => $username,
						'authority_id' => $authentication['authority_id'],
						'logged_in' => true
					);

					$this->session->set_userdata($user_data);
					// Set message
					$this->session->set_flashdata('user_loggedin', 'You are now logged in');
					//$this->session->set_flashdata('user_loggedin', json_encode($user_data));

					redirect(base_url());

				} else {
					// Set message
					$this->session->set_flashdata('login_failed', 'Login is invalid');

					redirect('users/login');
				}
			}
		}

		// Log user out
		public function logout(){
			// Unset user data
			$this->session->unset_userdata('logged_in');
			$this->session->unset_userdata('user_id');
			$this->session->unset_userdata('username');
			$this->session->unset_userdata('authority_id');

			// Set message
			$this->session->set_flashdata('user_loggedout', 'You are now logged out');

			redirect('users/login');
		}

		// Check if username exists
		public function check_username_exists($username){
			$this->form_validation->set_message('check_username_exists', 'That username is taken. Please choose a different one');
			if($this->user_model->check_username_exists($username)){
				return true;
			} else {
				return false;
			}
		}

		// Check if email exists
		public function check_email_exists($email){
			$this->form_validation->set_message('check_email_exists', 'That email is taken. Please choose a different one');
			if($this->user_model->check_email_exists($email)){
				return true;
			} else {
				return false;
			}
		}
	}
