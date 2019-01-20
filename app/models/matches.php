<?php

class m_matches extends m_wrapper
{
	
	public function match($user)
	{
		$i = count($this->bind_param);
		$c = array();
		$compg = "";
		$compgi = "";
		foreach ($user['orientations'] as $o)
		{
			if ($o["id_gender"] == -1)
				$compg = "(";
			else if ($o["id_gender"])
			{
				$compg = "(u2.id_gender = :" . $i;
				$this->bind_param[] = $o["id_gender"];
				$i++;
			}
			if ($o["id_gender_identity"] == -1)
				$compgi = ")";
			else if ($o["id_gender_identity"])
			{
				if ($compg && $compg != "(")
					$compgi = " AND ";
				$compgi .= "u2.id_gender_identity = :" . $i . ")";
				$this->bind_param[] = $o["id_gender_identity"];
				$i++;
			}
			if (!($compg == "(" && $compgi == ")"))
				$c[] = $compg . $compgi;
		}
		if (count($c))
		{
			$c = "( " . implode(" OR ", $c) . " )";		
			$this->condition[] = $c . " AND (uo2.id_gender = :" . $i . " OR uo2.id_gender = -1)
							 AND (uo2.id_gender_identity = :" . ($i+1) . " OR uo2.id_gender_identity = -1)";
		}
		else
			$this->condition[] = "(uo2.id_gender = :" . $i . " OR uo2.id_gender = -1)
							 AND (uo2.id_gender_identity = :" . ($i+1) . " OR uo2.id_gender_identity = -1)";
		$this->bind_param[] = $user['id_gender'];
		$this->bind_param[] = $user['id_gender_identity'];
		return ($this);
	}

	public function suggestion($user)
	{
		$i = count($this->bind_param);
		$this->select[] = "DISTINCT u2.id";
		$this->select[] = "u2.username";
		$this->select[] = "u2.score";

		$this->select[] = "u2.id_gender";
		$this->select[] = "gn.gender_name";
		$this->select[] = "u2.id_gender_identity";
		$this->select[] = "gin.gender_identity_name";
		$this->select[] = "u2.id_media";
		$this->select[] = "ST_Distance_Sphere( point( :" . ($i) ." , :" . ($i+1) . " ),
							point(u2.longitude, u2.latitude) ) as distance";
		$this->select[] = "u2.latitude";
		$this->select[] = "u2.longitude";
		$this->select[] = "u2.birthdate";
		$this->select[] = "u2.id_media";
		$this->select[] = "COUNT(DISTINCT ut2.id_tag) as 'nb_matching_tags'";
		$this->from[] = "user u2";
		$this->join[] = "LEFT OUTER JOIN blocked b ON b.`id_user_to` = u2.id";


		$this->join[] = "LEFT OUTER JOIN gender gn ON gn.id = u2.id_gender";
		$this->join[] = "LEFT OUTER JOIN gender_identity gin ON gin.id = u2.id_gender_identity";
		
		$this->bind_param[] = $user['longitude'];
		$this->bind_param[] = $user['latitude'];
		$i = count($this->bind_param);
		$comp_tag = array();
		foreach ($user['tags'] as $tag)
		{
			$comp_tag[] = "ut2.id_tag = :" . $i;
			$this->bind_param[] = $tag['id'];
			$i++;
		}
		$comp_tag = "( " . implode(" OR ", $comp_tag) . " )";
		$this->join[] = "LEFT JOIN user_tags ut2 ON ut2.id_user = u2.id AND " . $comp_tag;
		$this->condition[] ="NOT u2.id = :" . $i .
			" AND (`b`.`id_user_from` IS NULL
			OR NOT `b`.`id_user_from` = :". ($i) ." )";
		$this->bind_param[] = $user['id'];
		$this->join[] = "LEFT JOIN user_orientation uo2 ON uo2.id_user = u2.id";
		$index = count($this->bind_param);
		$i = $index;
		$c = array();
		$compg = "";
		$all_genders = FALSE;
		if (!$user['orientations'])
			$all_genders = TRUE;
		foreach ($user['orientations'] as $o)
		{
			if ($o["id_gender"] == -1)
			{
				$all_genders = TRUE;
				while ($i > $index)
				{
					$i--;
					unset($this->bind_param[$i]);
				}
				break;
			}
			else if ($o["id_gender"])
			{
				$c[] = "u2.id_gender = :" . $i;
				$this->bind_param[] = $o["id_gender"];
				$i++;
			}
		}
		$compg = "( " . implode(" OR ", $c) . ")";
		$compuo = "(uo2.id_gender = :" . $i . " OR uo2.id_gender = -1)";
		$this->bind_param[] = $user['id_gender'];
	
		if ($all_genders == FALSE)
			$this->condition[] = $compg . " OR " . $comp_tag . " OR " . $compuo;
		else
			$this->condition[] = $comp_tag . " OR " . $compuo;

		$this->group_by[] = "u2.id";

		$g = array();	
		$i = count($this->bind_param);
		if (!$all_genders)
		{
			foreach ($user['orientations'] as $o)
			{
				if ($o['id_gender'])
				{
					$g[] = "u3.id_gender = :" . $i;
					$this->bind_param[] = $o["id_gender"];
					$i++;
				}
			}
			$joinon = "( " . implode(" OR ",$g) . ")";
			$this->join[] = "LEFT JOIN user u3 ON u3.id = u2.id AND " . $joinon;
		}
		return ($this);
	}

	public function order_by_gender()
	{
		$this->order[] = "COUNT(DISTINCT u3.id_gender) DESC";
		return($this);
	}

	public function order_by_matching_tags(array $user)
	{	
		$this->order[] = "COUNT(DISTINCT ut2.id_tag) DESC";
		return ($this);
	}

	public function filter_by_tags(array $tags)
	{
		if ($tags){
		$this->join[] = "LEFT JOIN user_tags ut ON ut.id_user = u2.id";
		$i = count($this->bind_param);
		$comp_tag = array();
		foreach ($tags as $tag)
		{
			$comp_tag[] = "ut.id_tag = :" . $i;
			$this->bind_param[] = $tag;
			$i++;
		}
		$comp_tag = "( " . implode(" OR ", $comp_tag) . " )";
		$this->condition[] = $comp_tag; 
		}
		return ($this);
	}

	public function order_by_birthdate($direction)
	{
		$this->select[] = "u2.birthdate";
		$this->order[] = "u2.birthdate " . $direction;
		return ($this);
	}

	public function filter_by_birthdate($from, $to)
	{
		$i = count($this->bind_param);
		$this->condition[] = "u2.birthdate BETWEEN CAST( :" . $i .
			" AS date) AND CAST( :" . ($i+1) . " AS date)";
		$this->bind_param[] = $from;
		$this->bind_param[] = $to;
		return ($this);
	}

	public function order_by_distance($direction)
	{
		$this->order[] = "distance " . $direction;
		return ($this);
	}

	public function filter_by_distance($dist_km)
	{
		$i = count($this->bind_param);
		$dist_m = $dist_km * 1000;
		$this->having[] = "distance <= :" . $i;
		$this->bind_param[] = $dist_m;
		return ($this);
	}

	public function order_by_score($direction)
	{
		$this->select[] = "u2.score";
		$this->order[] = "u2.score " . $direction;
		return ($this);
	}

	public function filter_by_score($from, $to)
	{
		$sql = " SELECT MIN(score) as min, MAX(score) as max FROM user "; 
		$stm = $this->db->pdo->prepare($sql);
		$scores = $stm->execute();
		$scores = $stm->fetchAll(PDO::FETCH_ASSOC)[0];
		$smin = $scores['min'];
		$smax = $scores['max'];

		$from = (($from / 10) * ($smax - $smin)) + $smin;
		$to = (($to / 10) * ($smax - $smin)) + $smin;

		$i = count($this->bind_param);
		$this->condition[] = "u2.score BETWEEN :" . $i .
			" AND :" . ($i+1);
		$this->bind_param[] = $from;
		$this->bind_param[] = $to;
		return ($this);
	}


}
