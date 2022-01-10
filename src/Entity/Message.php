<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 *  @ApiResource()
 * @ORM\Entity(repositoryClass=MessageRepository::class)
 */
class Message
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
     *  @Groups({"messages"})
     */
    private $titre;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"messages"})
     */
    private $date_publication;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"messages"})
     */
    private $message;

    /**
     * @ORM\ManyToOne(targetEntity=Categories::class, inversedBy="categorie")
     */
    private $categorie;

    /**
     * @ORM\ManyToOne(targetEntity=Categories::class, inversedBy="message")
     */
    private $categories;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDatePublication(): ?\DateTimeInterface
    {
        return $this->date_publication;
    }

    public function setDatePublication(?\DateTimeInterface $date_publication): self
    {
        $this->date_publication = $date_publication;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getCategorie(): ?Categories
    {
        return $this->categorie;
    }

    public function setCategorie(?Categories $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getCategories(): ?Categories
    {
        return $this->categories;
    }

    public function setCategories(?Categories $categories): self
    {
        $this->categories = $categories;

        return $this;
    }
}
