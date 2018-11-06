<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;

/**
* @ORM\Entity(repositoryClass="App\Repository\UserAccountRepository")
*/

class UserAccount
{

   /**
    * @ORM\Id()
    * @ORM\GeneratedValue(strategy="SEQUENCE")
    * @ORM\Column(type="integer")
    */

    public $id;

    /**
    * @ORM\Column(type="string", length=255, nullable=true)
    */

    public $name;

    /**
    * @ORM\Column(type="string", length=255, nullable=true)
    */

    public $surname;

    /**
    * @ORM\Column(type="string", length=255, nullable=true)
    */

    public $username;

    /**
    * @ORM\Column(type="string", length=255)
    * @Assert\NotBlank()
    * @Assert\Email()
    */

    public $email;

    /**
    * @Assert\NotBlank()
    */
    
    public $password;

    /**
    * @ORM\Column(type="string", length=255, nullable=true)
    */

    public $type;

    /**
    * @ORM\Column(type="string", length=255, nullable=true)
    * @Assert\Image
    * @Assert\File(maxSize = "2M")
    */

    public $image_path;

    /**
    * @ORM\Column(type="string", length=255)
    */

    private $encoded_password;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Question", mappedBy="author")
     */
    private $questions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Answer", mappedBy="author")
     */
    private $answers;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
        $this->answers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    // public function getImagePath(): ?string
    // {
    //     return $this->image_path;
    // }

    // public function setImagePath(string $image_path): self
    // {
    //     $this->image_path = $image_path;

    //     return $this;
    // }

    public function setImagePath($file)
    {
        $this->image_path = $file;
        return $this;
    }

    public function getImagePath()
    {
        return $this->image_path;
    }

    public function getAbsolutePath()
    {
        return null === $this->image_path
            ? null
            : $this->getUploadRootDir().'/'.$this->image_path;
    }

    public function getWebPath()
    {
        return null === $this->image_path
            ? null
            : $this->getUploadDir().'/'.$this->image_path;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/documents';
    }

    public function getEncodedPassword(): ?string
    {
        return $this->encoded_password;
    }

    public function setEncodedPassword(string $encoded_password): self
    {

        $encoder = new BCryptPasswordEncoder(12);
        $raw = $encoded_password;
        $salt = 12;
        $encodedPassword = $encoder->encodePassword($raw, $salt);

        $this->encoded_password = $encodedPassword;
        return $this;
    }

    /**
     * @return Collection|Question[]
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions[] = $question;
            $question->setAuthor($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): self
    {
        if ($this->questions->contains($question)) {
            $this->questions->removeElement($question);
            // set the owning side to null (unless already changed)
            if ($question->getAuthor() === $this) {
                $question->setAuthor(null);
            }
        }

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
            $answer->setAuthor($this);
        }

        return $this;
    }

    public function removeAnswer(Answer $answer): self
    {
        if ($this->answers->contains($answer)) {
            $this->answers->removeElement($answer);
            // set the owning side to null (unless already changed)
            if ($answer->getAuthor() === $this) {
                $answer->setAuthor(null);
            }
        }

        return $this;
    }

}

?>