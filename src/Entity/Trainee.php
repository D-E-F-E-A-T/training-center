<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TraineeRepository")
 * @ApiResource(
 *     normalizationContext={
 *     "groups"= {"trainees_read"}
 *     }
 * )
 * @ApiFilter(SearchFilter::class)
 * @ApiFilter(OrderFilter::class)
 */
class Trainee
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"trainees_read", "invoices_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"trainees_read", "invoices_read"})
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"trainees_read", "invoices_read"})
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"trainees_read", "invoices_read"})
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"trainees_read", "invoices_read"})
     */
    private $company;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Invoice", mappedBy="trainee")
     * @Groups({"trainees_read"})
     */
    private $invoices;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="trainees")
     * @Groups({"trainees_read"})
     */
    private $user;

    public function __construct()
    {
        $this->invoices = new ArrayCollection();
    }

    /**
     * @Groups({"trainees_read"})
     * @return float
     */
    public function getTotalAmount(): float
    {
        return array_reduce($this->invoices->toArray(), function ($total, $invoice){
            return $total + $invoice ->getAmount();
        }, 0);
    }

    /**
     * @Groups({"trainees_read"})
     * @return float
     */
    public function getUnpaidAmount(): float
    {
        return array_reduce($this->invoices->toArray(), function ($total, $invoice){
            return $total + ($invoice->getStatus() === "PAID" || $invoice->getStatus() === "CANCELLED" ? 0 : $invoice ->getAmount() );
        }, 0);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

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

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(?string $company): self
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return Collection|Invoice[]
     */
    public function getInvoices(): Collection
    {
        return $this->invoices;
    }

    public function addInvoice(Invoice $invoice): self
    {
        if (!$this->invoices->contains($invoice)) {
            $this->invoices[] = $invoice;
            $invoice->setTrainee($this);
        }

        return $this;
    }

    public function removeInvoice(Invoice $invoice): self
    {
        if ($this->invoices->contains($invoice)) {
            $this->invoices->removeElement($invoice);
            // set the owning side to null (unless already changed)
            if ($invoice->getTrainee() === $this) {
                $invoice->setTrainee(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
