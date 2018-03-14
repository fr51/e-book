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
     * @var int
     *
     * @ORM\ManyToOne (targetEntity="panier")
     */
    private $panier;

    /**
     * @var int
     *
     * @ORM\ManyToOne (targetEntity="livre")
     */
    private $livre;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float")
     */
    private $prix;

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
     * @param int $panier
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
     * @return int
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
     * @return int
     */
    public function getLivre()
    {
        return $this->livre;
    }

    /**
     * Set prix
     *
     * @param float $prix
     *
     * @return void
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
    }

    /**
     * Get prix
     *
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
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