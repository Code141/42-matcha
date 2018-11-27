<?php

class m_setup extends m_wrapper
{
	public function create_db()
	{
		$this->db->sql = "CREATE DATABASE IF NOT EXISTS " . APP_NAME . ";USE `".APP_NAME."`";
		$this->db->execute_pdo();
		return ($this);
	}

	public function drop_db()
	{
		/*
			if base existe
		*/
		$this->db->sql = "DROP DATABASE IF EXISTS " . APP_NAME;
		$this->db->execute_pdo();
		return ($this);
	}

	public function from_file_to_query($file)
	{
		$file = SERVER_ROOT . "app/sql/" . $file;
		if (is_readable($file))
			$script = file($file);
		else
			die ('app/models/setup.php -> from_file_to_query unknow file');
		$query = '';
		foreach ($script as $line) {
			if(substr($line, 0, 2) == '--' || $line == '')
				continue ;
			$query .= $line;
		}
		$this->db->sql = $query;
		$this->db->execute_pdo();
		return($this);
	}
}
