<?php

namespace App;

use DateTime;

class CurrentTime implements CurrentTimeInterface
{

  private DateTime $currentTime;

  public function __construct()
  {
    $this->currentTime = new DateTime('now');
  }

  public function setTime(int $hours, int $minutes): void
  {
    $this->currentTime->setTime($hours, $minutes);
  }

  public function getTime(): array
  {
    return getDate($this->currentTime->getTimestamp());
  }
}