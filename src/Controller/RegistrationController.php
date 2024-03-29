<?php

namespace App\Controller;

use App\Entity\Stat;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\LoginFormAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use App\Service\StringTool;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="register", schemes={"https"})
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param GuardAuthenticatorHandler $guardHandler
     * @param LoginFormAuthenticator $authenticator
     * @return Response
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, LoginFormAuthenticator $authenticator, StringTool $convertstring): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setUsername(
                $form->get('username')->getData()
            );
            // encode the password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('password')->getData()
                )
            );
            $user->setEmail(
                $form->get('email')->getData()
            );
            $user->setNom(
              $convertstring->getUpperFirstName($form->get('lastname')->getData())
            );
            $user->setPrenom(
                $convertstring->getUpperFirstName($form->get('firstname')->getData())
            );
            if($form->get('isRH')->getData() == true ){
              $user->setRoles(
                  array('ROLE_USER','ROLE_RH')
              );
            }else{
              $user->setRoles(
                  array('ROLE_USER')
              );
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);

            $stats = new Stat();
            $stats->setIdUser($user);
            $entityManager->persist($stats);

            $entityManager->flush();

            // do anything else you need here, like send an email

            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );
        }
        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
            'user' => $this->getUser()
        ]);
    }
}
