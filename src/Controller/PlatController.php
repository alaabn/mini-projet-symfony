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
        $this->addFlash("primary", "Bienvenu! voici tous les plats.");

        return $this->render('plat/index.html.twig', [
            'plats' => $plats = $this->getDoctrine()->getRepository(Plat::class)->findAll(),
        ]);
    }

    /** @Route("/plat/{id}", name= "plat_id") */
    public function showById($id)
    {
        $plat = $this->getDoctrine()->getManager()->getRepository(Plat::class)->findBy(['id' => $id]);
        return $this->render('plat/index.html.twig', [
            'plats' => $plat,
        ]);
    }

    /** @Route("/ajouter_plat", name= "ajouter_plat", priority=10) */
    public function ajouter(Request $request)
    {
        $regime = new Plat;

        $form = $this->createForm(PlatType::class);
        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid()){

            $regime = $form->getData();
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($regime);
            $em->flush();

            $this->addFlash("notice", "Nouveau Plat a été ajouter avec succeé!");
        }

        return $this->render('plat/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
