<?php

namespace App\Entity;

use App\Repository\StuffRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StuffRepository::class)
 */
class Stuff
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     */
    private $lendAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $returnedAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\StuffImage", mappedBy="stuff", orphanRemoval=true, cascade={"persist", "remove"})
     */
    private $stuffImages;

    public function __construct()
    {
        $this->stuffImages = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLendAt(): ?\DateTimeInterface
    {
        return $this->lendAt;
    }

    public function setLendAt(\DateTimeInterface $lendAt): self
    {
        $this->lendAt = $lendAt;

        return $this;
    }

    public function getReturnedAt(): ?\DateTimeInterface
    {
        return $this->returnedAt;
    }

    public function setReturnedAt(?\DateTimeInterface $returnedAt): self
    {
        $this->returnedAt = $returnedAt;

        return $this;
    }

    /**
     * @return Collection|StuffImage[]
     */
    public function getStuffImages(): Collection
    {
        return $this->stuffImages;
    }

    public function addStuffImage(StuffImage $stuffImage): self
    {
        if (!$this->stuffImages->contains($stuffImage)) {
            $this->stuffImages[] = $stuffImage;
            $stuffImage->setStuff($this);
        }

        return $this;
    }

    public function removeStuffImage(StuffImage $stuffImage): self
    {
        if ($this->stuffImages->removeElement($stuffImage)) {
            // set the owning side to null (unless already changed)
            if ($stuffImage->getStuff() === $this) {
                $stuffImage->setStuff(null);
            }
        }

        return $this;
    }
}
