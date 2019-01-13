<?php

class c_dashboard extends c_logged_only
{
	public function main($params = NULL)
	{
		$user = $this->module_loader->session()->controller->user_loggued();

		$model = $this->load->model("dashboard");
		$this->data['blocked'] = $model->get_blocked($user['id']);


		$this->core->set_view("dashboard", "main");
	}

	public function del_tag()
	{
		if (!isset($_POST['tag']) || !is_numeric($_POST['tag']))
			$this->core->fail("No tag specified", 'account', 'main');
		$user = $_SESSION['user'];
		$model = $this->load->model("account");
		$model->del_tag($user['id'], $_POST['tag']);
		$this->module_loader->session()->controller->update_session();
		$this->core->success("Tag successfully deleted", 'account', 'main');
	}

	public function add_tag()
	{
		if (!isset($_POST['tag']) || $_POST['tag'] == "")
			$this->core->fail("Tag must contain at least one character", 'account', 'main');
		$tag_name = preg_replace("/^\s*#*\s*/", "", $_POST['tag']);
		$tag_name = rtrim($tag_name);
		if ($tag_name == "")
			$this->core->fail("Tag is badly formated", 'account', 'main');
		if (strlen($tag_name) >= 64)
			$this->core->fail("Tag is too long", 'account', 'main');
		$user = $_SESSION['user'];
		$model = $this->load->model("account");
		if (!$model->add_tag($user['id'], $tag_name))
			$this->core->fail("No tag to add", 'account', 'main');
		$this->module_loader->session()->controller->update_session();
		$this->core->success("Tag successfully added", 'account', 'main');
	}
}
