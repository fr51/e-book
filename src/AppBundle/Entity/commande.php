<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * commande
 *
 * @ORM\Table(name="commande")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\commandeRepository")
 */
class commande
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
     * @ORM\ManyToOne(targetEntity="utilisateur", inversedBy="utilisateur")
     */
    private $utilisateur;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="livre", inversedBy="livre")
     */
    private $livre;
    /**
     * @var \utilisateur
     *
     * @ORM\OneToMany(targetEntity="utilisateur" , mappedBy="commandes" , cascade={"remove","persist"})
     */
    private $commande;


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
     * @return commande
     */
    public function setUtilisateur($utilisateur)
    {
        $this->utilisateur = $utilisateur;

        return $this;
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
     * Set livre
     *
     * @param integer $livre
     *
     * @return commande
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
}

