<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    public function accueilAction (Request $request)
	{
		$em=$this->getDoctrine ()->getManager ();

		$livres=$em->getRepository ("AppBundle:livre")->findAll ();

		return ($this->render ("@App/accueil.html.twig", ["livres" => $livres]));
	}

	public function detailsAction (Request $request, $id)
	{
		$em=$this->getDoctrine ()->getManager ();

		$livre=$em->getRepository ("AppBundle:livre")->find ($id);

		return ($this->render ("@App/details.html.twig", ["livre" => $livre]));
	}

	public function commandeAction (Request $request, $id)
	{
		$em=$this->getDoctrine ()->getManager ();

		$livre=$em->getRepository ("AppBundle:livre")->find ($id);

		return ($this->render ("@App/commande.html.twig", ["livre" => $livre]));
	}
}
