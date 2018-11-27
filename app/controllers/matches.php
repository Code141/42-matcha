<?php

class c_matches extends c_controller
{
	var $user;
	private function prepare()
	{
		$this->module_loader->session();
		$this->user = $this->module->session->user_loggued();
		$this->req = $this->load->model("matches")->all_users($this->user['id']);
//			->limit(0,15);
		$this->data['all_tags'] = $this->load->model("wrapper")->all_tags()->execute()->fetchAll(); 
	 }

	private function init_filters()
	{
		$filters = array(
			'matches' => NULL,
			'order by matching tags' => NULL);
		return ($filters);
	}

	private function get_date($age)
	{
		$date = new DateTime("today -".$age." years");
		$date = $date->format('Y-m-d');
		return($date);
	}
	
	private function filter_birthdate($age_from, $age_to)
	{
		$from = $this->get_date($age_from);
		$to = $this->get_date($age_to);
		if ($age_from > $age_to)
			$this->req->filter_by_birthdate($from, $to);
		else
			$this->req->filter_by_birthdate($to, $from);
	}

	public function main($params = NULL)
	{
	//	var_dump($_POST);	
		$this->prepare();
		$this->data['filter_tags'] = array();
		$this->data['filters'] = $this->init_filters();
		if (isset($_POST['age_select_from']) && isset($_POST['age_select_to']))
			$this->filter_birthdate($_POST['age_select_from'],$_POST['age_select_to']);
		foreach ($_POST as $filter => $value)
		{
			if (preg_match("/tag_.+/", $filter))
				$this->data['filter_tags'][]= $value;
			if ($filter == "matches" || $filter == "order_by_matching_tags")
			{
				$this->req->$filter($this->user);
				$filter = preg_replace ("/_/", " ", $filter);
				if (array_key_exists ($filter, $this->data['filters']))
					$this->data['filters'][$filter] = $value;
			}
		}
		if ($direction = $_POST['birthdate_order'])
			$this->req->order_by_birthdate($direction);
		$this->data['executed'] = $this->req
			->filter_by_tags($this->data['filter_tags'])
			->execute()
			->fetchAll();
		$this->core->set_view("matches", "main");
		return $this;
	}
}
