<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="login", schemes={"https"})
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
                    'last_username' => $lastUsername,
                    'error' => $error,
                    'user' => $this->getUser()
                ]);
    }

    /**
     * @Route("/logout", name="logout", schemes={"https"})
     */
    public function logout()
    {
        return new RedirectResponse($this->router->generate('accueil'));
        //throw new \Exception('This method can be blank - it will be intercepted by the logout key on your firewall');
    }
}
