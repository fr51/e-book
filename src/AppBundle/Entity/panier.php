<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * panier
 *
 * @ORM\Table (name="panier")
 * @ORM\Entity (repositoryClass="AppBundle\Repository\panierRepository")
 */
class panier
{
    /**
     * @var int
     *
     * @ORM\Column (name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\ManyToOne (targetEntity="utilisateur")
     */
    private $utilisateur;

    /**
     * @var \DateTime
     *
     * @ORM\Column (type="datetime")
     */
    private $dateAjout;

	/**
	 * @var float
	 *
	 * @ORM\Column (type="float", nullable=true)
	 */
	private $prix;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set utilisateur
     *
     * @param integer $utilisateur
     *
     * @return void
     */
    public function setUtilisateur($utilisateur)
    {
        $this->utilisateur = $utilisateur;
    }

    /**
     * Get utilisateur
     *
     * @return int
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    /**
     * Set dateAjout
     *
     * @param \DateTime $date
     *
     * @return void
     */
    public function setDateAjout ($date)
    {
        $this->dateAjout=$date;
    }

    /**
     * Get dateAjout
     *
     * @return \DateTime
     */
    public function getDateAjout ()
    {
        return $this->dateAjout;
    }

    /**
	 * Set prix
	 *
	 * @param float $prix
	 *
	 * @return void
	 */
    public function setPrix ($prix)
	{
		$this->prix=$prix;
	}

	/**
	 * Get prix
	 *
	 * @return float
	 */
	public function getPrix ()
	{
		return ($this->prix);
	}
}