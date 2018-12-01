<?php

class c_message extends c_controller
{
	public function main($params = NULL)
	{
		$this->module_loader->session();
		$this->user = $this->module->session->user_loggued();

		$this->data['msg'] = $this->load->model("message")->get_conv($this->user['id']);
		$this->core->set_view("message", "main");
	}

	public function conversation($params = NULL)
	{
		$this->module_loader->session();
		$this->user = $this->module->session->user_loggued();

		$this->data['msg'] = $this->load->model("message")->get_conv($this->user['id']);
		$this->core->set_view("message", "main");
	}

}
