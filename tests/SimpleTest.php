<?php

use PHPUnit\Framework\TestCase;

use CoreWine\Youtube\Youtube;

class SimpleTest extends TestCase{
   
    public function testVideo(){

        print_r(Youtube::video('iNJdPyoqt8U') -> getVideoCloserTo('720p') -> getUrl());
        return;

        print_r(Youtube::video('i5DjkBBonlo'));
    }

}