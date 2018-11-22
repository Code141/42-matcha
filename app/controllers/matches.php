<?php

class c_matches extends c_controller
{
	public function main($params = NULL)
	{
		$this->module_loader->session();
		$user = $this->module->session->user_loggued();
		var_dump($user);
		$this->data['executed'] = 
			$this->load->model("sql_test")
			->all_users($user['id'])
//			->matches($user['id'],$user['id_gender'], $user['id_gender_identity'], $user['orientations'])
//			->all_matches($user['id'])
//			->matches_gender_identity($user['id_gender_identity'])
//			->order_by_matching_tags($user['tags'])
//			->filter_by_tags(array(290,1,13,2))
			->filter_by_birthdate("1901-04-03","1991-07-12")
//			->order_by_birthdate("ASC")
			->execute()
			->fetchAll();
		$this->core->set_view("matches", "main");
	}
}

