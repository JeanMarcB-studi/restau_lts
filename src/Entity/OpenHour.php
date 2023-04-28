<?php

namespace App\Entity;

use App\Repository\OpenHourRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OpenHourRepository::class)]
class OpenHour
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $week_day = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $lunch_start = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $lunch_end = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $lunch_max = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $dinner_start = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $dinner_end = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $dinner_max = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWeekDay(): ?string
    {
        return $this->week_day;
    }

    public function setWeekDay(string $week_day): self
    {
        $this->week_day = $week_day;

        return $this;
    }

    public function getLunchStart(): ?\DateTimeInterface
    {
        return $this->lunch_start;
    }

    public function setLunchStart(\DateTimeInterface $lunch_start): self
    {
        $this->lunch_start = $lunch_start;

        return $this;
    }

    public function getLunchEnd(): ?\DateTimeInterface
    {
        return $this->lunch_end;
    }

    public function setLunchEnd(\DateTimeInterface $lunch_end): self
    {
        $this->lunch_end = $lunch_end;

        return $this;
    }

    public function getLunchMax(): ?int
    {
        return $this->lunch_max;
    }

    public function setLunchMax(int $lunch_max): self
    {
        $this->lunch_max = $lunch_max;

        return $this;
    }

    public function getDinnerStart(): ?\DateTimeInterface
    {
        return $this->dinner_start;
    }

    public function setDinnerStart(\DateTimeInterface $dinner_start): self
    {
        $this->dinner_start = $dinner_start;

        return $this;
    }

    public function getDinnerEnd(): ?\DateTimeInterface
    {
        return $this->dinner_end;
    }

    public function setDinnerEnd(\DateTimeInterface $dinner_end): self
    {
        $this->dinner_end = $dinner_end;

        return $this;
    }

    public function getDinnerMax(): ?int
    {
        return $this->dinner_max;
    }

    public function setDinnerMax(int $dinner_max): self
    {
        $this->dinner_max = $dinner_max;

        return $this;
    }
}
