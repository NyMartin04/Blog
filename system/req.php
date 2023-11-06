<?php

class Req
{
	public static function Get($name, $default = null)
	{
		if(isset($_GET[ $name ]))
		{
			$value = $_GET[$name];
			$value = htmlspecialchars($value);
		}
		else
		{
			$value = $default;
		}
		return $value;
	}
	public static function Post($name = null)
	{
		if($name)
		{
			if(isset($_POST[ $name ]))
			{
				$value = $_POST[$name];
				$value = htmlspecialchars($value);
				return $value;
			}
		}
		else
		{
			$values = null;
			
			if($_POST)
			{
				$values = [];
				
				foreach($_POST as $key => $value)
				{
					$values[$key] = htmlspecialchars($value);
				}
			}
			return $values;
		}
	}
}