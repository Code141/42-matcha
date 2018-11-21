<?php

class c_sql_test extends c_controller
{
	public function main($params = NULL)
	{
		$this->module_loader->session();
		$user = $this->module->session->user_loggued();

		$this->data['executed'] = 
			$this->load->model("sql_test")
			->all_users($user['id'])
			->all_matches($user['id'],$user['gender'], $user['gender_identity'], $user['orientations'])
//			->all_matches($id)
//			->matches_gender_identity($gender_identity)
//			->sort_by_tags(array(216,290))
//			->keep_only_with_same_tags(array(216,290))
			->execute()
			->fetchAll();

		$this->core->set_view("sql_test", "main");
	}
}

