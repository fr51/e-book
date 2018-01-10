<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * livre
 *
 * @ORM\Table(name="livre")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\livreRepository")
 */
class livre
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
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=50)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="auteur", type="string", length=100)
     */
    private $auteur;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="editeur", inversedBy="editeurs")
     */
    private $editeur;

    /**
     * @var int
     *
     * @ORM\Column(name="ISBN", type="integer")
     */
    private $iSBN;

    /**
     * @var string
     *
     * @ORM\Column(name="couverture", type="string", length=200)
     */
    private $couverture;

    /**
     * @var int
     *
     * @ORM\Column(name="prix_unitaire", type="integer")
     */
    private $prixUnitaire;

    /**
     * @var \details_commande
     *
     * @ORM\ManytoOne(targetEntity="details_commande" , inversedBy="livre" , cascade={"remove","persist"})
     */
    private $livres;


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
     * Set titre
     *
     * @param string $titre
     *
     * @return livre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set auteur
     *
     * @param string $auteur
     *
     * @return livre
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * Get auteur
     *
     * @return string
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Set editeur
     *
     * @param string $editeur
     *
     * @return livre
     */
    public function setEditeur($editeur)
    {
        $this->editeur = $editeur;

        return $this;
    }

    /**
     * Get editeur
     *
     * @return string
     */
    public function getEditeur()
    {
        return $this->editeur;
    }

    /**
     * Set iSBN
     *
     * @param integer $iSBN
     *
     * @return livre
     */
    public function setISBN($iSBN)
    {
        $this->iSBN = $iSBN;

        return $this;
    }

    /**
     * Get iSBN
     *
     * @return int
     */
    public function getISBN()
    {
        return $this->iSBN;
    }

    /**
     * Set couverture
     *
     * @param string $couverture
     *
     * @return livre
     */
    public function setCouverture($couverture)
    {
        $this->couverture = $couverture;

        return $this;
    }

    /**
     * Get couverture
     *
     * @return string
     */
    public function getCouverture()
    {
        return $this->couverture;
    }

    /**
     * Set prixUnitaire
     *
     * @param integer $prixUnitaire
     *
     * @return livre
     */
    public function setPrixUnitaire($prixUnitaire)
    {
        $this->prixUnitaire = $prixUnitaire;

        return $this;
    }

    /**
     * Get prixUnitaire
     *
     * @return int
     */
    public function getPrixUnitaire()
    {
        return $this->prixUnitaire;
    }
}

