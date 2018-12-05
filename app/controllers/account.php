<?php

class c_account extends c_controller
{
	public function main($params = NULL)
	{
		$model = $this->load->model("account");
		$this->data['all_tags'] = $model->fetch_all_from("tag");
		$this->data['all_genders'] = $model->fetch_all_from("gender");
		$this->data['all_gender_id'] = $model->fetch_all_from("gender_identity");
		$this->core->set_view("account", "main");
	}

	private function recursive_in_array($haystack, $needle)
	{
		if (is_array($haystack))
		{
			foreach ($haystack as $entry)
				if (is_array($entry) && in_array($needle, $entry))
				{
					$this->recursive_in_array($entry, $needle);
					return TRUE;
				}
		}
		return FALSE;
	}

	public function add_match_pref()
	{
		$model = $this->load->model("account");
		$all_genders = $model->fetch_all_from("gender");
		$all_gender_id = $model->fetch_all_from("gender_identity");
		if ($_POST['gender'] == "" || $_POST['gender_identity'] == "")
			return FALSE;
		if (($_POST['gender'] !== 'NULL' && !$this->recursive_in_array($all_genders, $_POST['gender'])) ||
			($_POST['gender_identity'] !== 'NULL' && !$this->recursive_in_array($all_gender_id, $_POST['gender_identity'])))
		{
			return FALSE;
		}
		echo "ok";
	}	
}
