<?php

class c_message extends c_controller
{
	public function main($params = NULL)
	{
		$this->module_loader->session();
		$this->user = $this->module->session->user_loggued();

		$this->data['all_conv'] = $this->load->model("message")->get_all_conv($this->user['id']);
		$this->core->set_view("message", "main");
	}

	public function conversation($params = NULL)
	{
		if (!empty($params[0]))
			$id_conv = intval($params[0]);
		else
			DIE("ID CONV UNSET must do someting");
		$id_conv = ($id_conv > 0) ? $id_conv : 0;
		if ($id_conv == 0)
			DIE("ID CONV NULL goto newmessage with error");
		$this->module_loader->session();
		$this->user = $this->module->session->user_loggued();
		$conv = $this->load->model("message")->is_user_conv($id_conv, $this->user['id']);
		if ($conv == NULL)
			DIE("CONV DONT EXISTE OR NOT YOURS");
		else if (!empty($_POST['msg']))
			$this->load->model("message")->send_msg($id_conv, $this->user['id'], $conv['id_user'], $_POST['msg']);
		$this->data['id_conv'] = $id_conv;
		$this->data['id_user'] = $conv['id_user'];
		$this->data['all_conv'] = $this->load->model("message")->get_all_conv($this->user['id']);
		$this->data['msg'] = $this->load->model("message")->get_msg($id_conv, $this->user['id']);
		$this->load->model("message")->seen($id_conv, $this->user['id']);
		/*
			UPDATE SEND SEEN ON ALL LAST MSGS
		*/
		$this->core->set_view("message", "main");
	}
}
