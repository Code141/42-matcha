<?php

class c_matches extends c_logged_only
{
	var	$user;

	private function prepare()
	{
		$this->module_loader->session();
		$this->user = $this->module->session->user_loggued();
		$this->req = $this->load->model("matches")
			->all_users($this->user);
		$this->data['all_tags'] = $this->load->model("wrapper")
			->all_tags()
			->execute()
			->fetchAll(); 
		$this->data['user']['location']['latitude'] = $this->user['latitude'];
		$this->data['user']['location']['longitude'] = $this->user['longitude'];
		$this->json['user_location'] = json_encode($this->data['user']['location']);
		$this->data['user']['latitude'] = $this->user['latitude'];
		$this->data['user']['longitude'] = $this->user['longitude'];
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
		$filter_tags = array();
		foreach ($_POST as $filter => $value)
		{
			if (preg_match("/tag_.+/", $filter))
				$filter_tags[]= $value;
			if ($filter == "match" || $filter == "order_by_matching_tags")
				$this->req->$filter($this->user);
			else if ($value)
			{
				if ($filter == "distance_order")
					$this->req->order_by_distance($value);
				if ($filter == "distance_filter_km")
					$this->req->filter_by_distance($value);
				if ($filter == "birthdate_order")
					$this->req->order_by_birthdate($value);
				if ($filter == "age_select_from" && isset($_POST['age_select_to']) && $_POST['age_select_to'] !== "")
					$this->filter_birthdate($value,$_POST['age_select_to']);
			}
		}

		$nb_matches = $this->req
			->filter_by_tags($filter_tags)
			->execute()
			->rowCount();
		$this->json['total_matches'] = json_encode($nb_matches);
		$offset = 10;
		if (!isset($params[0]) || empty($params[0]) ||
			!is_numeric($params[0]) || $params[0] <= 0 || $params[0] >= (($nb_matches / 10) + 1))
			$this->data['current_page'] = 1;
		else
			$this->data['current_page'] = intval($params[0]);
			$this->json['current_page'] = json_encode($this->data['current_page']);
		$start = ($this->data['current_page'] - 1) * 10;	
	
		$this->data['matches'] = $this->req
			->limit($start, $offset)
			->execute()
			->fetchAll();
		foreach ($this->data['matches'] as &$profil)
			$profil['age'] = date_diff(date_create($profil['birthdate']), date_create('today'))->y;

		$this->json['matches'] = json_encode($this->data['matches']);

		if (is_ajax_query())
		{
			echo $this->json['matches'];
			echo $this->json['total_matches'];
		}
		else
			$this->core->set_view("matches", "main");
	}
}
