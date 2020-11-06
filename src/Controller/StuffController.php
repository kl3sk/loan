<?php

namespace App\Controller;

use App\Entity\Stuff;
use App\Entity\StuffImage;
use App\Form\StuffType;
use App\Repository\StuffRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Routing\Annotation\Route;
use Vich\UploaderBundle\Handler\DownloadHandler;

/**
 * @Route("/stuff", name="stuff_")
 */
class StuffController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(StuffRepository $stuffRepository): Response
    {
        return $this->render('stuff/index.html.twig', [
            'stuffs' => $stuffRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $stuff = new Stuff();
        $form = $this->createForm(StuffType::class, $stuff);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($stuff);
            $entityManager->flush();

            return $this->redirectToRoute('stuff_index');
        }

        return $this->render('stuff/new.html.twig', [
            'stuff' => $stuff,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(Stuff $stuff): Response
    {
        return $this->render('stuff/show.html.twig', [
            'stuff' => $stuff,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Stuff $stuff): Response
    {
        $form = $this->createForm(StuffType::class, $stuff);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('stuff_index');
        }

        return $this->render('stuff/edit.html.twig', [
            'stuff' => $stuff,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"DELETE"})
     */
    public function delete(Request $request, Stuff $stuff): Response
    {
        if ($this->isCsrfTokenValid('delete'.$stuff->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($stuff);
            $entityManager->flush();
        }

        return $this->redirectToRoute('stuff_index');
    }

    /**
     * @Route("/{id}/download", name="download", methods={"GET"})
     *
     * @param StuffImage $stuffImage
     * @param DownloadHandler $downloadHandler
     * @return StreamedResponse
     */
    public function download(StuffImage $stuffImage, DownloadHandler $downloadHandler)
    {
        return $downloadHandler->downloadObject($stuffImage, 'imageFile', StuffImage::class, $stuffImage->getImage()->getOriginalName());
    }
}
