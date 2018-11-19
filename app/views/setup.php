<?php

class v_setup extends v_view
{
		public function main($params = NULL)
		{
			$this->html_files[] = "setup/setup";
			$this->layout_render();
		}
}
