<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CategoriesRepository::class)
 * @ApiResource(normalizationContext= {"groups" :{"messages"}})
 */
class Categories
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"messages"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"messages"})
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=40)
     * @Groups({"messages"})
     */
    private $couleur;

    /**
     * @ORM\OneToMany(targetEntity=Message::class, mappedBy="categorie")
     * @Groups({"messages"})
     */
    private $categorie;

    /**
     * @ORM\OneToMany(targetEntity=Message::class, mappedBy="categories")
     * @Groups({"messages"})
     */
    private $message;

    public function __construct()
    {
        $this->categorie = new ArrayCollection();
        $this->message = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(string $couleur): self
    {
        $this->couleur = $couleur;

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getCategorie(): Collection
    {
        return $this->categorie;
    }

    public function addCategorie(Message $categorie): self
    {
        if (!$this->categorie->contains($categorie)) {
            $this->categorie[] = $categorie;
            $categorie->setCategorie($this);
        }

        return $this;
    }

    public function removeCategorie(Message $categorie): self
    {
        if ($this->categorie->removeElement($categorie)) {
            // set the owning side to null (unless already changed)
            if ($categorie->getCategorie() === $this) {
                $categorie->setCategorie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getMessage(): Collection
    {
        return $this->message;
    }

    public function addMessage(Message $message): self
    {
        if (!$this->message->contains($message)) {
            $this->message[] = $message;
            $message->setCategories($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->message->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getCategories() === $this) {
                $message->setCategories(null);
            }
        }

        return $this;
    }
}
