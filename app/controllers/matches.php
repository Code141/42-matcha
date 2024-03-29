<?php

class c_matches extends c_logged_only
{
	var	$user;

	private function prepare()
	{
		$minimum_required = array(
			"username", "firstname", "lastname", "birthdate", "id_media", "password",
			"email", "id_gender", "id_gender_identity", "latitude", "longitude", "tags", "bio");
		$this->module_loader->session();
		$this->user = $this->module->session->user_loggued();
		foreach($minimum_required as $field)
			if ($this->user[$field] == NULL)
				$this->core->fail("Please complete your profil before looking for matches", "account", "main");
		$this->req = $this->load->model("matches")
			->suggestion($this->user);

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


	private function filter_score($from, $to)
	{
		if ($from < $to)
			$this->req->filter_by_score($from, $to);
		else
			$this->req->filter_by_score($to, $from);
	}

	public function main($params = NULL)
	{
		$timestamp_debut = microtime(true);
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

				if ($filter == "score_order")
					$this->req->order_by_score($value);

				if ($filter == "score_select_from" && isset($_POST['score_select_to']) && $_POST['score_select_to'] !== "")
					$this->filter_score($value,$_POST['score_select_to']);
 
			}
		}
		$nb_matches = $this->req
			->filter_by_tags($filter_tags)
			->execute()
			->rowCount();
		$this->json['total_matches'] = json_encode($nb_matches);
		$offset = 20;
		if (!isset($params[0]) || empty($params[0]) ||
			!is_numeric($params[0]) || $params[0] <= 0 || $params[0] >= (($nb_matches / 20) + 1))
			$this->data['current_page'] = 1;
		else
			$this->data['current_page'] = intval($params[0]);
			$this->json['current_page'] = json_encode($this->data['current_page']);
		$start = ($this->data['current_page'] - 1) * $offset;
		if (empty($_POST))
		{
			$this->data['matches'] = $this->req
			->order_by_gender()
			->order_by_distance("ASC")
			->order_by_matching_tags($this->user)
			->order_by_score("DESC")
			->limit($start, $offset)
			->execute()
			->fetchAll();
		}
		else
		{
			$this->data['matches'] = $this->req
				->limit($start, $offset)
				->execute()
				->fetchAll();
		}
		$sql = " SELECT MIN(score) as min, MAX(score) as max FROM user "; 
		$stm = $this->req->db->pdo->prepare($sql);
		$scores = $stm->execute();
		$scores = $stm->fetchAll(PDO::FETCH_ASSOC)[0];
		$smin = $scores['min'];
		$smax = $scores['max'];
		$sdelta = ($smax - $smin);
		if ($sdelta == 0)
			$sdelta = 1;
		foreach($this->data['matches'] as $key => &$profile)
			$profile['score'] = floor((($profile['score'] - $smin) / $sdelta) * 100) / 10;

		foreach ($this->data['matches'] as &$profil)
			$profil['age'] = date_diff(date_create($profil['birthdate']), date_create('today'))->y;

		$this->json['matches'] = json_encode($this->data['matches']);

		$timestamp_fin = microtime(true);
		$difference_ms = $timestamp_fin - $timestamp_debut;
		$this->data['ms'] = $difference_ms;
		$this->data['nb_total'] = $nb_matches;

		$data_send = array (
			'matches' => $this->data['matches'],
			'total_matches' => $nb_matches,
			'ms' => round($difference_ms, 2)
		);
		
		if (is_ajax_query())
		{
			header('Content-Type: application/json');
			echo json_encode($data_send);
			die();
		}
		else
			$this->core->set_view("matches", "main");
	}
}
