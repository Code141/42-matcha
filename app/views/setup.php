<?php

class v_setup extends v_view
{
		public function main($params = NULL)
		{
			echo 'toto';
			$this->html_files[] = "setup/setup";
			$this->linear_render();
		}
}
