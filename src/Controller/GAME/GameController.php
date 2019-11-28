<?php

namespace App\Controller\GAME;

use App\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Entity\UserByCampagne;
use App\Entity\Campagne;
use App\Entity\Chat;
use App\Entity\Stat;

/**
 * @Route("/game")
 * @Security("is_granted('ROLE_USER') or is_granted('ROLE_RH')")
 */
class GameController extends AbstractController
{
  /**
   * @Route("/", name="game", schemes={"https"})
   */
    public function index()
    {

      $entityManager = $this->getDoctrine()->getManager();
      $user = $this->getUser();

      if (isset($_GET['done'])){
        if (isset($_GET['campagne'])){
          $campagne_user_id = $_GET['campagne'];
          $campagne_done = $entityManager->getRepository(UserByCampagne::class)->find($campagne_user_id);
          $campagne_done->setFinished(True);
          $entityManager->persist($campagne_done);
          $entityManager->flush();
        }
      }
      
      $list_Campagne_started = $entityManager->getRepository(UserByCampagne::class)->findBy(['id_user' => $user->getId()]);
      $list_campagne_started = [];

      foreach ($list_Campagne_started as $key => $campagne) {
        $d['nom']= $campagne->getIdCampagne()->getNom();
        $d['id'] =$campagne->getId();
        $d['finished'] =$campagne->getFinished();
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
     * @Route("/new", name="newgame",methods="POST", schemes={"https"})
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

        return $this->render('game/chat.html.twig', [
            'chat' => $chat,
            'user' => $user,
            'campagne_user_id' => $usercampagne->getId(),
        ]);
      }

    /**
     * @Route("/chat/{game}", name="chat",methods={"GET", "POST"}, requirements={"game "="\d+"})
     */
      public function chat($game)
      {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $entityManager = $this->getDoctrine()->getManager();
        $campagne= $entityManager->getRepository(UserByCampagne::class)->find($game);
        $chat = $campagne->getChats()->getValues()[0];
        $user = $this->getUser();

          return $this->render('game/chat.html.twig', [
              'chat' => $chat,
              'user' => $user,
              'campagne_user_id' => $campagne->getId(),
          ]);
      }
      /**
      * @Route("/chat/{chatid}/getchat", name="getChat",methods={"GET", "POST"} )
      */
        public function getChat(Request $request, $chatid)
        {
            $chatid = $request->request->get('chatid');
            $messages = $request->request->get('message');
          $this->denyAccessUnlessGranted('ROLE_USER');
          $entityManager = $this->getDoctrine()->getManager();
          $Allmessenger= $entityManager->getRepository(MessageRepository::class)->getMessage($chatid,$idmessage);
          $user = $this->getUser();
          return $this->render('game/chat.html.twig', [
              'message' => $Allmessenger,
              'user' => $user
          ]);
        }

    /**
     * @Route("/profile/{id}", name="profile", schemes={"https"})
     */
      public function profile(int $id)
      {
          $entityManager = $this->getDoctrine()->getManager();
          $user = $entityManager->getRepository(User::class)->find($id);
          $stat = $entityManager->getRepository(Stat::class)->find($user);

          return $this->render('game/profile.html.twig', [
              'user' => $user,
              'stat' => $stat
          ]);
      }


    /**
     * @Route("/profile/{id}/edit", name="profile_edit", methods={"POST"}, schemes={"https"})
     */
    public function edit(Request $request, int $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->find($id);
        /*
                $form = $this->createForm(UserType::class, $user);
                die(var_dump($request->request));
                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid()) {
                    $entityManager->flush();
                }
        */
        return $this->redirectToRoute('profile', ['id' => $id]);
    }

    /**
     * @Route("/profile/{id}/score", name="profile_score", methods={"GET", "POST"}, schemes={"https"})
     */
    public function score(Request $request, int $id)
    {
        $score = $request->request->get('score');
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->find($id);
        $stat = $entityManager->getRepository(Stat::class)->find($user);

        $com = $stat->getCommunication() + floatval($score['communication']);
        if ($com < 0)
            $com = 0;
        $esprit = $stat->getCriticalThinking() + floatval($score['esprit']);
        if ($esprit < 0)
            $esprit = 0;
        $leadership = $stat->getLeadership() + floatval($score['leadership']);
        if ($leadership < 0)
            $leadership = 0;
        $positive = $stat->getPositiveAttitude() + floatval($score['positive']);
        if ($positive < 0)
            $positive = 0;
        $equipe = $stat->getTeamWork() + floatval($score['equipe']);
        if ($equipe < 0)
            $equipe = 0;
        $ethique = $stat->getWorkEthic() + floatval($score['ethique']);
        if ($ethique < 0)
            $ethique = 0;

        $stat->setCommunication($com);
        $stat->setCriticalThinking($esprit);
        $stat->setLeadership($leadership);
        $stat->setPositiveAttitude($positive);
        $stat->setTeamWork($equipe);
        $stat->setWorkEthic($ethique);

        $entityManager->persist($stat);
        $entityManager->flush();

        return new Response(
            '[{ status: "OK" }]',
            Response::HTTP_OK,
            ['content-type' => 'text/html']
        );
    }

}
