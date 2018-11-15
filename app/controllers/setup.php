<?php

class c_setup extends c_controller
{
	public function main($params = NULL)
	{
		$this->core->set_view("setup", "main");
	}

	public function new($params = NULL)
	{
		$this->pdo->create_db();
		$this->pdo->execute_pdo();
		$this->pdo->from_file_to_query(SERVER_ROOT . "app/sql/" . APP_NAME . ".sql");
		$this->pdo->execute_pdo();
		echo "new<br>";
	}

	public function seed($params = NULL)
	{
		$seed_dir = SERVER_ROOT . "app/sql/seed/";
		$this->pdo->create_db();
		$this->pdo->execute_pdo();
		if (is_dir($seed_dir))
		{	
			foreach (scandir($seed_dir) as $file)
			{
				$this->pdo->from_file_to_query($seed_dir . $file);
				$ret = $this->pdo->execute_pdo();
			}
		}
		echo "seed<br>";
	}

	public function drop($params = NULL)
	{
		echo "drop<br>";
	}

}
