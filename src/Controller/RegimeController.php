<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Regime;
use App\Form\RegimeType;

class RegimeController extends AbstractController
{
    /** @Route("/regime", name= "show_regime") */
    public function show()
    {
        $user = $this->getUser();
        //dd($user);
        $regimes = $this->getDoctrine()->getRepository(Regime::class)->findAll();

        return $this->render('regime/index.html.twig', [
            'regimes' => $regimes,
        ]);
    }

    /** @Route("/regime/id/{id}", name= "show_regime_id") */
    public function showById($id)
    {
        $regimes = $this->getDoctrine()->getManager()->getRepository(Regime::class)->findBy(['id' => $id]);

        return $this->render('regime/index.html.twig', [
            'regimes' => $regimes,
        ]);
    }

    /** @Route("/regime/ajouter", name= "ajouter_regime") */
    public function addM(Request $request)
    {
        $regime = new Regime;

        $form = $this->createForm(RegimeType::class);
        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();

            $regime = $form->getData();

            $em->persist($regime);
            $em->flush();

            $this->addFlash("success", "Nouveau Regime a été ajouter avec succeé!");
            return $this->redirectToRoute('show_regime');
        }

        return $this->render('regime/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /** @Route("/regime/supp/{id}", name= "supprim_regime") */
    public function delete($id)
    {
        $regime = $this->getDoctrine()->getRepository(Regime::class)->find($id);
        $nom = $regime->getNomRegime();
        
        $em = $this->getDoctrine()->getManager();
        $em->remove($regime);
        $em->flush();

        $this->addFlash("danger", "Régime ($nom) a été supprimé!");
        return $this->redirectToRoute('show_regime');
    }

    /** @Route("/regime/modif/{id}", name= "modif_regime") */
    public function editM(Request $request, $id)
    {
        $regime = $this->getDoctrine()->getRepository(Regime::class)->find($id);

        $form = $this->createForm(RegimeType::class, $regime);
        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();

            $nomReg = $form->getData()->getNomRegime();

            $em->flush();

            $this->addFlash("warning", "Regime ($nomReg) a été modifier avec succeé!");
            return $this->redirectToRoute('show_regime');
        }

        return $this->render('regime/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
