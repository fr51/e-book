<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * utilisateur
 *
 * @ORM\Table(name="utilisateur")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\utilisateurRepository")
 */
class utilisateur extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @var \commande
     *
     * @ORM\OneToMany(targetEntity="commande" , mappedBy="utilisateur" , cascade={"remove","persist"})
     */
    private $utilisateurs;
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
     * Set nomUtilisateur
     *
     * @param string $nomUtilisateur
     *
     * @return utilisateur
     */
    public function setNomUtilisateur($nomUtilisateur)
    {
        $this->nomUtilisateur = $nomUtilisateur;

        return $this;
    }

    /**
     * Get nomUtilisateur
     *
     * @return string
     */
    public function getNomUtilisateur()
    {
        return $this->nomUtilisateur;
    }

    /**
     * Set prenomUtilisateur
     *
     * @param string $prenomUtilisateur
     *
     * @return utilisateur
     */
    public function setPrenomUtilisateur($prenomUtilisateur)
    {
        $this->prenomUtilisateur = $prenomUtilisateur;

        return $this;
    }

    /**
     * Get prenomUtilisateur
     *
     * @return string
     */
    public function getPrenomUtilisateur()
    {
        return $this->prenomUtilisateur;
    }

    
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        // your own logic
        $this->utilisateurs = new \Doctrine\Common\Collections\ArrayCollection();
        
    }
    /**
     * Add utilisateur
     *
     * @param \AppBundle\Entity\commande $utilisateur
     *
     * @return utilisateur
     */
    public function addUtilisateur(\AppBundle\Entity\commande $utilisateur)
    {
        $this->utilisateurs[] = $utilisateur;

        return $this;
    }

    /**
     * Remove utilisateur
     *
     * @param \AppBundle\Entity\commande $utilisateur
     */
    public function removeUtilisateur(\AppBundle\Entity\commande $utilisateur)
    {
        $this->utilisateurs->removeElement($utilisateur);
    }

    /**
     * Get utilisateurs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUtilisateurs()
    {
        return $this->utilisateurs;
    }
}
