<?php

namespace AppBundle\Controller;

use AppBundle\Entity\commande;
use AppBundle\Entity\details_commande;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use AppBundle\Entity\utilisateur;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Validator\Constraints\Date;

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
		
		$em=$this->getDoctrine ()->getManager();
		if (isset($_GET['titre']))
		{
			$titreRecherche = $_GET['titre'];
			$repository = $em->getRepository('AppBundle:livre');
			$query = $repository->createQueryBuilder('p')
			->select('p')
			->where('p.titre LIKE :titreRecherche')
			->setParameters(['titreRecherche'=> '%'.$titreRecherche.'%'])
			->getQuery();
			$livres = $query->getResult();
			return ($this->render ("@App/accueil.html.twig", ["livres" => $livres]));
		}
		else
		{
			$livres=$em->getRepository ("AppBundle:livre")->findAll();
			return ($this->render ("@App/accueil.html.twig", ["livres" => $livres]));
		}
	}
	public function accueil_detailsAction (Request $request)
	{
		$em=$this->getDoctrine ()->getManager ();
		if (isset($_GET['titre']))
		{
			$titreRecherche = $_GET['titre'];
			$repository = $em->getRepository('AppBundle:livre');
			$query = $repository->createQueryBuilder('p')
			->select('p')
			->where('p.titre LIKE :titreRecherche')
			->setParameters(['titreRecherche'=> '%'.$titreRecherche.'%'])
			->getQuery();
			$livres = $query->getResult();
			return ($this->render ("@App/accueil_details.html.twig", ["livres" => $livres]));
		}
		else
		{
			$livres=$em->getRepository ("AppBundle:livre")->findAll ();

			return ($this->render ("@App/accueil_details.html.twig", ["livres" => $livres]));
		}
		
	}
	public function detailsAction (Request $request, $id)
	{
		$em=$this->getDoctrine ()->getManager();
		
		$livre=$em->getRepository ("AppBundle:livre")->find ($id);

		return ($this->render ("@App/details.html.twig", ["livre" => $livre]));
	}

	public function commandeAction (Request $requete)
	{
		$id=(int) $requete->request->get ("livre");
		$quantite=$requete->request->get ("quantite");

		$utilisateur=$this->container->get ("security.token_storage")->getToken ()->getUser ();

		$em=$this->getDoctrine ()->getManager ();

		$livre=$em->getRepository ("AppBundle:livre")->find ($id);

		$prix_unitaire=$livre->getPrixUnitaire ();
		$prix=$prix_unitaire*$quantite;

		$commande=new commande ();

		$commande->setUtilisateur ($utilisateur);
		$commande->setDateCommande (new \DateTime ());
		$commande->setDateEnvoi (new \DateTime ());

		$em->persist ($commande);
		$em->flush ();

		$details_commande=new details_commande ();
		$details_commande->setCommande ($commande);
		$details_commande->setLivre ($livre);
		$details_commande->setPrix ($prix);
		$details_commande->setQuantite ($quantite);

		$em->persist ($details_commande);
		$em->flush ();

		$reponse=new Response ();
		$reponse->setStatusCode (200);

		return ($reponse);
	}
}