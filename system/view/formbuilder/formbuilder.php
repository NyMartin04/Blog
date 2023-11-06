<?php

namespace View\FormBuilder;

require_once 'inputfield.php';
require_once 'checkfield.php';
require_once 'selectfield.php';

class FormBuilder
{
	private $action;
	private $method;
	private $button;
	private $btnName;
	private $fields;
	private $values;
	
	public function __construct($action = '', $method = 'post') 
	{
		$this->action = $action;
		$this->method = $method;
		
		$this->button = 'Submit';
		$this->fields = [];
		$this->values = null;
		$this->captchaKey = false;
	}
	
	public function add($inputField) 
	{
		$this->fields[] = $inputField;
		return $this;
	}
	
	public function setValues($values) 
	{
		$this->values = $values;
		return $this;
	}
	public function setButton($text, $name) 
	{
		$this->button = $text;
		$this->btnName = $name;
		return $this;
	}
		
	public function asHTML()
	{
		$html = '<form action="'. $this->action .'" method="'. $this->method .'">';
		
		foreach($this->fields as $field)
		{
			if($this->values)
			{
				$name = $field->getName();
				
				if(isset( $this->values[ $name ] ))
				{
					$value = $this->values[$name];
					$field->setValue($value);
				}
			}
			$html = $html . $field->asHTML();
		}
		$html = $html .'<button name="'. $this->btnName .'" value="1">'. $this->button .'</button>';
		$html = $html .'</form>'; 
		
		return $html;
	}
}

