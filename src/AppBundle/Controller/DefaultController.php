<?php

namespace AppBundle\Controller;

use AppBundle\Entity\commande;
use AppBundle\Entity\details_commande;
use AppBundle\Entity\details_panier;
use AppBundle\Entity\panier;
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
		$getAuteur = $request->get('auteur');
		$getTitre = $request->get('titre');
		$em=$this->getDoctrine ()->getManager();
		if ($getTitre !== null && $getAuteur  !== null)
		{
			$livres = $this->recherche($getTitre,$getAuteur,$em);
		}
		else
		{
			$livres=$em->getRepository ("AppBundle:livre")->findAll();
		}
		return ($this->render ("@App/accueil.html.twig", ["livres" => $livres]));

	}

	public function accueil_detailsAction (Request $request)
	{
		$getAuteur = $request->get('auteur');
		$getTitre = $request->get('titre');
		$em=$this->getDoctrine ()->getManager ();
		if ($getTitre !== null && $getAuteur  !== null)
		{
			$livres = $this->recherche($getTitre,$getAuteur,$em);
		}
		else
		{
			$livres=$em->getRepository ("AppBundle:livre")->findAll ();
		}
		return ($this->render ("@App/accueil_details.html.twig", ["livres" => $livres]));
		
	}

	public function detailsAction (Request $request, $id)
	{
		$em=$this->getDoctrine ()->getManager();
		
		$livre=$em->getRepository ("AppBundle:livre")->find ($id);
		$dir=$this->get('kernel')->getRootDir() . '/../web/img/pdf/' .$livre->getDossier();
		$open = opendir($dir);
		$all = array();
		while(false !== ($entry = readdir($open))){
			if ($entry != "." && $entry != "..")
			{
				array_push($all,$entry);
			}
		}

		return ($this->render ("@App/details.html.twig", ["livre" => $livre , "dir" => $all]));
	}

	public function panier_ajoutAction (Request $requete)
	{
		$id_livre=(int) $requete->request->get ("livre");
		$quantite=$requete->request->get ("quantite");
		$date_1=$requete->request->get ("date_1");
		$date_2=$requete->request->get ("date_2");

		$utilisateur=$this->container->get ("security.token_storage")->getToken ()->getUser ();

		$manager=$this->getDoctrine ()->getManager ();

		$livre=$manager->getRepository ("AppBundle:livre")->find ($id_livre);

		$prix_unitaire=$livre->getPrixUnitaire ();

		$prix=$prix_unitaire*$quantite;

		$panier=$manager->getRepository ("AppBundle:panier")->get_panier_par_date_ajout ($date_1, $date_2);

		if (count ($panier)==0)
		{
			$panier=new panier ();
		}

		$panier->setUtilisateur ($utilisateur);
		$panier->setDateAjout (new \DateTime ());
		$panier->setPrix ($prix);

		$manager->persist ($panier);
		$manager->flush ();

		$details_panier=new details_panier ();

		$details_panier->setPanier ($panier);
		$details_panier->setLivre ($livre);
		$details_panier->setQuantite ($quantite);

		$manager->persist ($details_panier);
		$manager->flush ();

		$reponse=new Response ();

		$reponse->setStatusCode (200);

		return ($reponse);
	}

	private function recherche ($titreRecherche,$auteurRecherche, $em)
	{
		$titreRecherche=(string) $titreRecherche;
		$auteurRecherche=(string) $auteurRecherche;

		if ($auteurRecherche!= "")
		{
			$where = "p.auteur LIKE :auteurRecherche";
			$param = ['auteurRecherche'=> '%'.$auteurRecherche.'%'];
			if ($titreRecherche != "")
			{
				$where.=" AND p.titre LIKE :titreRecherche";
				$param = ['titreRecherche'=> '%'.$titreRecherche.'%', 'auteurRecherche'=> '%'.$auteurRecherche.'%'];
			}
		}
		else if ($titreRecherche !="")
		{
			$where = "p.titre LIKE :titreRecherche";
			$param = ['titreRecherche'=> '%'.$titreRecherche.'%'];
		}
		$repository = $em->getRepository('AppBundle:livre');
		$query = $repository->createQueryBuilder('p')
		->select('p')
		->getQuery();
		if (isset($where))
		{
			$query = $repository->createQueryBuilder('p')
			->select('p')
			->where($where)
			->setParameters($param)
			->getQuery();
		}
		 return $query->getResult();
	}

	public function panierAction (Request $requete)
	{
		$manager=$this->getDoctrine ()->getManager ();

		$utilisateur=$this->container->get ("security.token_storage")->getToken ()->getUser ();

		$paniers=$manager->getRepository ("AppBundle:panier")->findBy (["utilisateur" => $utilisateur], ["dateAjout" => "DESC"]);

		$panier=$paniers [0]->getId ();

		$details_panier=$manager->getRepository ("AppBundle:details_panier")->findBy (["panier" => $panier]);

		return ($this->render ("@App/panier.html.twig", ["details_panier" => $details_panier]));
	}
}