<?php
	class User_model extends CI_Model{
		public function register($enc_password){

			// User data array
			$data = array(
				'email' => $this->input->post('email'),
        'username' => $this->input->post('username'),
        'password' => $enc_password,
				'authority_id' => $this->input->post('authority_id')
			);

			// Insert user
			return $this->db->insert('users', $data);
		}

		// Log user in
		public function login($username, $password){
			// Validate
			$this->db->where('username', $username);
			$result = $this->db->get('users');

			if($result->num_rows() == 1){
				$hashed_password = $result->row(0)->password;

				if(password_verify($password, $hashed_password)){
					$data['user_id'] = $result->row(0)->id;
					$data['authority_id'] = $result->row(0)->authority_id;
					return $data;
				}else{
					return false;

				}
			}
		}

		// Check username exists
		public function check_username_exists($username){
			$query = $this->db->get_where('users', array('username' => $username));
			if(empty($query->row_array())){
				return true;
			} else {
				return false;
			}
		}

		// Check email exists
		public function check_email_exists($email){
			$query = $this->db->get_where('users', array('email' => $email));
			if(empty($query->row_array())){
				return true;
			} else {
				return false;
			}
		}
		public function get_authorities(){
			$this->db->order_by('id');
			$query = $this->db->get('authority');
			return $query->result_array();
		}
	}
