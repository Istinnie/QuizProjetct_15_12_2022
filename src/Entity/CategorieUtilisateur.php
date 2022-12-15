<?php

namespace App\Entity;

use App\Repository\CategorieUtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieUtilisateurRepository::class)]
class CategorieUtilisateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $LibelleCategorie = null;

    #[ORM\OneToMany(mappedBy: 'categorieUtilisateur', targetEntity: User::class)]
    private Collection $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleCategorie(): ?string
    {
        return $this->LibelleCategorie;
    }

    public function setLibelleCategorie(string $LibelleCategorie): self
    {
        $this->LibelleCategorie = $LibelleCategorie;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setCategorieUtilisateur($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getCategorieUtilisateur() === $this) {
                $user->setCategorieUtilisateur(null);
            }
        }

        return $this;
    }
}
