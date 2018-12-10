<?php

class c_matches extends c_controller
{
	var $user;

	private function prepare(int $start = 0, int $offset = 10)
	{
		$this->module_loader->session();
		$this->user = $this->module->session->user_loggued();
		$this->req = $this->load->model("matches")
			->all_users($this->user)
			->limit($start, $offset);
		$this->data['all_tags'] = $this->load->model("wrapper")
			->all_tags()
			->execute()
			->fetchAll(); 
		$this->data['filter_tags'] = array();
		$this->data['filters'] = $this->init_filters();
		$this->data['user']['latitude'] = $this->user['latitude'];
		$this->data['user']['longitude'] = $this->user['longitude'];
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
		$this->prepare();
		foreach ($_GET as $filter => $value)
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
			if ($filter == "distance_order")
				$this->req->order_by_distance($value);
			if ($filter == "distance_filter_km" && $value)
				$this->req->filter_by_distance($value);
			if ($filter == "birthdate_order" && $value)
				$this->req->order_by_birthdate($value);
			if ($filter == "age_select_from" && isset($_GET['age_select_to']))
				$this->filter_birthdate($value,$_GET['age_select_to']);
		}

		$this->data['matches'] = $this->req
			->filter_by_tags($this->data['filter_tags'])
			->execute()
			->fetchAll();
		foreach ($this->data['matches'] as &$profil)
			$profil['age'] = date_diff(date_create($profil['birthdate']), date_create('today'))->y;
		$this->data['js_matches'] = json_encode($this->data['matches']);
		$this->core->set_view("matches", "main");
		return $this;
	}
}
