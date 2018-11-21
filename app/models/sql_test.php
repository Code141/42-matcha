<?php

class m_sql_test extends m_wrapper
{
	public function all_users($user_id)
	{
		$i = count($this->bind_param);
		$this->select[] = "DISTINCT u2.id";
		$this->from[] = "user u2";
		$this->condition[] ="NOT u2.id = :" . ($i);
		$this->bind_param[] = $user_id;
		return ($this);
	}
/*
	public function all_matches($user_id)
	{
		$i = count($this->bind_param);
		$this->join[] = "JOIN user_orientation uo1 ON uo1.id_gender = u2.id_gender";
		$this->join[] = "LEFT JOIN user u1 ON u1.id = uo1.id_user";
		$this->join[] = "LEFT JOIN user_orientation uo2 ON uo2.id_user = u2.id";
		$this->condition[] = "uo1.id_gender = u2.id_gender
							AND uo2.id_gender = u1.id_gender
							AND uo1.id_user = :" . $i;
		$this->bind_param[] = $user_id;
		return ($this);
	}
 */
	
	public function all_matches($user_id, $orientations)
	{
		var_dump($orientations);
		echo "<br>";
		$i = count($this->bind_param);
		$c = array();
		$compg = "";
		$compgi = "";
		foreach ($orientations as $o)
		{
			if ($o["gender"] == NULL)
				$compg = "(";
			else if ($o["gender"])
			{
				$compg = "(u2.id_gender = :" . $i;
				$this->bind_param[] = $o["gender"];
				$i++;
			}
			if ($o["gender_identity"] == NULL)
				$compgi = ")";
			else if ($o["gender_identity"])
			{
				if ($compg)
					$compgi = " AND ";
				$compgi .= "u2.id_gender_identity = :" . $i . ")";
				$this->bind_param[] = $o["gender_identity"];
			}
			$c[] = $compg . $compgi;
			$i++;
		}
		$c = "( " . implode(" OR ", $c) . " )";		
		//$this->join[] = "LEFT JOIN user u1 ON u1.id = uo1.id_user";
		$this->join[] = "LEFT JOIN user u1 ON u1.id = u2.id";
		$this->join[] = "LEFT JOIN user_orientation uo2 ON uo2.id_user = u2.id";
		$this->condition[] = $c . " AND uo2.id_gender = u1.id_gender";
//		$this->bind_param[] = $user_id;
		return ($this);
	}

	public function matches_gender_identity($user_gender_identity)
	{
		$i = count($this->bind_param);
		$this->condition[] = "u2.id_gender_identity = uo1.id_gender_identity
			       				AND uo2.id_gender_identity = :" . $i; 
		$this->bind_param[] = $user_gender_identity;
		return ($this);
	}

	public function sort_by_tags(array $user_tags)
	{	
		$i = count($this->bind_param);
		$this->select[] = "COUNT(DISTINCT ut2.id_tag) as c";

		$comp_tag = array();
		foreach ($user_tags as $tag)
		{
			$comp_tag[] = "ut2.id_tag = :" . $i;
			$this->bind_param[] = $tag;
			$i++;
		}
		$comp_tag = "( " . implode(" OR ", $comp_tag) . " )";
 
		$this->join[] = "LEFT JOIN user_tags ut2 ON ut2.id_user = u2.id AND " . $comp_tag;
		$this->group_by[] = "u2.id";
		$this->order[] = "c DESC";
		return ($this);
}

	public function keep_only_with_same_tags(array $user_tags)
	{
		$i = count($this->bind_param);
		//$this->join[] = "LEFT JOIN user_tags ut2 ON ut2.id_user = uo2.id_user";
		$comp_tag = array();
		foreach ($user_tags as $tag)
		{
			$comp_tag[] = "ut2.id_tag = :" . $i;
			$this->bind_param[] = $tag;
			$i++;
		}
		$comp_tag = "( " . implode(" OR ", $comp_tag) . " )";
		$this->condition[] = $comp_tag; 
		return ($this);
	}
	
	public function user_from_username($username)
	{
		$i = count($this->bind_param);
		$this->db->sql =
			"SELECT u.id, u.username, u.firstname, u.lastname, u.birthdate,
			u.account_valid, u.id_media, ua.password, ua.email, ua.new_email,
			ua.token_email, ua.token_password, ua.token_account
			FROM user u
			LEFT JOIN user_account ua
			ON ua.id_user = u.id 
			WHERE u.username = :" . $i;
		$this->bind_param[$i] = $username;
	}
/*
	public function redundant_orientations()
	{
		$this->db->sql =
			"SELECT uo1.id_user, uo1.id_gender, uo1.id_gender_identity
			FROM user_orientation uo1 
			JOIN user_orientation uo2 
			ON (uo2.id_gender = uo1.id_gender 
			AND (uo2.id_user = uo1.id_user
			AND uo2.id_gender_identity = 0
			AND NOT uo1.id_gender_identity = 0))
			OR (uo2.id_gender_identity = uo1.id_gender_identity 
			AND (uo2.id_user = uo1.id_user
			AND uo2.id_gender = 0
			AND NOT uo1.id_gender = 0))
			ORDER BY uo1.id_user, uo1.id_gender, uo1.id_gender_identity ASC";
	}
*/

	public function delete_redundant_orientations()
	{
		$this->db->sql = 
			"DELETE uo1
			FROM user_orientation uo1

			INNER JOIN user_orientation uo2
			ON (uo2.id_gender = uo1.id_gender
			AND (uo2.id_user = uo1.id_user
			AND uo2.id_gender_identity = 0
			AND NOT uo1.id_gender_identity = 0))

			OR (uo2.id_gender_identity = uo1.id_gender_identity
			AND (uo2.id_user = uo1.id_user
			AND uo2.id_gender = 0
			AND NOT uo1.id_gender = 0))";
	}
}
