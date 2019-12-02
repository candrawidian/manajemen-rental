
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class menu_model extends CI_Model{

	public function getsubmenu()
	{
		$query = "SELECT `user_sub_menu`.*,`user_menu`.`menu`
				FROM `user_sub_menu` JOIN `user_menu`
				ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
		";

		return $this->db->query($query)->result_array();
	}

	function editmenu()
	{
		$id = $this->input->post('id');
    	$title = $this->input->post('title');
        $url = $this->input->post('url');
        $menu_id = $this->input->post('menu_id');
		$icon = $this->input->post('icon');
    		
    	$this->db->set('title', $title);
    	$this->db->set('url', $url);
        $this->db->set('menu_id', $menu_id);
        $this->db->set('icon', $icon);
       
         $this->db->where('id', $id);
         $this->db->update('user_sub_menu');
	}
}
