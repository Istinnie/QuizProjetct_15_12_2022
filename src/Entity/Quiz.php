<?php

namespace App\Entity;

use App\Repository\QuizRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuizRepository::class)]
class Quiz
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $NumeroQuiz = null;

    #[ORM\OneToMany(mappedBy: 'quiz', targetEntity: Question::class)]
    private Collection $Questions;

    #[ORM\ManyToOne(inversedBy: 'quizzes')]
    private ?User $pro = null;

    #[ORM\OneToMany(mappedBy: 'quiz', targetEntity: Resultat::class)]
    private Collection $user;

    public function __construct()
    {
        $this->Questions = new ArrayCollection();
        $this->user = new ArrayCollection();
    }
    public function __toString(){
        return 'Quiz '.$this->NumeroQuiz;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroQuiz(): ?string
    {
        return $this->NumeroQuiz;
    }

    public function setNumeroQuiz(string $NumeroQuiz): self
    {
        $this->NumeroQuiz = $NumeroQuiz;

        return $this;
    }

    /**
     * @return Collection<int, Question>
     */
    public function getQuestions(): Collection
    {
        return $this->Questions;
    }

    public function addQuestion(Question $question): self
    {
        if (!$this->Questions->contains($question)) {
            $this->Questions->add($question);
            $question->setQuiz($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): self
    {
        if ($this->Questions->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getQuiz() === $this) {
                $question->setQuiz(null);
            }
        }

        return $this;
    }

    public function getPro(): ?User
    {
        return $this->pro;
    }

    public function setPro(?User $pro): self
    {
        $this->pro = $pro;

        return $this;
    }

    /**
     * @return Collection<int, Resultat>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(Resultat $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user->add($user);
            $user->setQuiz($this);
        }

        return $this;
    }

    public function removeUser(Resultat $user): self
    {
        if ($this->user->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getQuiz() === $this) {
                $user->setQuiz(null);
            }
        }

        return $this;
    }
}
