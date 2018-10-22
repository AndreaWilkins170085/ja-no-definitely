<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\QuestionsRepository")
 */
class Questions
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $category_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $question_text;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $question_upvotes;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $question_downvotes;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $question_author;

    /**
     * @ORM\Column(type="datetime")
     */
    private $question_date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategoryId(): ?int
    {
        return $this->category_id;
    }

    public function setCategoryId(int $category_id): self
    {
        $this->category_id = $category_id;

        return $this;
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

    public function getQuestionDate(): ?\DateTimeInterface
    {
        return $this->question_date;
    }

    public function setQuestionDate(\DateTimeInterface $question_date): self
    {
        $this->question_date = $question_date;

        return $this;
    }
}
