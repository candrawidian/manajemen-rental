<?php 

     $result=$this->db->query("SELECT TotalDibayar FROM jadwal")->result_array();

	    $data = array();
	foreach ($result as $row) {
		$data[] = $row;
	}

	echo json_encode($data)





