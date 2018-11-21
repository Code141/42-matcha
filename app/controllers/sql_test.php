<?php

class c_sql_test extends c_controller
{
	public function main($params = NULL)
	{
		$id = 1;
		$gender = 1;
		$gender_identity = 4;
		$orientations = array(
			array("gender" => 4, "gender_identity" => 3),
			array("gender" => 3, "gender_identity" => 2),
			array("gender" => 3, "gender_identity" => 1)
		);
		$this->data['executed'] = 
			$this->load->model("sql_test")
			->all_users($id)
			->all_matches($id, $orientations)
//			->all_matches($id)
//			->sort_by_tags(array(216,290))
//			->matches_gender_identity($gender_identity)
//			->keep_only_with_same_tags(array(216,290))
			->execute()
			->fetchAll();

		$this->core->set_view("sql_test", "main");
	}
}


