<?php

namespace App\Controller\RH;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/dashboard", schemes={"https"})
 * @Security("is_granted('ROLE_RH')")
 */
class DashBoardController extends AbstractController
{
  /**
   * @Route("/", name="dashboard", schemes={"https"})
   */
    public function index()
    {
      $user = $this->getUser();
      $Alluser= $entityManager->getRepository(UserRepository::class)->findAll();

      return $this->render('dashboard/index.html.twig', [
            'user' => $user,
            'users'=>$Alluser
        ]);
    }

    /**
     * @Route("/admin", name="admin", schemes={"https"})
     */
      public function admin()
      {
          return $this->render('dash_board/index.html.twig', [
              'controller_name' => 'DashBoardController',
          ]);
      }

      /**
       * @Route("/addCompetence", name="addCompetence", schemes={"https"})
       */
        public function addCompetence()
        {
            return $this->render('dash_board/index.html.twig', [
                'controller_name' => 'DashBoardController',
            ]);
        }

        /**
         * @Route("/addPointbyCompetence", name="addPointbyCompetence", schemes={"https"})
         */
          public function addPointbyCompetence()
          {
              return $this->render('dash_board/index.html.twig', [
                  'controller_name' => 'DashBoardController',
              ]);
          }

}
