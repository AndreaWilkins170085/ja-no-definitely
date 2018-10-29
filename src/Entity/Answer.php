<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AnswerRepository")
 */
class Answer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $answer_text;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    public $answer_upvotes;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    public $answer_downvotes;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $answer_author;

    /**
     * @ORM\Column(type="datetime")
     */
    public $answer_date;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Question", inversedBy="answers")
     */
    private $question;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnswerText(): ?string
    {
        return $this->answer_text;
    }

    public function setAnswerText(string $answer_text): self
    {
        $this->answer_text = $answer_text;

        return $this;
    }

    public function getAnswerUpvotes(): ?int
    {
        return $this->answer_upvotes;
    }

    public function setAnswerUpvotes(?int $answer_upvotes): self
    {
        $this->answer_upvotes = $answer_upvotes;

        return $this;
    }

    public function getAnswerDownvotes(): ?int
    {
        return $this->answer_downvotes;
    }

    public function setAnswerDownvotes(?int $answer_downvotes): self
    {
        $this->answer_downvotes = $answer_downvotes;

        return $this;
    }

    public function getAnswerAuthor(): ?string
    {
        return $this->answer_author;
    }

    public function setAnswerAuthor(string $answer_author): self
    {
        $this->answer_author = $answer_author;

        return $this;
    }

    public function getAnswerDate(): ?\DateTimeInterface
    {
        return $this->answer_date;
    }

    public function setAnswerDate(\DateTimeInterface $answer_date): self
    {
        $this->answer_date = $answer_date;

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
}
