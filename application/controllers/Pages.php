<?php
	class Pages extends CI_Controller{
		public function view($page = 'home'){
			if(!file_exists(APPPATH.'views/pages/'.$page.'.php')){
				show_404();
			}

			$data['title'] = ucfirst($page);

			$data['articles'] = $this->post_model->get_posts_by_category(1);
			$data['news'] = $this->post_model->get_posts_by_category(2);
			$data['galleries'] = $this->post_model->get_posts_by_category(3);


			$this->load->view('templates/header');
			$this->load->view('pages/'.$page, $data);
			$this->load->view('templates/footer');
		}


	}
