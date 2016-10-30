<?php

use PHPUnit\Framework\TestCase;

use CoreWine\Youtube\Youtube;

class SimpleTest extends TestCase{
   
    public function testVideo(){

        Youtube::download('bVSNKn3YTew','tmp/bVSNKn3YTew');
    }

}