<?php
	class Timetable_model extends CI_Model{

    public function create_event(){
			$slug = url_title($this->input->post('title'),'_', true);

			$time_start = date("Y-m-d H:i", strtotime($this->input->post('time_start')));

      $data = array(
        'title' => $this->input->post('title'),
				'slug' => $slug,
        'sport_id' => $this->input->post('sport_id'),
        'venue_id' => $this->input->post('venue_id'),
        'type_id' => $this->input->post('type_id'),
				'time_started' => $time_start,
      );

      return $this->db->insert('events', $data);
    }



		public function booking_record($rand){
      $data = array(
        'record_name' => $this->input->post('name'),
				'event_id' => $this->input->post('event_id'),
				'email' => $this->input->post('email'),
				'number' => $this->input->post('number'),
				'code' => $rand,
      );

			$this->db->insert('records', $data);
			$insertId = $this->db->insert_id();
			return $insertId;

    }

		public function delete_book($event_id,$record_id,$number){

			$check = $this->db->get_where('records', array('id' => $record_id));

			if($check->row(0)->cancel == 0 ){
				$this->db->set('cancel', 1, false);
				$this->db->where('id',$record_id);
				$this->db->update('records');

	      $this->db->set('number', 'number+'.$number, false);
				$this->db->where('id',$event_id);
	      $this->db->update('events');
				return true;
			}else{
				return false;
			}

    }

		public function update_seat(){
			$number = $this->input->post('number');

      $this->db->set('number', 'number-'.$number, false);
			$this->db->where('id',$this->input->post('event_id'));
      return $this->db->update('events');
    }

		public function get_events_by_sport($sports_id , $type){
			$this->db->order_by('events.time_started', 'ASC');
			$this->db->join('sports', 'sports.id = events.sport_id');
			$this->db->join('venues', 'venues.id = events.venue_id');
			if($type){
				$query = $this->db->get_where('events', array('sport_id' => $sports_id , 'type_id' => $type ));
			}else{
				$query = $this->db->get_where('events', array('sport_id' => $sports_id  ));
			}
			return $query->result_array();
		}

		public function get_events_by_slug($slug){

			$this->db->select('*,events.id');
			$this->db->from('events');
			$this->db->join('venues', 'venues.id = events.venue_id', 'full');
      $this->db->join('types', 'types.id = events.type_id', 'left');
			$this->db->join('sports', 'sports.id = events.sport_id', 'left');
			$this->db->where('events.slug' ,$slug);
			$query = $this->db->get();
			return $query->row_array();

		}

		public function get_events_by_ID($id){
			$this->db->select('*,events.id');
			$this->db->join('sports', 'sports.id = events.sport_id');
			$this->db->join('venues', 'venues.id = events.venue_id');
			$query = $this->db->get_where('events', array('events.id' => $id));
			return $query->row_array();
		}

		public function get_sportInfo($name){
			$query = $this->db->get_where('sports', array('sport_name' => $name));
			return $query->row();
		}

		public function get_sportPost(){
      $this->db->order_by('sport_name');
      $query = $this->db->get('sports');
      return $query->result_array();
    }

    public function get_sport(){
      $this->db->order_by('sport_name');
			$this->db->where_not_in('id',1);
      $query = $this->db->get('sports');
      return $query->result_array();
    }

    public function get_venue(){
      $this->db->order_by('venue_name');
      $query = $this->db->get('venues');
      return $query->result_array();
    }

    public function get_type(){
      $this->db->order_by('type_name');
      $query = $this->db->get('types');
      return $query->result_array();
    }

		public function getTimetable_competition(){
			$query = $this->db->query("CALL timetable_competition()");
			$this->db->close();
      return $query->result();
		}

		public function getTimetable_class(){
			$query = $this->db->query("CALL timetable_class()");
			$this->db->close();
      return $query->result();

		}

		public function update_event(){
			$slug = url_title($this->input->post('title'));

			$time_start = date("Y-m-d H:i", strtotime($this->input->post('time_start')));

			$data = array(
				'title' => $this->input->post('title'),
				'type_id' => $this->input ->post('type_id'),
				'sport_id' => $this->input ->post('sport_id'),
				'venue_id' => $this->input ->post('venue_id'),
				'result' => $this->input ->post('result'),
				'time_started' => $time_start
			);

			$this->db->where('id', $this->input->post('id'));
			return $this->db->update('events', $data);
		}

		public function delete_event($id){
			$this->db->where('id', $id);
			$this->db->delete('events');
			return true;
		}

		// Check event exists
		public function check_event_exists($title){
			$query = $this->db->get_where('events', array('title' => $title));
			if(empty($query->row_array())){
				return true;
			} else {
				return false;
			}
		}

  }
