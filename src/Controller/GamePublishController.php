<?php 

namespace App\Controller;

use App\Entity\Game;

class GamePublishController
{
  public function __invoke(Game $data): Game 
  {
    $data->setOnline(true);
    return $data;
  }
}