<?php

class v_view
{
	public $layout = 'default';
	public $html_files = array();
	public $css_files = array();
	public $js_files = array();

	public $prompter = array(
		"success" => "",
		"fail" => "");

	private function protect_html_injection(array $data)
	{
		foreach ($data as $key => $value)
			if (is_string($value))
				$data[$key] = htmlspecialchars($value);
			else if (is_array($value))
				$data[$key] = $this->protect_html_injection($value);
			else
				$data[$key] = $value;
		return ($data);
	}

	protected function	render()
	{
		$this->data = $this->protect_html_injection($this->data);
		if (is_ajax_query())
			$this->ajax_render();
		else
			$this->regular_render();
	}
	
	private function ajax_render()
	{
		foreach($this->files['views'] as $key => $filename)
		{
			ob_start();
			$this->load_html($filename);
			$html_file =  ob_get_contents();
			$html_file = str_replace(array("\t", "\r", "\n"), "", $html_file);
			$html[$key] = $html_file;
			ob_clean();
		}
		$data = array(
			"prompter" => $this->prompter,
			"html" => $html
		);
		$json_response = json_encode($data);
		header("Content-Type: application/json");
		echo ($json_response);
	}

	public function regular_render()
	{
		$basic_css[] = 'reset';
		$basic_css[] = 'style';
		$this->css_files = array_merge($basic_css, $this->css_files);

		$this->load_html('layout/' . $this->layout);
	}

	protected function	linear_render()
	{
		foreach($this->html_files as $key => $filename)
		{
			$this->load_html($filename);
		}
	}

	public function load_html($file)
	{
		if (is_readable(APP_PATH . 'html/' . $file . '.html'))
			require(APP_PATH . 'html/' . $file . '.html');
		else if (is_readable(CORE_PATH . 'html/' . $file . '.html'))
			require(CORE_PATH . 'html/' . $file . '.html');
		else
		{
			echo '<h1 style="color:red;">Can\'t find view "' . $file . '" in app/ or core/</h1>'; 
			die();
		}
	}
}

