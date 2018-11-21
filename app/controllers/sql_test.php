<?php

class c_sql_test extends c_controller
{
	public function main($params = NULL)
	{
		$this->module_loader->session();
		$user = $this->module->session->user_loggued();
		var_dump($user);
		$this->data['executed'] = 
			$this->load->model("sql_test")
			->all_users($user['id'])
			->matches($user['id'],$user['id_gender'], $user['id_gender_identity'], $user['orientations'])
//			->all_matches($user['id'])
//			->matches_gender_identity($user['id_gender_identity'])
//			->sort_by_tags($user['tags'])
//			->keep_only_with_same_tags($user['tags'])
			->execute()
			->fetchAll();

		$this->core->set_view("sql_test", "main");
	}
}

