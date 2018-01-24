<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use AppBundle\Entity\utilisateur;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
    public function accueilAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $livres = $em->getRepository('AppBundle:livre')->findAll();
        return $this->render('@App/accueil.html.twig', array ( 
            'livres' => $livres
        ));
    }
    /*public function showUtilisateurAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $id = $request->get('id');
        $utilisateurs= $em->getRepository('AppBundle:Utilisateur')->find($id);
        // replace this example code with whatever you need
        return $this->render('AppBundle::utilisateursid.html.twig', array (
            'utilisateurs' => $utilisateurs
        ));
    }*/
    public function connexionAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $utilisateur = new utilisateur();
        $form = $this->createForm(FormType::class,$utilisateur);
        $form->handleRequest($request);
        $form
            ->add('mail',TextType::class)
            ->add('password',TextType::class)
            ->add('save',SubmitType::class);
        if ($form->isSubmitted() && $form->isValid())
        {
            $utilisateur= $form->getData();
            $em->persist($utilisateur);
            $em->flush(); 

            return $this->redirectToRoute('Utilisateur_show', array(
                'id'=> $utilisateur->getId()
            ));
        }

    return $this->render('@App/formulaireCo.html.twig', array(
            'form'=> $form->createView(),
    ));
    }
    public function addUtilisateurAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $utilisateur = new utilisateur();
        $form = $this->createFormBuilder($utilisateur)
            ->add('nomUtilisateur',TextType::class)
            ->add('prenomUtilisateur',TextType::class)
            ->add('mail',TextType::class)
            ->add('password',TextType::class)
            ->add('save',SubmitType::class)
            ->getForm();
            
            if ($request->isMethod('POST')) {
                $form->handleRequest($request);
                    if ($form->isValid()) 
                    {
                        $em = $this->getDoctrine()->getManager();
                        $em->persist($utilisateur);
                        $em->flush();
                    }
                }
        return $this->render('@App/formulaire.html.twig', array(
            'form'=> $form->createView(),
        ));
    }
}
