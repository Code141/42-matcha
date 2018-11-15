<?php

class c_setup extends c_controller
{
	public function main($params = NULL)
	{
		$this->core->set_view("setup", "main");
	}

	public function new($params = NULL)
	{
		$this->load->model("setup")
			->drop_db()
			->create_db()
			->from_file_to_query("tables.sql");

		echo "new<br>";
		$this->core->set_view("setup", "main");
	}

	public function seed($params = NULL)
	{

		$this->load->model("setup")
			->drop_db()
			->create_db()
			->from_file_to_query("tables.sql");

		$this->load->model("setup")->create_db();
		$seed_dir = SERVER_ROOT . "app/sql/seed/";
		if (is_dir($seed_dir))
		{
			$seeds_files = preg_grep("/.+\.sql$/", scandir($seed_dir));
			foreach ($seeds_files as $file)
				$this->load->model("setup")->from_file_to_query("seed/" . $file);
		}

		echo "seed<br>";
		$this->core->set_view("setup", "main");
	}

	public function drop($params = NULL)
	{
		$this->load->model("setup")->drop_db();
		echo "drop<br>";
		$this->core->set_view("setup", "main");
	}
}
