<?php

namespace App\Entity;

use App\Repository\ReponseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity; 
use Gedmo\Blameable\Traits\BlameableEntity;
//  les traits en symfony


#[ORM\Entity(repositoryClass: ReponseRepository::class)]
class Reponse
{
    use TimestampableEntity;
    use BlameableEntity;
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    

    #[ORM\Column(length: 255)]
    private ?string $LibelleReponse = null;

    #[ORM\ManyToOne(inversedBy: 'Reponses')]
    private ?Question $question = null;

    #[ORM\OneToMany(mappedBy: 'reponse', targetEntity: Resultat::class)]
    private Collection $resultats;

    public function __construct()
    {
        $this->resultats = new ArrayCollection();
    }

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleReponse(): ?string
    {
        return $this->LibelleReponse;
    }

    public function setLibelleReponse(string $LibelleReponse): self
    {
        $this->LibelleReponse = $LibelleReponse;

        return $this;
    }

    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setQuestion(?Question $question): self
    {
        $this->question = $question;

        return $this;
    }

    /**
     * @return Collection<int, Resultat>
     */
    public function getResultats(): Collection
    {
        return $this->resultats;
    }

    public function addResultat(Resultat $resultat): self
    {
        if (!$this->resultats->contains($resultat)) {
            $this->resultats->add($resultat);
            $resultat->setReponse($this);
        }

        return $this;
    }

    public function removeResultat(Resultat $resultat): self
    {
        if ($this->resultats->removeElement($resultat)) {
            // set the owning side to null (unless already changed)
            if ($resultat->getReponse() === $this) {
                $resultat->setReponse(null);
            }
        }

        return $this;
    }
}
