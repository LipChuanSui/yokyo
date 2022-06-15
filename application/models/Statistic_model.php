<?php

class Statistic_model extends CI_Model
{
 public function fetch_num(){
  $this->db->select('year');
  $this->db->from('chart_data');
  $this->db->group_by('year');
  $this->db->order_by('year', 'DESC');
  return $this->db->get();
 }

 public function getStatistic($typeID){
   $query = $this->db->query("CALL statistic($typeID)");
   return $query;

 }







}

?>
