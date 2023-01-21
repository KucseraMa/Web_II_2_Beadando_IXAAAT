<?php 
class Chart_Controller
{
	public $baseName = 'chart';  //meghat�rozni, hogy melyik oldalon vagyunk
	public function main(array $vars) // a router �ltal tov�bb�tott param�tereket kapja
	{
		$chartModel = new Chart_Model();
		$retData = $chartModel ->get_data($vars);
		if($retData['eredmeny'] == "ERROR")
		$this->baseName = "chart";
		//bet�ltj�k a n�zetet
		$view = new View_Loader($this->baseName."_main");
		foreach($retData as $name => $value)
		$view->assign($name, $value);
	}
}

?>