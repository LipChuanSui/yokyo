<?php
	class Post_model extends CI_Model{
		public function __construct(){
			$this->load->database();
		}

		public function get_posts($slug = FALSE){

			if($slug === FALSE){
				$this->db->order_by('posts.id', 'DESC');
				$this->db->join('categories','categories.id = posts.category_id');
				$this->db->join('users','users.id = posts.user_id');
				$this->db->join('sports','sports.id = posts.sport_id');
				$query = $this->db->get('posts' ,3);
				return $query->result_array();
			}

			$this->db->select('*,posts.id');
			$this->db->join('categories','categories.id = posts.category_id');
			$this->db->join('users','users.id = posts.user_id');
			$this->db->join('sports','sports.id = posts.sport_id');
			$query = $this->db->get_where('posts', array('slug' => $slug));
			return $query->row_array();
		}

		public function get_images($id){
			$query = $this->db->get_where('images', array('post_id' => $id));
			return $query->result_array();
		}

		public function create_post($post_image){

			$count = count($post_image);
			$this->db->insert_batch('images',$post_image);
			$imageid[0] = $this->db->insert_id();

			for($i=1; $i<$count; $i++){
				$imageid[$i] = $imageid[$i-1] + 1;
			}


			$slug = url_title($this->input->post('title'),'_', true);

			$data = array(
				'title' => $this->input->post('title'),
				'slug' => $slug,
				'body' => $this->input->post('body'),
				'category_id' => $this->input->post('category_id'),
				'user_id' => $this->session->userdata('user_id'),
				'sport_id' => $this->input->post('sport_id'),
			);
			$this->db->insert('posts', $data);
			$postid = $this->db->insert_id();



			for($i=0; $i<$count; $i++){
				$data = array(
					'post_id' => $postid
				);

				$this->db->where('id', $imageid[$i]);
				$this->db->update('images', $data);
			}


		}

		public function delete_post($id){
			$this->db->where('id', $id);
			$this->db->delete('posts');
			return true;
		}

		public function update_post(){
			$slug = url_title($this->input->post('title'));

			$data = array(
				'title' => $this->input->post('title'),
				'slug' => $slug,
				'body' => $this->input->post('body'),
				'category_id' => $this->input ->post('category_id'),
			);

			$this->db->where('id', $this->input->post('id'));
			return $this->db->update('posts', $data);
		}

		public function get_categories(){
			$this->db->order_by('name');
			$query = $this->db->get('categories');
			return $query->result_array();
		}

		public function get_category_name($id){
			$query = $this->db->get_where('categories', array('id' => $id));
			return $query->row();
		}

		public function get_sports(){
			$this->db->order_by('sport_name');
			$query = $this->db->get('sports');
			return $query->result_array();
		}

		public function get_posts_by_sport($sports_id){
			$this->db->order_by('posts.created', 'DESC');
			$this->db->join('sports', 'sports.id = posts.sport_id');
			$this->db->join('categories', 'categories.id = posts.category_id');
			$query = $this->db->get_where('posts', array('sport_id' => $sports_id));

			return $query->result_array();
		}

		public function get_posts_by_category($category_id){
			$this->db->order_by('posts.created', 'DESC');
			$this->db->join('categories', 'categories.id = posts.category_id');
			$this->db->join('sports', 'sports.id = posts.sport_id');
			$this->db->join('users', 'users.id = posts.user_id');
			$query = $this->db->get_where('posts', array('category_id' => $category_id));
			return $query->result_array();
		}

		// Check username exists
		public function check_title_exists($title){
			$query = $this->db->get_where('posts', array('title' => $title));
			if(empty($query->row_array())){
				return true;
			} else {
				return false;
			}
		}


}
