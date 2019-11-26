<?php

namespace App\Controller\GAME;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;

/**
 * @Route("/game")
 */
class GameController extends AbstractController
{
  /**
   * @Route("/", name="game", requirements={"user"="\d+"})
   */
    public function index(int $user = 1)
    {
      $entityManager = $this->getDoctrine()->getManager();
      $user = $entityManager->getRepository(User::class)->find($user);
      if($user != null){
        $list_Campagne = $user->getUserByCampagnes()->getIdCampagne()->getNom();
      }


        return $this->render('game/index.html.twig', [
            'controller_name' => 'GameController',
        ]);
    }
    /**
     * @Route("/chat", name="chat",methods={"GET", "POST"}, requirements={"id"="\d+"})
     */
      public function chat(int $id)
      {
        $entityManager = $this->getDoctrine()->getManager();
        $message = $entityManager->getRepository(Stats::class)->findByUser($id);


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

        }
          return $this->render('game/index.html.twig', [
              'controller_name' => 'GameController',
          ]);
      }

    /**
     * @Route("/profile/{id}", name="profile",methods={"GET"}, requirements={"id"="\d+"})
     */
      public function profile(int $id)
      {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(Stats::class)->findByUser($id);

        if (!$user) {
            throw $this->createNotFoundException(
                'No user found for id '.$id
            );
        }

          return $this->render('game/profile.html.twig', [
              'user' => $user,
          ]);
      }
}
