<?php

namespace App;

use DateTime;
use App\CurrentTimeInterface;

class Greeting
{
  private CurrentTimeInterface $currentTime;

  public function __construct(CurrentTimeInterface $currentTime)
  {
    $this->currentTime = $currentTime;
  }


  public function hi(string $name): string
  {
    $name = ucfirst(trim($name, ' '));
    if ($this->currentTime->getTime()['hours'] > 17 && $this->currentTime->getTime()['hours'] < 23) {

      return "Bonsoir $name";
    } elseif ($this->currentTime->getTime()['hours'] > 22 || $this->currentTime->getTime()['hours'] < 6) {
      return "Bonne nuit $name";
    }
    return "Bonjour $name";
  }
}