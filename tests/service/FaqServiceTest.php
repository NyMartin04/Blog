<?php
use PHPUnit\Framework\TestCase;
use service\FaqService;

require_once __DIR__ . '\..\..\Autoloader.php';

class FaqServiceTest extends TestCase{

    // public function testcreateFaqSuccess(){
    //     $dataSend = array(
    //         "name"=>"test_".rand(0,10000000));
    //     $classes = FaqService::createFaq($dataSend);
    //     $this->assertFalse($classes["err"]);
    // }
    public function testgetAllFaqSuccess(){
        $dataSend = array();
        $classes = FaqService::getAllFaq();
        $this->assertFalse($classes["err"]);
    }
    public function testgetFaqByIdSuccess(){
        $dataSend = array("faqId"=>1);
        $classes = FaqService::getFaqById($dataSend);
        $this->assertFalse($classes["err"]);
    }

}