<?php

namespace AppBundle\Controller;

use AppBundle\Entity\details_panier;
use AppBundle\Entity\panier;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Security\Core\Security;

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

		return ($this->render ("@App/details.html.twig", ["livre" => $livre]));
	}

	public function panier_ajoutAction (Request $requete) //verifier panier par rapport a commande (tant que commande non passee => ne pas ecraser panier) + faire sys commande
	{
		$id_livre=$requete->request->get ("livre");

		$quantite=$requete->request->get ("quantite");

		$utilisateur=$this->container->get ("security.token_storage")->getToken ()->getUser ();

		$manager=$this->getDoctrine ()->getManager ();

		$livre=$manager->getRepository ("AppBundle:livre")->find ($id_livre);

		$panier=$manager->getRepository ("AppBundle:panier")->findBy (["utilisateur" => $utilisateur]);

		if (sizeof ($panier)==0)
		{
			$panier=new panier ();

			$panier->setPrix (0);

			$manager->persist ($panier);
		}
		else
		{
			$panier=$panier [0];
		}

		$panier->setUtilisateur ($utilisateur);
		$panier->setDateAjout (new \DateTime ());

		$manager->flush ();

		$details_panier=new details_panier ();

		$details_panier->setPanier ($panier);
		$details_panier->setLivre ($livre);
		$details_panier->setQuantite ($quantite);

		$manager->persist ($details_panier);
		$manager->flush ();

		$prix_panier_actuel=$panier->getPrix ();

		$prix_unitaire=$details_panier->getLivre ()->getPrixUnitaire ();

		$prix_tmp=$prix_unitaire*$quantite;

		$prix_panier_actuel+=$prix_tmp;

		$panier->setPrix ($prix_panier_actuel);

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

	public function panierAction ()
	{
		$manager=$this->getDoctrine ()->getManager ();

		$utilisateur=$this->container->get ("security.token_storage")->getToken ()->getUser ();

		$paniers=$manager->getRepository ("AppBundle:panier")->findBy (["utilisateur" => $utilisateur]);

		if (sizeof ($paniers)!=0)
		{
			$panier=$paniers [0]->getId ();

			$details_panier=$manager->getRepository ("AppBundle:details_panier")->findBy (["panier"=>$panier]);

			return ($this->render ("@App/panier.html.twig", ["details_panier"=>$details_panier]));
		}
		else
		{
			return ($this->render ("@App/panier.html.twig"));
		}
	}

	public function commandeAction ()
	{
		/*bouton "valider cmd" sur la vue panier
		+
		remplir cmd & details_cmd (AJAX)
		+
		alerte cmd effectuee
		+
		suppr vue cmd
		+
		com fctn panier_ajout*/

		$reponse=new Response ();

		$reponse->setStatusCode (200);

		return ($reponse);
	}
}