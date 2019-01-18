<?php

class c_admin extends c_logged_only
{
	public function main($params = NULL)
	{
		if ($_SESSION['user']['is_admin'] == 0)
			$this->core->fail("You are not admin", "dashboard", "main");
		$model = $this->load->model("admin");
		$this->data['blocked_users'] = $model->fetch_blocked_users();
		$this->data['reported_users'] = $model->fetch_reported_users();
		$this->core->set_view("admin", "main");
	}

	public	function delete_user()
	{
		if ($_SESSION['user']['is_admin'] == 0)
			$this->core->fail("You are not admin", "dashboard", "main");
		if (empty($_POST['to_delete']) || !is_numeric($_POST['to_delete']) || $_POST['to_delete'] <= 0)
			$this->core->fail("Error in input", "admin", "main");
		$model = $this->load->model("admin");
		$user_medias = $model->fetch_user_media($_POST['to_delete']);
		foreach ($user_medias as $media)
			if (file_exists(APP_PATH . 'assets/media/' . $media['id_media'] . '.png')
				&& !unlink(APP_PATH . 'assets/media/' . $media['id_media'] . '.png'))
			$this->core->fail($media['id_media'] . ".png from user with id : " . $_POST['to_delete'] . "failed to unlink.<br> User is still in db - proceed to manuel removal", "admin", "main");
		if ($ret = $model->delete_user($_POST['to_delete']))
			$this->core->success("User successfully deleted", "admin", "main");
		else
			$this->core->fail("Something went wrong", "admin", "main");
	}
}
