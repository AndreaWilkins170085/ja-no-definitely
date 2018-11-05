<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentRepository")
 */
class Comment
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
    public $comment_author;

    /**
     * @ORM\Column(type="text")
     */
    public $commentText;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommentAuthor(): ?string
    {
        return $this->comment_author;
    }

    public function setCommentAuthor(string $comment_author): self
    {
        $this->comment_author = $comment_author;

        return $this;
    }

    public function getCommentText(): ?string
    {
        return $this->commentText;
    }

    public function setCommentText(string $commentText): self
    {
        $this->commentText = $commentText;

        return $this;
    }
}
