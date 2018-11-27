<?php

class m_matches extends m_wrapper
{
	public function all_users($user_id)
	{
		$i = count($this->bind_param);
		$this->select[] = "DISTINCT u2.id, u2.username, u2.id_gender, gn.gender_name, u2.id_gender_identity, gin.gender_identity_name, u2.birthdate, u2.id_media, u2.latitude, u2.longitude";
		$this->from[] = "user u2";
		$this->join[] = "LEFT OUTER JOIN blocked b ON b.`id_user(to)` = u2.id";
		$this->join[] = "LEFT OUTER JOIN gender gn ON gn.id = u2.id_gender";
		$this->join[] = "LEFT OUTER JOIN gender_identity gin ON gin.id = u2.id_gender_identity";
		$this->condition[] ="NOT u2.id = :" . $i . 
			" AND (`b`.`id_user(from)` IS NULL 
			OR NOT `b`.`id_user(from)` = :". ($i+1) ." )";
		$this->bind_param[] = $user_id;
		$this->bind_param[] = $user_id;
		return ($this);
	}
	
	public function matches($user)
	{
		$i = count($this->bind_param);
		$c = array();
		$compg = "";
		$compgi = "";
		foreach ($user['orientations'] as $o)
		{
			if ($o["id_gender"] == NULL)
				$compg = "(";
			else if ($o["id_gender"])
			{
				$compg = "(u2.id_gender = :" . $i;
				$this->bind_param[] = $o["id_gender"];
				$i++;
			}
			if ($o["id_gender_identity"] == NULL)
				$compgi = ")";
			else if ($o["id_gender_identity"])
			{
				if ($compg)
					$compgi = " AND ";
				$compgi .= "u2.id_gender_identity = :" . $i . ")";
				$this->bind_param[] = $o["id_gender_identity"];
				$i++;
			}
			$c[] = $compg . $compgi;
		}
		$c = "( " . implode(" OR ", $c) . " )";		
		$this->join[] = "LEFT JOIN user_orientation uo2 ON uo2.id_user = u2.id";
		$this->condition[] = $c . " AND (uo2.id_gender = :" . $i . " OR uo2.id_gender IS NULL)
							 AND (uo2.id_gender_identity = :" . ($i+1) . " OR uo2.id_gender_identity IS NULL)";
		$this->bind_param[] = $user['id_gender'];
		$this->bind_param[] = $user['id_gender_identity'];
		return ($this);
	}

	public function order_by_matching_tags(array $user)
	{	
		$i = count($this->bind_param);
		$this->select[] = "COUNT(DISTINCT ut2.id_tag) as 'nb matching tags'";

		$comp_tag = array();
		foreach ($user['tags'] as $tag)
		{
			$comp_tag[] = "ut2.id_tag = :" . $i;
			$this->bind_param[] = $tag['id'];
			$i++;
		}
		$comp_tag = "( " . implode(" OR ", $comp_tag) . " )";
		$this->join[] = "LEFT JOIN user_tags ut2 ON ut2.id_user = u2.id AND " . $comp_tag;
	 	$this->group_by[] = "u2.id";
		$this->order[] = "'nb matching tags' DESC";
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
}
