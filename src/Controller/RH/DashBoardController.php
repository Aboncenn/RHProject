<?php

namespace App\Controller\RH;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/dashboard")
 */
class DashBoardController extends AbstractController
{
  /**
   * @Route("/", name="dash_board")
   */
    public function index()
    {
        return $this->render('dash_board/index.html.twig', [
            'controller_name' => 'DashBoardController',
        ]);
    }

    /**
     * @Route("/{id}", methods={"GET"})
     */
    public function show($id)
    {
        return $this->render('dash_board/index.html.twig', [
            'controller_name' => 'DashBoardController',
        ]);
    }

    /**
     * @Route("/admin", name="admin")
     */
      public function admin()
      {
          return $this->render('dash_board/index.html.twig', [
              'controller_name' => 'DashBoardController',
          ]);
      }

      /**
       * @Route("/admin", name="admin")
       */
        public function add()
        {
            return $this->render('dash_board/index.html.twig', [
                'controller_name' => 'DashBoardController',
            ]);
        }
}
