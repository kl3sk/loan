<?php

namespace App\Controller;

use App\Entity\StuffImage;
use App\Form\StuffImageType;
use App\Repository\StuffImageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/stuff/image")
 */
class StuffImageController extends AbstractController
{
    /**
     * @Route("/", name="stuff_image_index", methods={"GET"})
     */
    public function index(StuffImageRepository $stuffImageRepository): Response
    {
        return $this->render('stuff_image/index.html.twig', [
            'stuff_images' => $stuffImageRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="stuff_image_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $stuffImage = new StuffImage();
        $form = $this->createForm(StuffImageType::class, $stuffImage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($stuffImage);
            $entityManager->flush();

            return $this->redirectToRoute('stuff_image_index');
        }

        return $this->render('stuff_image/new.html.twig', [
            'stuff_image' => $stuffImage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="stuff_image_show", methods={"GET"})
     */
    public function show(StuffImage $stuffImage): Response
    {
        return $this->render('stuff_image/show.html.twig', [
            'stuff_image' => $stuffImage,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="stuff_image_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, StuffImage $stuffImage): Response
    {
        $form = $this->createForm(StuffImageType::class, $stuffImage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('stuff_image_index');
        }

        return $this->render('stuff_image/edit.html.twig', [
            'stuff_image' => $stuffImage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="stuff_image_delete", methods={"DELETE"})
     */
    public function delete(Request $request, StuffImage $stuffImage): Response
    {
        if ($this->isCsrfTokenValid('delete'.$stuffImage->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($stuffImage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('stuff_image_index');
    }
}
