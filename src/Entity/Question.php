<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\QuestionRepository")
 */
class Question
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $question_text;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    public $question_upvotes;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    public $question_downvotes;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $question_author;

    // /**
    //  * @ORM\Column(type="datetime")
    //  */
    // public $question_date;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="questions")
     */
    public $category;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Answer", mappedBy="question")
     */
    public $answers;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UserAccount", inversedBy="questions")
     */
    public $author;

    public $authorId;

    public function __construct()
    {
        $this->answers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestionText(): ?string
    {
        return $this->question_text;
    }

    public function setQuestionText(string $question_text): self
    {
        $this->question_text = $question_text;

        return $this;
    }

    public function getQuestionUpvotes(): ?int
    {
        return $this->question_upvotes;
    }

    public function setQuestionUpvotes(?int $question_upvotes): self
    {
        $this->question_upvotes = $question_upvotes;

        return $this;
    }

    public function getQuestionDownvotes(): ?int
    {
        return $this->question_downvotes;
    }

    public function setQuestionDownvotes(?int $question_downvotes): self
    {
        $this->question_downvotes = $question_downvotes;

        return $this;
    }

    public function getQuestionAuthor(): ?string
    {
        return $this->question_author;
    }

    public function setQuestionAuthor(string $question_author): self
    {
        $this->question_author = $question_author;

        return $this;
    }

    // public function getQuestionDate(): ?\DateTimeInterface
    // {
    //     return $this->question_date;
    // }

    // public function setQuestionDate(\DateTimeInterface $question_date): self
    // {
    //     $this->question_date = $question_date;

    //     return $this;
    // }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection|Answer[]
     */
    public function getAnswers(): Collection
    {
        return $this->answers;
    }

    public function addAnswer(Answer $answer): self
    {
        if (!$this->answers->contains($answer)) {
            $this->answers[] = $answer;
            $answer->setQuestion($this);
        }

        return $this;
    }

    public function removeAnswer(Answer $answer): self
    {
        if ($this->answers->contains($answer)) {
            $this->answers->removeElement($answer);
            // set the owning side to null (unless already changed)
            if ($answer->getQuestion() === $this) {
                $answer->setQuestion(null);
            }
        }

        return $this;
    }

    public function getAuthor(): ?UserAccount
    {
        return $this->author;
    }

    public function setAuthor(?UserAccount $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getAuthorId(): ?int
    {
        return $this->authorId;
    }

    public function setAuthorId(?int $authorId): self
    {
        $this->authorId = $authorId;

        return $this;
    }
}
