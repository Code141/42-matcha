<?php

class c_sql_test extends c_controller
{
	public function main($params = NULL)
	{
		$id = 1;
		$gender = 1;
		$gender_identity = 4;
		$orientations = array(
			array("id_gender" => 4, "id_gender_identity" => 3),
			array("id_gender" => 3, "id_gender_identity" => 2),
			array("id_gender" => 3, "id_gender_identity" => 1)
		);
		$this->data['executed'] = 
			$this->load->model("sql_test")
			->all_users($id)
			->matches($id, $gender, $gender_identity, $orientations)
//			->all_matches($id)
//			->matches_gender_identity($gender_identity)
//			->sort_by_tags(array(216,290))
//			->keep_only_with_same_tags(array(216,290))
			->execute()
			->fetchAll();

		$this->core->set_view("sql_test", "main");
	}
}


