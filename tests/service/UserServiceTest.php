<?php
use PHPUnit\Framework\TestCase;
use service\UserService;

require_once __DIR__ . '\..\..\Autoloader.php';

class UserServiceTest extends TestCase{

    public function testLoginSuccess(){
        $dataSend = array("email"=>"martin@gmail.com"
        ,"password"=>"12345678Az");
        $classes = UserService::login($dataSend);
        $this->assertFalse($classes["err"]);
    }
    public function testSignUpSuccess(){
        $dataSend = array("username"=>"tester".rand(0,100000000),"email"=>"testEmail".rand(0,100000000)."@gmail.com"
        ,"password"=>"testPass12AZ");
        $classes = UserService::sign($dataSend);
        $this->assertFalse($classes["err"]);
    }
    public function testLoginFail(){
        $dataSend = array("email"=>"martin@gmail.com"
        ,"password"=>"");
        $classes = UserService::login($dataSend);
        $this->assertTrue($classes["err"]);
    }
    public function testSignUpFail(){
        $dataSend = array("username"=>"tester".rand(0,100000000),"email"=>"testEmail".rand(0,100000000)."@gmail.com"
        ,"password"=>"worngnpass");
        $classes = UserService::sign($dataSend);
        $this->assertTrue($classes["err"]);
    }
    public function testgetUserByIdSuccess(){
        $fakeData = array("id"=>1);
        $classes = UserService::getUserById($fakeData);
        $this->assertFalse($classes["err"]);
    }
    public function testgetUserByIdFail(){
        $fakeData = array();
        $classes = UserService::getUserById($fakeData);
        $this->assertTrue($classes["err"]);
    }

}
?>