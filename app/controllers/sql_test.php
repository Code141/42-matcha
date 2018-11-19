<?php

class c_sql_test extends c_controller
{
	public function main($params = NULL)
	{
		$this->data['executed'] = 
			$this->load->model("sql_test")
			->all_matches(4)
			->matches_gender_identity()
//			->only_matches_with_same_tags(4)
			->execute()
			->fetchAll();

		$this->core->set_view("sql_test", "main");
	}
}
