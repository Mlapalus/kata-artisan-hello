<?php

namespace App\Tests;

use App\CurrentTime;
use App\Greeting;
use CurlHandle;
use PHPUnit\Framework\TestCase;

class GreetingTest extends TestCase
{
  private Greeting $greeting;
  private CurrentTime $currentTime;

  public function setUp(): void
  {
    $this->currentTime = new CurrentTime();
    $this->currentTime->setTime(12, 0);

    $this->greeting = new Greeting($this->currentTime);
  }

  public function test_it_should_respond_hi_firstname()
  {
    $firstName = 'Michel';

    $this->assertEquals('Bonjour ' . $firstName, $this->greeting->hi($firstName));
  }

  public function test_it_should_delete_space_befor_and_after_first_name()
  {
    $firstName = ' Michel';
    $this->assertEquals('Bonjour Michel', $this->greeting->hi($firstName));

    $firstName = '      Michel';
    $this->assertEquals('Bonjour Michel', $this->greeting->hi($firstName));

    $firstName = 'Michel ';
    $this->assertEquals('Bonjour Michel', $this->greeting->hi($firstName));

    $firstName = 'Michel      ';
    $this->assertEquals('Bonjour Michel', $this->greeting->hi($firstName));

    $firstName = ' Michel ';
    $this->assertEquals('Bonjour Michel', $this->greeting->hi($firstName));

    $firstName = '        Michel      ';
    $this->assertEquals('Bonjour Michel', $this->greeting->hi($firstName));
  }

  public function test_it_should_capitalize_the_first_letter()
  {
    $firstName = 'michel';
    $this->assertEquals('Bonjour Michel', $this->greeting->hi($firstName));
  }

  public function test_the_time()
  {
    $firstName = 'michel';

    $this->currentTime->setTime(17, 59);
    $this->assertEquals('Bonjour Michel', $this->greeting->hi($firstName));
    $this->currentTime->setTime(18, 0);
    $this->assertEquals('Bonsoir Michel', $this->greeting->hi($firstName));
    $this->currentTime->setTime(22, 59);
    $this->assertEquals('Bonsoir Michel', $this->greeting->hi($firstName));
    $this->currentTime->setTime(23, 00);
    $this->assertEquals('Bonne nuit Michel', $this->greeting->hi($firstName));
    $this->currentTime->setTime(24, 00);
    $this->assertEquals('Bonne nuit Michel', $this->greeting->hi($firstName));
    $this->currentTime->setTime(0, 00);
    $this->assertEquals('Bonne nuit Michel', $this->greeting->hi($firstName));
    $this->currentTime->setTime(5, 59);
    $this->assertEquals('Bonne nuit Michel', $this->greeting->hi($firstName));
    $this->currentTime->setTime(6, 00);
    $this->assertEquals('Bonjour Michel', $this->greeting->hi($firstName));
  }
}