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
     * @var \commande
     *
     * @ORM\ManyToOne(targetEntity="commande", inversedBy="commandes")
     */
    private $commande;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="livre", inversedBy="livres")
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
     * Set commande
     *
     * @param integer $commande
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
     * @return int
     */
    public function getCommande()
    {
        return $this->commande;
    }

    /**
     * Set livre
     *
     * @param integer $livre
     *
     * @return details_commande
     */
    public function setLivre($livre)
    {
        $this->livre = $livre;

        return $this;
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
     * @return details_commande
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
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
     * @return details_commande
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
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

