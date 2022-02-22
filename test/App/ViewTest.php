<?php

namespace ProgrammerZamanNow\Belajar\PHP\MVC\App;

use PHPUnit\Framework\TestCase;

class ViewTest extends TestCase
{
    public function testRender()
    {
        View::render('Home/index', [
            "PHP Login Management"
        ]);

        $this->expectOuputRegex('[PHP Login Management]');
        $this->expectOuputRegex('[html]');
        $this->expectOuputRegex('[body]');
        $this->expectOuputRegex('[Login Management]');
        $this->expectOuputRegex('[Login]');
        $this->expectOuputRegex('[Register]');
    }
}