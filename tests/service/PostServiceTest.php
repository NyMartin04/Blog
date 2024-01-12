<?php
use PHPUnit\Framework\TestCase;
use service\PostService;

require_once __DIR__ . '\..\..\Autoloader.php';

class PostServiceTest extends TestCase{

    public function testcreatePostSuccess(){
        $dataSend = array(
            "postId"=>null,
            "title"=>"Test_postTit".rand(0,10000000),
            "text"=>"Test_postText".rand(0,10000000),
            "userID"=>6,
            "IsFile"=>1,
            "carName"=>"Test_carname".rand(0,10000000),
            "carBrand"=>"Test_carBand".rand(0,10000000));
        $classes = PostService::createPost($dataSend);
        $this->assertFalse($classes["err"]);
    }

}