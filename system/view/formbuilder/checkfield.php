<?php

class CheckField extends InputField
{
	public function __construct($text, $name) 
	{
		parent::__construct($text, $name, 'checkbox');
	}
	
	public function setValue($value)
	{
		if($value)
		{
			$this->addAttribute('checked');
		}
		return $this;
	}
	
	public function asHTML()
	{
		$html = '<div class="inputField">';
		$html = $html . $this->createField();
		$html = $html . $this->createLabel();
		$html = $html . '</div>';
		
		return $html;
	}
}

