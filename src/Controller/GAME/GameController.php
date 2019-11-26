<?php

namespace App\Controller\GAME;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/game")
 */
class GameController extends AbstractController
{
  /**
   * @Route("/", name="game")
   */
    public function index()
    {
        return $this->render('game/index.html.twig', [
            'controller_name' => 'GameController',
        ]);
    }
    /**
     * @Route("/chat", name="chat",methods={"GET", "POST"}, requirements={"id"="\d+"})
     */
      public function chat(int $id)
      {
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

        }
          return $this->render('game/index.html.twig', [
              'controller_name' => 'GameController',
          ]);
      }

    /**
     * @Route("/profile/{id}", name="profile",methods={"GET"})
     */
      public function profile()
      {
          return $this->render('game/index.html.twig', [
              'controller_name' => 'GameController',
          ]);
      }
}
