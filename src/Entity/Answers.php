<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AnswersRepository")
 */
class Answers
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $answer_category;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $answer_text;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $answer_upvotes;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $answer_downvotes;

    /**
     * @ORM\Column(type="datetime")
     */
    private $answer_date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnswerCategory(): ?string
    {
        return $this->answer_category;
    }

    public function setAnswerCategory(string $answer_category): self
    {
        $this->answer_category = $answer_category;

        return $this;
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

    public function getAnswerDate(): ?\DateTimeInterface
    {
        return $this->answer_date;
    }

    public function setAnswerDate(\DateTimeInterface $answer_date): self
    {
        $this->answer_date = $answer_date;

        return $this;
    }
}
