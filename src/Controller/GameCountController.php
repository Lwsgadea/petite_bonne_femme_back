<?php 

namespace App\Controller;

use App\Entity\Game;
use App\Repository\GameRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GameCountController extends AbstractController
{
  public function __construct(private GameRepository $gameRepository) {
    
  }

  public function __invoke(Request $request): int 
  {
    $onLineQuery = $request->get('online');
    $conditions = [];
    if($onLineQuery != null) {
      $conditions = ['online' => $onLineQuery == '1' ? true : false];
    }
    return $this->gameRepository->count([]);
  }
}