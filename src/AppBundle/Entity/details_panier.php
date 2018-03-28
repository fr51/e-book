<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * details_panier
 *
 * @ORM\Table (name="details_panier")
 * @ORM\Entity (repositoryClass="AppBundle\Repository\details_panierRepository")
 */
class details_panier
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
     * @var \AppBundle\Entity\panier
     *
     * @ORM\ManyToOne (targetEntity="panier")
     */
    private $panier;

    /**
     * @var \AppBundle\Entity\livre
     *
     * @ORM\ManyToOne (targetEntity="livre")
     */
    private $livre;

    /**
     * @var int
     *
     * @ORM\Column(name="quantite", type="integer")
     */
    private $quantite;

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
     * Set panier
     *
     * @param \AppBundle\Entity\panier $panier
     *
     * @return void
     */
    public function setPanier ($panier)
    {
        $this->panier=$panier;
    }

    /**
     * Get panier
     *
     * @return \AppBundle\Entity\panier
     */
    public function getPanier ()
    {
        return ($this->panier);
    }

    /**
     * Set livre
     *
     * @param \AppBundle\Entity\livre $livre
     *
     * @return void
     */
    public function setLivre($livre)
    {
        $this->livre = $livre;
    }

    /**
     * Get livre
     *
     * @return \AppBundle\Entity\livre
     */
    public function getLivre()
    {
        return $this->livre;
    }

    /**
     * Set quantite
     *
     * @param integer $quantite
     *
     * @return void
     */
    public function setQuantite($quantite)
	{
		$this->quantite=$quantite;
	}

    /**
     * Get quantite
     *
     * @return int
     */
    public function getQuantite()
    {
        return $this->quantite;
    }
}