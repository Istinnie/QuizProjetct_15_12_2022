<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $LibelleQuestion = null;

    #[ORM\OneToMany(mappedBy: 'question', targetEntity: Reponse::class)]
    private Collection $Reponses;

    #[ORM\ManyToOne(inversedBy: 'Questions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Quiz $quiz = null;

    #[ORM\Column]
    private ?int $NumeroQuestion = null;

    public function __construct()
    {
        $this->Reponses = new ArrayCollection();
    }
    public function __toString(){
        return 'Question '.$this->NumeroQuestion;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleQuestion(): ?string
    {
        return $this->LibelleQuestion;
    }

    public function setLibelleQuestion(string $LibelleQuestion): self
    {
        $this->LibelleQuestion = $LibelleQuestion;

        return $this;
    }

    /**
     * @return Collection<int, Reponse>
     */
    public function getReponses(): Collection
    {
        return $this->Reponses;
    }

    public function addReponse(Reponse $reponse): self
    {
        if (!$this->Reponses->contains($reponse)) {
            $this->Reponses->add($reponse);
            $reponse->setQuestion($this);
        }

        return $this;
    }

    public function removeReponse(Reponse $reponse): self
    {
        if ($this->Reponses->removeElement($reponse)) {
            // set the owning side to null (unless already changed)
            if ($reponse->getQuestion() === $this) {
                $reponse->setQuestion(null);
            }
        }

        return $this;
    }

    public function getQuiz(): ?Quiz
    {
        return $this->quiz;
    }

    public function setQuiz(?Quiz $quiz): self
    {
        $this->quiz = $quiz;

        return $this;
    }

    public function getNumeroQuestion(): ?int
    {
        return $this->NumeroQuestion;
    }

    public function setNumeroQuestion(int $NumeroQuestion): self
    {
        $this->NumeroQuestion = $NumeroQuestion;

        return $this;
    }
}
