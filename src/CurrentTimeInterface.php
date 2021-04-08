<?php

namespace App;

interface CurrentTimeInterface
{
  public function setTime(int $hours, int $minutes): void;
  public function getTime(): array;
}