<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LanguageRepository")
 */
class Language
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\LearningModuleTranslation", mappedBy="language", orphanRemoval=true)
     */
    private $learningModuleTranslations;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $code;

    public function __construct()
    {
        $this->learningModuleTranslations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|LearningModuleTranslation[]
     */
    public function getLearningModuleTranslations(): Collection
    {
        return $this->learningModuleTranslations;
    }

    public function addLearningModuleTranslation(LearningModuleTranslation $learningModuleTranslation): self
    {
        if (!$this->learningModuleTranslations->contains($learningModuleTranslation)) {
            $this->learningModuleTranslations[] = $learningModuleTranslation;
            $learningModuleTranslation->setLanguage($this);
        }

        return $this;
    }

    public function removeLearningModuleTranslation(LearningModuleTranslation $learningModuleTranslation): self
    {
        if ($this->learningModuleTranslations->contains($learningModuleTranslation)) {
            $this->learningModuleTranslations->removeElement($learningModuleTranslation);
            // set the owning side to null (unless already changed)
            if ($learningModuleTranslation->getLanguage() === $this) {
                $learningModuleTranslation->setLanguage(null);
            }
        }

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }
}