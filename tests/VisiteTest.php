<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Tests;

use App\Entity\Visite;
use PHPUnit\Framework\TestCase;

/**
 * Description of VisiteTest
 *
 * @author intad
 */
class VisiteTest extends TestCase {
    //put your code here
    public function testGetDatecreationString(){
        $visite = new Visite();
        $visite->setDatecreation(new \DateTime("2022-04-14"));
        $this->assertEquals("14/04/2022", $visite->getDatecreationString());
    }
}
