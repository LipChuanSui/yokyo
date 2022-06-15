<?php
	class Posts extends CI_Controller{
    public function index(){

			$data['title'] = 'Latest Posts';

      $data['posts'] = $this->post_model->get_posts();
      //debug
      //print_r($data['posts']);

			$data['title2'] = 'List of Sports';
			$data['sports'] = $this->timetable_model->get_sportPost();

			$this->load->view('templates/header');
			$this->load->view('posts/index', $data);
			$this->load->view('templates/footer');
		}

    public function view($slug = NULL){
			$data['post'] = $this->post_model->get_posts($slug);
			$post_id = $data['post']['id'];
			$data['comments'] = $this->comment_model->get_comments($post_id);

			$data['images'] = $this->post_model->get_images($data['post']['id']);

			if(empty($data['post'])){
				redirect('posts');
			}

			$data['title'] = $data['post']['title'];

			if($data['post']['category_id'] == 1){
				$this->load->view('templates/header');
				$this->load->view('posts/view_article', $data);
				$this->load->view('templates/footer');
			}else if($data['post']['category_id'] == 2){
				$this->load->view('templates/header');
				$this->load->view('posts/view_news', $data);
				$this->load->view('templates/footer');
			}else if($data['post']['category_id'] == 3){
				$this->load->view('templates/header');
				$this->load->view('posts/view_gallery', $data);
				$this->load->view('templates/footer');
			}


		}

		//display all posts of that sports
		public function sports($sports = NULL){
			if(empty($sports)){
				redirect('posts');
			}else{
				$data['sports']  = $this->timetable_model->get_sportInfo($sports);

				if(empty($data['sports'])){
					show_404();
				}

				$data['title'] =  $data['sports']->sport_name;

				$id = $this->timetable_model->get_sportInfo($sports)->id;

				$data['posts'] = $this->post_model->get_posts_by_sport($id);

				$this->load->view('templates/header');
				$this->load->view('posts/sports', $data);
				$this->load->view('templates/footer');
			}
		}

		//display all posts of that category
		public function category($category_id = NULL){
			if($category_id > 3){
				redirect('posts');
			}else{
				$title =  $this->post_model->get_category_name($category_id);
				if(empty($title)){
					show_404();
				}
				$data['title'] =  $title->name;
				$data['posts'] = $this->post_model->get_posts_by_category($category_id);
				$this->load->view('templates/header');
				$this->load->view('posts/category', $data);
				$this->load->view('templates/footer');
			}
		}


		public function create(){
			if(!$this->session->userdata('logged_in')){
							redirect('users/login');
			}

			$data['title'] = 'Create Post';

			$data['categories'] = $this->post_model->get_categories();

			$data['sports'] = $this->post_model->get_sports();


			$this->form_validation->set_rules('title', 'Title', 'required|callback_check_title_exists');
			$this->form_validation->set_rules('body', 'Body', 'required');

			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('posts/create', $data);
				$this->load->view('templates/footer');
			}else{
				$this->load->library('upload');
				$dataInfo = array();
				$files = $_FILES;
				$cpt = count($_FILES['userfile']['name']);
				for($i=0; $i<$cpt; $i++){
						$_FILES['userfile']['name']= $files['userfile']['name'][$i];
						$_FILES['userfile']['type']= $files['userfile']['type'][$i];
						$_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
						$_FILES['userfile']['error']= $files['userfile']['error'][$i];
						$_FILES['userfile']['size']= $files['userfile']['size'][$i];

						$this->upload->initialize($this->set_upload_options());

						if (!$this->upload->do_upload('userfile')){
								$error = array('error' => $this->upload->display_errors());
								//print_r($error);
						 }else{
									$dataInfo[$i] = $this->upload->data();
				          $post_image[$i]['post_image'] = $dataInfo[$i]['file_name'];
				     }
				}

				$this->post_model->create_post($post_image);

				$this->session->set_flashdata('post_created', 'Your post has been created!');
				redirect('posts');
			}
		}

		private function set_upload_options(){
    	//upload an image options
    	$config = array();
    	$config['upload_path'] = './assets/images/posts/';
    	$config['allowed_types'] = 'gif|jpg|png';

    	return $config;
    }

		public function delete($id){
			$this->post_model->delete_post($id);

			$this->session->set_flashdata('post_deleted', 'Your post has been deleted');

			redirect('posts');
		}

		public function edit($slug){
			if(!$this->session->userdata('logged_in')){
				redirect('users/login');
			}

			$data['post'] = $this->post_model->get_posts($slug);

			if(empty($data['post'])){
				show_404();
			}

			// Check user
			if($this->session->userdata('user_id') != $this->post_model->get_posts($slug)['user_id'] ){
				redirect('posts');
			}

			$data['categories'] = $this->post_model->get_categories();

			$data['title'] = $data['post']['title'];

			$this->load->view('templates/header');
			$this->load->view('posts/edit', $data);
			//$this->load->view('posts/view2', $data);
			$this->load->view('templates/footer');
		}

		public function update(){
			if(!$this->session->userdata('logged_in')){
				redirect('users/login');
			}
			$this->post_model->update_post();
			$this->session->set_flashdata('post_updated', 'Your post has been updated.');
			redirect('posts');
		}

		// Check if username exists
		public function check_title_exists($title){
			$this->form_validation->set_message('check_title_exists', 'That title is taken. Please choose a different one');
			if($this->post_model->check_title_exists($title)){
				return true;
			} else {
				return false;
			}
		}


	}
