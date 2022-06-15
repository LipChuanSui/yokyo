<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Statistic extends CI_Controller {


 function index()
 {
  $data['year_list'] = $this->statistic_model->getStatistic();
  $this->load->view('template/header');
  $this->load->view('pages/statistic', $data);
  $this->load->view('template/footer');

 }

 function fetch_data($typeID){
   $chart_data = $this->statistic_model->getStatistic($typeID);

   foreach($chart_data->result_array() as $row){
     $data[] = $row;
   }

   echo json_encode($data);
 }

}

?>
