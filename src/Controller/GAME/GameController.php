<?php

namespace App\Controller\GAME;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Entity\UserByCampagne;
use App\Entity\Campagne;
use App\Entity\Chat;
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
      $list_Campagne_started = $entityManager->getRepository(UserByCampagne::class)->findBy(['id_user' => $user->getId()]);
      $list_campagne_started = [];
      foreach ($list_Campagne_started as $key => $campagne) {
        $d['nom']= $campagne->getIdCampagne()->getNom();
        $d['id'] =$campagne->getId();
        array_push($list_campagne_started, $d);
      }
      $list_Campagne = $entityManager->getRepository(Campagne::class)->findAll();
      $entityManager = $this->getDoctrine()->getManager();
      $getuser = $entityManager->getRepository(User::class)->find($user);

        return $this->render('game/index.html.twig', [
            'list_campagne' => $list_Campagne,
            'list_campagne_started' =>$list_campagne_started,
            'user'=> $user
        ]);
    }
    /**
     * @Route("/new", name="newgame",methods="POST")
     */
      public function new(Request $request)
      {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $entityManager = $this->getDoctrine()->getManager();

        $campagne = $entityManager->getRepository(Campagne::class)->find($request->request->get('IdCampagne'));
        $user = $entityManager->getRepository(User::class)->find($this->getUser()->getId());
        $usercampagne = new UserByCampagne();
        $chat = new Chat();
        $datetime= new \DateTime;
        $chat->setText('bienvenu !');
        $chat->setDatetime($datetime);
        $entityManager->persist($chat);
        $usercampagne->setIdCampagne($campagne);
        $usercampagne->setIdUser($user);
        $usercampagne->addChat($chat);
        $entityManager->persist($usercampagne);
        $entityManager->flush();

        return $this->render('game/chat.html.twig');
      }

    /**
     * @Route("/chat/{game}", name="chat",methods={"GET", "POST"}, requirements={"game "="\d+"})
     */
      public function chat($game)
      {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $entityManager = $this->getDoctrine()->getManager();
        $campagne= $entityManager->getRepository(UserByCampagne::class)->find($game);
        $chat = $campagne->getChats();
        $user = $this->getUser()->getUsername();

          return $this->render('game/chat.html.twig', [
              'chat' => $chat,
              'user' => $user
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
