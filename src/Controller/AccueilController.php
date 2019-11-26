<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index()
    {
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            'user' => $this->getUser()
        ]);
    }
    /**
     * @Route("/regle", name="regle")
     */
    public function regles()
    {
        return $this->render('accueil/rules.html.twig', [
            'user' => $this->getUser()
        ]);
    }
    /**
     * @Route("/avancementProjet", name="avancementProjet")
     */
    public function avancementProjet() {
        return $this->render('accueil/avancementProjet.html.twig');
    }
}
