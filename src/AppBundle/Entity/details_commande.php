<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * details_commande
 *
 * @ORM\Table(name="details_commande")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\details_commandeRepository")
 */
class details_commande
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var \AppBundle\Entity\commande
     *
     * @ORM\ManyToOne(targetEntity="commande")
     */
    private $commande;

    /**
     * @var \AppBundle\Entity\panier
     *
     * @ORM\ManyToOne (targetEntity="panier")
     */
    private $panier;


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
     * Set commande
     *
     * @param \AppBundle\Entity\commande $commande
     *
     * @return details_commande
     */
    public function setCommande($commande)
    {
        $this->commande = $commande;

        return $this;
    }

    /**
     * Get commande
     *
     * @return \AppBundle\Entity\commande
     */
    public function getCommande()
    {
        return $this->commande;
    }

	/**
	 * Get panier
	 *
	 * @return \AppBundle\Entity\panier
	 */
	public function get_panier ()
	{
		return $this->panier;
	}

    /**
     * Set panier
     *
     * @param \AppBundle\Entity\panier $panier
     *
     * @return void
     */
    public function set_panier ($panier)
    {
        $this->panier=$panier;
    }
}