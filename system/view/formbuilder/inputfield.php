<?php

class InputField
{
	private $text;
	private $name;
	private $type;
	private $id;
	private $value;
	private $placeholder;
	private $attributes;
	
	public function __construct($text, $name, $type = 'text')
	{
		$this->text = $text;
		$this->name = $name;
		$this->type = $type;
		
		$this->id = $name;
		$this->value = null;
		$this->placeholder = null;
		$this->attributes = '';
	}
	
	public function getName() 
	{
		return $this->name;
	}
	public function getType() 
	{
		return $this->type;
	}
	public function getId() 
	{
		return $this->id;
	}
	public function getValue()
	{
		return $this->value;
	}
		
	public function setId($id)
	{
		$this->id = $id;
		return $this;
	}
	public function setValue($value)
	{
		$this->value = $value;
		return $this;
	}
	public function setPlaceholder($placeholder) 
	{
		$this->placeholder = $placeholder;
		return $this;
	}
	public function addAttribute($attribute)
	{
		$this->attributes = $this->attributes .' '. $attribute;
		return $this;
	}
	
	public function asHTML()
	{
		$html = '<div class="inputField">';
		$html = $html . $this->createLabel();
		$html = $html . $this->createField();
		$html = $html .'</div>';
	
		return $html;
	}
	
	public function createLabel()
	{
		$html = '<label for="'. $this->id .'">'. $this->text .'</label>';
		return $html;
	}
	public function createField()
	{
		$html = '<input type="'. $this->type .'" name="'. $this->name .'" id="'. $this->id .'"';
		if($this->value !== null){ $html = $html .' value="'. $this->value .'"'; }
		if($this->placeholder){ $html = $html .' placeholder="'. $this->placeholder .'"'; }
		$html = $html . $this->attributes .'>';
		
		return $html;
	}
}