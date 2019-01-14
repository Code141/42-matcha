<?php

class v_admin extends v_view
{
		public function main($params = NULL)
		{
			$this->html_files[] = "admin";
			$this->css_files[] = 'admin';
			$this->layout_render();
		}
}
