<?php
  class Sport_model extends CI_Model{
    public function create_sport($sport_img){
			$slug = url_title($this->input->post('sport_name'),'_', true);//small letter

      $data = array(
        'sport_name' => $this->input->post('sport_name'),
				'sport_slug' => $slug,
        'sport_img' => $sport_img
      );

      return $this->db->insert('sports', $data);
    }

    // Check sport exists
		public function check_sport_exists($title){
			$query = $this->db->get_where('sports', array('sport_name' => $title));
			if(empty($query->row_array())){
				return true;
			} else {
				return false;
			}
		}
}
