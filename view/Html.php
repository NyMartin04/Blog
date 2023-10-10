<?php

namespace View;

class Html{
    public static function pageBuild($title){
        $html = '<!DOCTYPE html><html><head><base href=http://127.0.0.1/JCSblog/">';
        $html = $html .'<meta charset="utf-8">';
        $html = $html .'<meta name="viewport" content="width=device-width, initial-scale=1.0">';

        $html = $html .'<title>'. $title .'</title>';
        $html = $html .'<meta itemprop="name" content="'. $title .'">';
        $html = $html .'<meta property="og:title" content="'. $title .'">';

        if(self::$desc){
            $html = $html .'<meta name="description" content="'. self::$desc .'">';
            $html = $html .'<meta itemprop="description" content="'. self::$desc .'">';
            $html = $html .'<meta property="og:description" content="'. self::$desc .'">';
        }
        if(self::$image){
            $html = $html .'<meta itemprop="image" content="'. self::$image .'">';
            $html = $html .'<meta property="og:image" content="'. self::$image .'">';
        }
        if(self::$robot){
            $html = $html .'<meta name="robots" content="index, follow">';
            $html = $html .'<meta name="revisit-after" content="7 days">';
        } else{
            $html = $html .'<meta name="robots" content="noindex, nofollow">';
        }

        if(self::$style){
            foreach(self::$style as $css){
                $html = $html .'<link rel="stylesheet" href="'. $css .'">';
            }
        }
        if(self::$script){
            foreach(self::$script as $js){
                $html = $html .'<script src="'. $js .'"></script>';
            }
        }
        $html = $html .'</head><body>';

        echo $html;
    }
    public static function addStyle($style){
        self::$style = $style;
    }
    public static function addScript($script, $end = false){
        if(!$end){
            self::$script[] = $script;
        } else{
            self::$scriptEnd[] = $script;
        }
    }
    public static function setDesc($desc){
        self::$description = $desc;
    }
    public static function setImg($img){
        self::$image = $img;
    }
    public static function disRob(){
        self::$robot = false;
    }

    private static $style = [];
    private static $script = [];
    private static $scriptEnd = [];
    private static $desc = '';
    private static $image = '';
    private static $robot = true;
}