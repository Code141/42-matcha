
<?php
class m_profil extends m_wrapper
{
	public function fetch_user($id_profil, $id_user_logged)
	{
		$i = count($this->bind_param);
		$this->select[] = "*"; 
		$this->from[] = "user u";
		$this->join[] = "LEFT OUTER JOIN blocked b ON b.`id_user(to)` = u.id";
		$this->join[] = "LEFT JOIN user_orientation uo ON uo.id_user = u.id";
		$this->join[] = "LEFT JOIN user_tags ut ON ut.id_user = u.id";
		$this->condition[] = "NOT b.`id_user(from)` = :" . $i;
		$this->bind_param[] = $id_user_logged;
		return ($this);
	}
}
