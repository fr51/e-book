<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * editeur
 *
 * @ORM\Table(name="editeur")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\editeurRepository")
 */
class editeur
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
     * @ORM\Column(name="nom_editeur", type="string", length=50)
     */
    private $nomEditeur;

    /**
     * @var \livre
     *
     * @ORM\OneToMany(targetEntity="livre" , mappedBy="editeur" , cascade={"remove","persist"})
     */
    private $editeur;


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
     * Set nomEditeur
     *
     * @param string $nomEditeur
     *
     * @return editeur
     */
    public function setNomEditeur($nomEditeur)
    {
        $this->nomEditeur = $nomEditeur;

        return $this;
    }

    /**
     * Get nomEditeur
     *
     * @return string
     */
    public function getNomEditeur()
    {
        return $this->nomEditeur;
    }
}

