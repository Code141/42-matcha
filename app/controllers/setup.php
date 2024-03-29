<?php

class c_setup extends c_controller
{
	public function main($params = NULL)
	{
		if (DEV_MODE)
			$this->core->set_view("setup", "main");
		else
			echo "Please set DEV_MODE to TRUE in your config/config.php";
	}

	public function new($params = NULL)
	{
		if (DEV_MODE)
		{
			$this->load->model("setup")
				->drop_db()
				->create_db()
				->from_file_to_query("tables.sql");
			$this->core->success("New empty database has been created", 'setup', 'main');
		}
		else
			echo "Please set DEV_MODE to TRUE in your config/config.php";
	}

	public function seed($params = NULL)
	{

		if (DEV_MODE)
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
				{
					$this->load->model("setup")->from_file_to_query("seed/" . $file);
				}
			}

			$this->core->success("New database with mock data has been created", 'setup', 'main');
		}
		else
			echo "Please set DEV_MODE to TRUE in your config/config.php";
	}

	public function drop($params = NULL)
	{

		if (DEV_MODE)
		{
			$this->load->model("setup")->drop_db();
			$this->core->success("Database has been successfully deleted", 'setup', 'main');
		}
		else
			echo "Please set DEV_MODE to TRUE in your config/config.php";
	}
}
