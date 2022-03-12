<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StudentRepository::class)
 */
class Student
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=25)
     */
    private $nsc;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Email;

    /**
     * @ORM\ManyToOne(targetEntity=Classroom::class, inversedBy="students")
     */
    private $classroom;

    /**
     * @ORM\ManyToMany(targetEntity=Club::class, mappedBy="students")
     */
    private $clubs;

    public function __construct()
    {
        $this->clubs = new ArrayCollection();
    }

    public function getNsc(): ?string
    {
        return $this->nsc;
    }

    public function setNsc(string $NSC): self
    {
        $this->nsc = $NSC;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getClassroom(): ?Classroom
    {
        return $this->classroom;
    }

    public function setClassroom(?Classroom $classroom): self
    {
        $this->classroom = $classroom;

        return $this;
    }

    /**
     * @return Collection<int, Club>
     */
    public function getClubs(): Collection
    {
        return $this->clubs;
    }

    public function addClub(Club $club): self
    {
        if (!$this->clubs->contains($club)) {
            $this->clubs[] = $club;
            $club->addStudent($this);
        }

        return $this;
    }

    public function removeClub(Club $club): self
    {
        if ($this->clubs->removeElement($club)) {
            $club->removeStudent($this);
        }

        return $this;
    }
}
