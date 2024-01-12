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
    // public function testSignUpSuccess(){
    //     $dataSend = array("username"=>"tester".rand(0,100000000),"email"=>"testEmail".rand(0,100000000)."@gmail.com"
    //     ,"password"=>"testPass12AZ");
    //     $classes = UserService::sign($dataSend);
    //     $this->assertFalse($classes["err"]);
    // }
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
    public function testgetUserByUsernameSuccess(){
        $fakeData = array("username"=>"lol");
        $classes = UserService::getUserByUsername($fakeData);
        $this->assertFalse($classes["err"]);
    }
    public function testgetUserByUsernameFail(){
        $fakeData = array("id"=>11,"username"=>10);
        $classes = UserService::getUserByUsername($fakeData);
        $this->assertTrue($classes["err"]);
    }
    public function testgetUserMessagesSuccess(){
        $fakeData = array("senderId"=>1, "receiverId"=>2);
        $classes = UserService::getUserMessages($fakeData);
        $this->assertFalse($classes["err"]);
    }
    public function testgetUserMessagesFail(){
        $fakeData = array(""=>1,"id"=>1, "receiverId"=>2);
        $classes = UserService::getUserMessages($fakeData);
        $this->assertTrue($classes["err"]);
    }
    public function testcreateFollowSuccess(){
        $fakeData = array("follow"=>1,"follower"=>2);
        $classes = UserService::createFollow($fakeData);
        $this->assertFalse($classes["err"]);
    }
    public function testcreateFollowFail(){
        $fakeData = array("follow"=>1,"follower"=>1);
        $classes = UserService::createFollow($fakeData);
        $this->assertTrue($classes["err"]);
    }
    public function testgetTopBloggerSuccess(){

        $classes = UserService::getTopBlogger();
        $this->assertFalse($classes["err"]);
    }
    
}
?>