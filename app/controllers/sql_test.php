<?php

class c_sql_test extends c_controller
{
	public function main($params = NULL)
	{
		$this->data['executed'] = 
			$this->load->model("sql_test")
			->all_users(1)
			->all_matches(1)
			->sort_by_tags(array(216,290))
			->matches_gender_identity()
//			->keep_only_with_same_tags(array(216,290))
			->execute()
			->fetchAll();

		$this->core->set_view("sql_test", "main");
	}
}


