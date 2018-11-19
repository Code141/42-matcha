<?php

class c_sql_test extends c_controller
{
	public function main($params = NULL)
	{
		$this->data['executed'] = 
			$this->load->model("sql_test")
			->all_matches()
			->prepare()
			->bind_params()
			->execute();

/*

		echo "-----------RAW SQL:---------------<BR>";
		echo $this->core->db->sql;
		echo "<br>
			--------------ARRAY PARAMS TO BIND-----------<br>";
		var_dump($this->core->db->bind_param);

		//$this->data['executed'] = $this->core->db->execute_pdo()->fetchAll(PDO::FETCH_ASSOC);
//		------------- for DELETE, INSERT, UPDATE -------------------------
		
		$this->data['executed'] = $this->core->db->execute_pdo()->rowCount();
		
//		------------------------------------------------------------------
		//		*/
		$this->core->set_view("sql_test", "main");
	}
}
