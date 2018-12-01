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
}
