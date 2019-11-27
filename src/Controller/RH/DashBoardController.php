<?php

namespace App\Controller\RH;

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
   * @Route("/", name="dash_board", schemes={"https"})
   */
    public function index()
    {
      $this->denyAccessUnlessGranted('ROLE_RH');
      $entityManager = $this->getDoctrine()->getManager();
      
      return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashBoardController',
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
