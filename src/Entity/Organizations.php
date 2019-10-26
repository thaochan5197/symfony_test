<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrganizationsRepository")
 */
class Organizations
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\OrganizationType", inversedBy="organizations")
     * @Assert\NotBlank
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Staffs", mappedBy="organization")
     * @Assert\NotBlank
     */
    private $staffs;

    public function __construct()
    {
        $this->staffs = new ArrayCollection();
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

    public function getType(): ?OrganizationType
    {
        return $this->type;
    }

    public function setType(?OrganizationType $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|Staffs[]
     */
    public function getStaffs(): Collection
    {
        return $this->staffs;
    }

    public function addStaff(Staffs $staff): self
    {
        if (!$this->staffs->contains($staff)) {
            $this->staffs[] = $staff;
            $staff->setOrganization($this);
        }

        return $this;
    }

    public function removeStaff(Staffs $staff): self
    {
        if ($this->staffs->contains($staff)) {
            $this->staffs->removeElement($staff);
            // set the owning side to null (unless already changed)
            if ($staff->getOrganization() === $this) {
                $staff->setOrganization(null);
            }
        }

        return $this;
    }
}
