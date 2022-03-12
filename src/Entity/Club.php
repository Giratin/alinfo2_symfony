<?php

namespace App\Entity;

use App\Repository\ClubRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClubRepository::class)
 */
class Club
{

    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=25)
     */
    private $ref;

    /**
     * @ORM\Column(type="date")
     */
    private $Creation_date;

    /**
     * @ORM\ManyToMany(targetEntity=Student::class, inversedBy="clubs")
     * @ORM\JoinTable(
     *     name="student_club",
     *     joinColumns={@ORM\JoinColumn(onDelete="CASCADE", referencedColumnName="ref")},
     *     inverseJoinColumns={@ORM\JoinColumn(onDelete="CASCADE", referencedColumnName="nsc")}
     * )
     */
    private $students;

    public function __construct()
    {
        $this->students = new ArrayCollection();
    }


    public function getRef(): ?string
    {
        return $this->ref;
    }

    public function setRef(string $ref): self
    {
        $this->ref = $ref;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->Creation_date;
    }

    public function setCreationDate(\DateTimeInterface $Creation_date): self
    {
        $this->Creation_date = $Creation_date;

        return $this;
    }

    /**
     * @return Collection<int, Student>
     */
    public function getStudents(): Collection
    {
        return $this->students;
    }

    public function addStudent(Student $student): self
    {
        if (!$this->students->contains($student)) {
            $this->students[] = $student;
        }

        return $this;
    }

    public function removeStudent(Student $student): self
    {
        $this->students->removeElement($student);

        return $this;
    }
}
