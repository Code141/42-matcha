<?php

class c_sql_test extends c_controller
{
	public function main($params = NULL)
	{
		$model = $this->load->model("sql_test");
		$model->all_matches_sort_by_tags();

		echo "-----------RAW SQL:---------------<BR>";
		echo $this->core->db->sql;
		echo "<br>
			--------------ARRAY PARAMS TO BIND-----------<br>";
		var_dump($this->core->db->bind_param);

		$this->data['executed'] = $this->core->db->execute_pdo()->fetchAll(PDO::FETCH_ASSOC);
		$this->core->set_view("sql_test", "main");
	}
}
