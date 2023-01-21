<?php

class Idojaras_Controller
{
	public $baseName = 'idojaras';
	public function main(array $vars)
	{
		$view = new View_Loader($this->baseName."_main");
	}
}

?>