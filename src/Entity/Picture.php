<?php

namespace App\Entity;

use App\Repository\PictureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PictureRepository::class)]
class Picture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['allPicture','allUser'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['allPicture'])]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Groups(['allPicture'])]
    private ?string $path = null;

    #[ORM\Column]
    #[Groups(['allPicture'])]
    private ?int $totalLike = null;

    #[ORM\ManyToOne(inversedBy: 'pictures')]
    #[Groups(['allPicture'])]
    private ?User $user = null;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'picturesLike')]
    #[Groups(['allPicture'])]
    private Collection $usersLike;

    public function __construct()
    {
        $this->usersLike = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): static
    {
        $this->path = $path;

        return $this;
    }

    public function getTotalLike(): ?int
    {
        return $this->totalLike;
    }

    public function setTotalLike(int $totalLike): static
    {
        $this->totalLike = $totalLike;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsersLike(): Collection
    {
        return $this->usersLike;
    }

    public function addUsersLike(User $usersLike): static
    {
        if (!$this->usersLike->contains($usersLike)) {
            $this->usersLike->add($usersLike);
            $usersLike->addPicturesLike($this);
        }

        return $this;
    }

    public function removeUsersLike(User $usersLike): static
    {
        if ($this->usersLike->removeElement($usersLike)) {
            $usersLike->removePicturesLike($this);
        }

        return $this;
    }
}
