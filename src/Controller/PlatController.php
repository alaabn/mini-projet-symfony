<?php

namespace App\Controller;

use App\Entity\Plat;
use App\Form\PlatType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlatController extends AbstractController
{
    /** @Route("/plat", name= "show_plat") */
    public function show()
    {
        return $this->render('plat/index.html.twig', [
            'plats' => $plats = $this->getDoctrine()->getRepository(Plat::class)->findBy(['user' => $this->getUser()->getId()])
        ]);
    }

    /** @Route("/plat/id/{id}", name= "plat_id") */
    public function showById($id)
    {
        $plat = $this->getDoctrine()->getManager()->getRepository(Plat::class)->findBy(['id' => $id]);
        return $this->render('plat/index.html.twig', [
            'plats' => $plat,
        ]);
    }

    /** @Route("/plat/ajouter", name= "ajouter_plat", priority=10) */
    public function ajouter(Request $request)
    {
        $plat = new Plat;

        $form = $this->createForm(PlatType::class);
        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid()){

            $plat = $form->getData();
            
            $plat->setUser($this->getUser()) ;

            $em = $this->getDoctrine()->getManager();
            $em->persist($plat);
            $em->flush();

            $this->addFlash("success", "Nouveau Plat a été ajouter avec succeé!");
            return $this->redirectToRoute('show_plat');
        }

        return $this->render('plat/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
