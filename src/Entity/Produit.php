<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiResource;


/**
 * @ORM\Entity(repositoryClass=ProduitRepository::class)
 * @ApiResource(normalizationContext={"groups"={"fournisseur", "produit"}} )
 */
class Produit
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("produit")
     * @Groups("fournisseur")     
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("produit")
     * @Groups("fournisseur") 
     */
    private $marque;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("produit")
     * @Groups("fournisseur")     
     */
    private $type;

    /**
     * @ORM\Column(type="integer")
     * @Groups("produit")
     * @Groups("fournisseur")  
     */
    private $quantite;

    /**
     * @ORM\Column(type="float")
     * @Groups("produit")
     * @Groups("fournisseur")   
     */
    private $prixF;

    /**
     * @ORM\Column(type="float")
     * @Groups("produit")
     * @Groups("fournisseur")  
     */
    private $prixC;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("produit")
     * @Groups("fournisseur")     
     */
    private $codeB;

    /**
     * @ORM\Column(type="integer")
     * @Groups("produit")
     * @Groups("fournisseur")    
     */
    private $tva;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="produits")
     * @Groups("produit")
     */
    private $categorie;

    /**
     * @ORM\ManyToOne(targetEntity=Fournisseur::class, inversedBy="produits")
     * @Groups("fournisseur")
     */
    private $fournisseur;

    /**
     * @ORM\ManyToMany(targetEntity=Commande::class, mappedBy="produits")
     */
    private $commandes;

    public function __construct()
    {
        $this->commandes = new ArrayCollection();
    }

    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getPrixF(): ?float
    {
        return $this->prixF;
    }

    public function setPrixF(float $prixF): self
    {
        $this->prixF = $prixF;

        return $this;
    }

    public function getPrixC(): ?float
    {
        return $this->prixC;
    }

    public function setPrixC(float $prixC): self
    {
        $this->prixC = $prixC;

        return $this;
    }

    public function getCodeB(): ?string
    {
        return $this->codeB;
    }

    public function setCodeB(string $codeB): self
    {
        $this->codeB = $codeB;

        return $this;
    }

    public function getTva(): ?int
    {
        return $this->tva;
    }

    public function setTva(int $tva): self
    {
        $this->tva = $tva;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getFournisseur(): ?Fournisseur
    {
        return $this->fournisseur;
    }

    public function setFournisseur(?Fournisseur $fournisseur): self
    {
        $this->fournisseur = $fournisseur;

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->addProduit($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->contains($commande)) {
            $this->commandes->removeElement($commande);
            $commande->removeProduit($this);
        }

        return $this;
    }

   
}
