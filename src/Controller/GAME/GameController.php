<?php

namespace App\Controller\GAME;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\UserByCampagne;

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
      $this->denyAccessUnlessGranted('ROLE_USER');
      $entityManager = $this->getDoctrine()->getManager();
      $user = $this->getUser();
      $list_Campagne = $entityManager->getRepository(UserByCampagne::class)->findBy(['id_user' => $user->getId()]);
      dump($list_Campagne);
      /*

      $entityManager = $this->getDoctrine()->getManager();
      $getuser = $entityManager->getRepository(User::class)->find($user);

      if($user != null){
        $list_Campagne = $user->getUserByCampagnes()->getIdCampagne();
      }else{
        $list_Campagne = NULL;
      }

      dump($getuser->getUserByCampagnes());*/
      $list_Campagne = 0;
        return $this->render('game/index.html.twig', [
  //          'list_campagne' => $list_Campagne,
          //  'user'=> $user
        ]);
    }
    /**
     * @Route("/chat", name="chat",methods={"GET", "POST"}, requirements={"user "="\d+"})
     */
      public function chat(int $user)
      {
        $entityManager = $this->getDoctrine()->getManager();
        $message = $entityManager->getRepository(Stats::class)->findByUser($user);

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
