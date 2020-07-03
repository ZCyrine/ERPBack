<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ApiResource(normalizationContext={"groups"={"produit", "client"}} )
 * @ORM\Entity(repositoryClass=CommandeRepository::class)
 */
class Commande
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("produit")
     * @Groups("client")  
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     * @Groups("produit")
     * @Groups("client")       
     */
    private $date;

    /**
     * @ORM\Column(type="float")
     * @Groups("produit")
     * @Groups("client")          
     */
    private $totalAvantTax;

    /**
     * @ORM\Column(type="float")
     * @Groups("produit")
     * @Groups("client")      
     */
    private $totalTax;

    /**
     * @ORM\Column(type="float")
     * @Groups("produit")
     * @Groups("client")      
     */
    private $totalApresTax;

    /**
     * @ORM\Column(type="float")
     * @Groups("produit")
     * @Groups("client")      
     */
    private $timbre;

    /**
     * @ORM\ManyToMany(targetEntity=Produit::class, inversedBy="commandes")
     * @Groups("produit")
     */
    private $produits;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="commandes")
     * @Groups("client")     
     */
    private $client;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
        $this->date = new \DateTime;

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getTotalAvantTax(): ?float
    {
        return $this->totalAvantTax;
    }

    public function setTotalAvantTax(float $totalAvantTax): self
    {
        $this->totalAvantTax = $totalAvantTax;

        return $this;
    }

    public function getTotalTax(): ?float
    {
        return $this->totalTax;
    }

    public function setTotalTax(float $totalTax): self
    {
        $this->totalTax = $totalTax;

        return $this;
    }

    public function getTotalApresTax(): ?float
    {
        return $this->totalApresTax;
    }

    public function setTotalApresTax(float $totalApresTax): self
    {
        $this->totalApresTax = $totalApresTax;

        return $this;
    }

    public function getTimbre(): ?float
    {
        return $this->timbre;
    }

    public function setTimbre(float $timbre): self
    {
        $this->timbre = $timbre;

        return $this;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->produits->contains($produit)) {
            $this->produits[] = $produit;
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->produits->contains($produit)) {
            $this->produits->removeElement($produit);
        }

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }
}
