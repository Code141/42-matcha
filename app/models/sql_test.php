<?php

class m_sql_test extends m_wrapper
{

	public function test()
	{
		$this->select(array("user" => "username"),"user")->where("user","id", "=" , "1");
		return ($this);
	}

	public function sort_by_tags(array $tags)
	{
		foreach ($tags as $tag_id)
		{
			$this->and("ut2", "id", "=", $tag_id);
		}
	}

	public function all_matches($user_id)
	{
		$i = count($this->bind_param);
		echo "<br> count matches = " . $i . "<br>";
	/*	$this->sql =
		"SELECT DISTINCT ug2.id_user
		FROM user_orientation uo1
		LEFT JOIN user_gender ug1
		ON ug1.id_user = uo1.id_user
		LEFT JOIN user_gender ug2
		ON ug2.id_gender = uo1.id_gender
		LEFT JOIN user_orientation uo2
		ON uo2.id_user = ug2.id_user
		WHERE uo1.id_gender = ug2.id_gender
		AND uo2.id_gender = ug1.id_gender
		AND uo1.id_user = :" . $i;*/
		$this->select[] = "DISTINCT ug2.id_user";
		$this->from[] = "user_orientation uo1";
		$this->join[] = "user_gender ug1 ON ug1.id_user = uo1.id_user";
		$this->join[] = "user_gender ug2 ON ug2.id_gender = uo1.id_gender";
		$this->join[] = "user_gender_identity ugi2 ON ugi2.id_user = ug2.id_user";
		$this->join[] = "user_gender_identity ugi1 ON ugi1.id_user = ug1.id_user";
		$this->join[] = "user_orientation uo2 ON uo2.id_user = ug2.id_user AND uo2.id_user = ugi2.id_user";
		$this->condition[] = "uo1.id_gender = ug2.id_gender
							AND uo2.id_gender = ug1.id_gender
							AND uo1.id_user = :" . $i . 
							" AND NOT uo2.id_user = :" . ($i+1) ;
		$this->order[] = "ug2.id_user ASC";
		
		$this->bind_param[] = $user_id;
		$this->bind_param[] = $user_id;
		return ($this);
	}
	
	public function matches_gender_identity()
	{
		$this->condition[] = "ugi2.id_gender = uo1.id_gender_identity
			       				AND uo2.id_gender_identity = ugi1.id_gender"; 
		return ($this);
	}
	
	public function sort_matches_by_tag()
	{
		$this->sql = 
			"SELECT DISTINCT uo2.id_user, COUNT(DISTINCT ut2.id_tag) as c
			FROM user_orientation uo1
LEFT JOIN user_gender ug1
ON ug1.id_user = uo1.id_user
JOIN user_gender ug2
ON ug2.id_gender = uo1.id_gender
LEFT JOIN user_orientation uo2
ON uo2.id_user = ug2.id_user

LEFT JOIN user_tags ut2
ON ut2.id_user = uo2.id_user
AND (ut2.id_tag = 290
OR ut2.id_tag = 216)

WHERE uo1.id_gender = ug2.id_gender
AND uo2.id_gender = ug1.id_gender

AND uo1.id_user = 1
AND NOT uo2.id_user = 1

GROUP BY uo2.id_user

ORDER BY c DESC";
	}

	public function only_matches_with_same_tags($user_id)
	{
		$i = count($this->bind_param);

		$this->sql =
/*			"SELECT DISTINCT ug2.id_user
			FROM user_orientation uo1
			LEFT JOIN user_gender ug1
			ON ug1.id_user = uo1.id_user
			LEFT JOIN user_gender ug2
			ON ug2.id_gender = uo1.id_gender
			LEFT JOIN user_orientation uo2
			ON uo2.id_user = ug2.id_user



			LEFT JOIN user_tags ut1
			ON ut1.id_user = uo1.id_user

			JOIN user_tags ut2
			ON ut2.id_user = uo2.id_user

			WHERE uo1.id_gender = ug2.id_gender
			AND uo2.id_gender = ug1.id_gender

			AND ut1.id_tag = ut2.id_tag
			AND NOT ut2.id_user = :" . $i . 

			"AND uo1.id_user = :" . $i;
 */


			$this->join[] = "user_tags ut1 ON ut1.id_user = uo1.id_user";
			$this->join[] = "user_tags ut2 ON ut2.id_user = uo2.id_user";

			$this->condition[] = "ut1.id_tag = ut2.id_tag 
				AND NOT ut2.id_user = :" . $i; 

			$this->bind_param[$i] = $user_id;
			return ($this);
	}
	
	public function all_matches_sort_by_tags()
	{
		$this->all_matches();
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
