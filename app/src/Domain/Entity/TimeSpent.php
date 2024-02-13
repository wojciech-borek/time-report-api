<?php
namespace App\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class TimeSpent
{
    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    private ?int $id = null;

    #[ORM\Column(name:'description',type:'string',nullable: false)]
    public string $description = '';

    #[ORM\Column(name:'time',type:'integer',nullable: false)]
    public int $time = 0;

    #[ORM\Column(name:'created_at',type:'datetime',nullable: false)]
    private \DateTime $createdAt;

    #[ORM\ManyToOne(targetEntity: Contractor::class)]
    private Contractor $contractor;

    public function __construct()
    {
    }

    /**
     * @return int|null
     */
    public function getId(): ?int {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getDescription(): string {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getTime(): int {
        return $this->time;
    }

    /**
     * @param int $time
     */
    public function setTime(int $time): void {
        $this->time = $time;
    }

    /**
     * @return Contractor
     */
    public function getContractor(): Contractor {
        return $this->contractor;
    }

    /**
     * @param Contractor $contractor
     */
    public function setContractor(Contractor $contractor): void {
        $this->contractor = $contractor;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt): void {
        $this->createdAt = $createdAt;
    }



}