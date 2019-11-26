<?php

namespace App\Controller\RH;

use App\Entity\Campagne;
use App\Form\CampagneType;
use App\Repository\CampagneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Route("/campagne")
 */
class CampagneController extends AbstractController
{
    /**
     * @Route("/", name="campagne_index", methods={"GET"})
     */
    public function index(CampagneRepository $campagneRepository): Response
    {
        return $this->render('campagne/index.html.twig', [
            'campagnes' => $campagneRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="campagne_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $campagne = new Campagne();
        $form = $this->createForm(CampagneType::class, $campagne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($campagne);
            $entityManager->flush();

            return $this->redirectToRoute('campagne_index');
        }

        return $this->render('campagne/new.html.twig', [
            'campagne' => $campagne,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="campagne_show", methods={"GET"})
     */
    public function show(Campagne $campagne): Response
    {
        return $this->render('campagne/show.html.twig', [
            'campagne' => $campagne,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="campagne_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Campagne $campagne): Response
    {
        $form = $this->createForm(CampagneType::class, $campagne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('campagne_index');
        }

        return $this->render('campagne/edit.html.twig', [
            'campagne' => $campagne,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="campagne_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Campagne $campagne): Response
    {
        if ($this->isCsrfTokenValid('delete'.$campagne->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($campagne);
            $entityManager->flush();
        }

        return $this->redirectToRoute('campagne_index');
    }
}
