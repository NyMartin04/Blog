<?php

namespace controller;

class PostsController{
    public static function Main(){
        $loggedIn = false;
        if ($loggedIn == false) {
            echo 'Login to see your posts.';
        } else{
            echo 'Your posts:';
        }
    }
}

