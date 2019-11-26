<?php

namespace App\Controller\GAME;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\UserByCampagne;

/**
 * @Route("/game")
 * @Security("is_granted('ROLE_USER') or is_granted('ROLE_RH')")
 */
class GameController extends AbstractController
{
  /**
   * @Route("/", name="game")
   */
    public function index()
    {
      $entityManager = $this->getDoctrine()->getManager();
      $user = $this->getUser();
      $list_Campagne = $entityManager->getRepository(UserByCampagne::class)->findBy(['id_user' => $user->getId()]);

      $entityManager = $this->getDoctrine()->getManager();

        return $this->render('game/index.html.twig', [
            'list_campagne' => $list_Campagne,
            'user'=> $user
        ]);
    }
    /**
     * @Route("/new", name="newgame",methods="POST")
     */
      public function new(Request $request)
      {
        $entityManager = $this->getDoctrine()->getManager();

        $product = new UserByCampagne();
        $form = $this->createForm();
        $product->setIdCampagne('Keyboard');
        $product->setPrice(1999);
        $product->setDescription('Ergonomic and stylish!');

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
        $this->denyAccessUnlessGranted('ROLE_USER');

        $entityManager = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $list_Campagne = $entityManager->getRepository(UserByCampagne::class)->findBy(['id_user' => $user->getId()]);

        $entityManager = $this->getDoctrine()->getManager();
        $getuser = $entityManager->getRepository(User::class)->find($user);

          return $this->render('game/index.html.twig', [
              'list_campagne' => $list_Campagne,
              'user'=> $user
          ]);
      }

    /**
     * @Route("/chat", name="chat",methods={"GET", "POST"}, requirements={"user "="\d+"})
     */
      public function chat()
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
     * @Route("/profile", name="profile")
     */
      public function profile()
      {
          $entityManager = $this->getDoctrine()->getManager();
          $user = $this->getUser();

          return $this->render('game/profile.html.twig', [
              'user' => $user,
          ]);
      }
}
