<?php

namespace View;

class Login_x_Register
{	
	public static function Login($submit)
	{
		echo '<section class="panel"><h2>Login</h2>';
		
		$form = new FormBuilder\FormBuilder;
		
		if($submit === false)
		{
			echo '<p class="message error"><strong>Login failed!</strong>Login cannot be succeded with the filled data. (Or the email address is not yet confirmed.)</p>';
			
			$form->setValues(['email' => \Req::Post('email')]);
		}
		
		$form->add( new \InputField('E-mail', 'email', 'email') );
		$form->add( new \InputField('Password', 'password', 'password') );
		$form->setButton('Login', 'loginSent');
		echo $form->asHTML();
		
		echo '</section>';
	}
	public static function Registration($error)
	{
		echo '<section class="panel"><h2>Registration</h2>';
		
		$form = new FormBuilder\FormBuilder();
		
		if($error)
		{
			echo '<p class="message error"><strong>An error occured while you filled the fields.</strong>'. $error .'</p>';
			
			$form->setValues(\Req::Post());
		}
		
		$form->add( new \InputField('Username', 'name') );
		$form->add( new \InputField('E-mail', 'email', 'email') );
		$form->add( new \InputField('Confirm E-mail', 'email2', 'email') );
		$form->add( new \InputField('Password', 'password', 'password') );
		$form->add( new \InputField('Confirm Password', 'password2', 'password') );
		$form->add( new \CheckField('I accept the <a href="" target="_blank">Privacy Policy.</a>', 'accept') );
		$form->setButton('Register', 'regSent');
		echo $form->asHTML();
	}
	public static function RegistrationSuccess()
	{
		echo '<section class="panel"><h2>Registration was succesful!</h2>';
		echo '<p>We saved your data, please check your e-mail in order to activate your account!</p>';
		echo '</section>';
	}
	public static function ActivationSuccess()
	{
		echo '<section class="panel"><h2>Activation succesful!</h2>';
		echo '<p>You can now enter with your data.</p>';
		echo '</section>';
	}
	
	public static function DashboardView($data)
	{
		echo '<a href="?page=myAccount&action=logout">Log out</a>';
		
		echo '<section class="panel"><h2>Your blogbposts</h2>';

        //TODO: List user's all post
			
		echo '</section>';
	}
}

