<?php

class SelectField extends InputField
{
	private $options;
	
	public function __construct($text, $name, $options) 
	{
		parent::__construct($text, $name, '');
		
		$this->options = $options;
	}
	
	public function createField() 
	{
		$html = '<select name="'. $this->getName() .'" id="'. $this->getId() .'">';
		
		foreach($this->options as $i => $option)
		{
			$value = $this->getValue();
			
			$html = $html .'<option value="'. $i .'"';
			if($value == $i){ $html = $html .' selected'; }
			$html = $html .'>'. $option .'</option>'; 
		}
		$html = $html .'</select>';
		
		return $html;
	}
}

