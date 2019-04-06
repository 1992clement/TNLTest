<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Service\Utils;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EventRepository")
 */
class Event
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $placeName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="date")
     */
    private $startDate;

    /**
     * @ORM\Column(type="date")
     */
    private $endDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startTime;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $eventUrl;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pictureUrl;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $picture;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPlaceName(): ?string
    {
        return $this->placeName;
    }

    public function setPlaceName(string $placeName): self
    {
        $this->placeName = $placeName;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getStartTime(): ?\DateTimeInterface
    {
        return $this->startTime;
    }

    public function setStartTime(\DateTimeInterface $startTime): self
    {
        $this->startTime = $startTime;

        return $this;
    }

    public function getEventUrl(): ?string
    {
        return $this->eventUrl;
    }

    public function setEventUrl(?string $eventUrl): self
    {
        $this->eventUrl = $eventUrl;

        return $this;
    }

    public function getPictureUrl(): ?string
    {
        return $this->pictureUrl;
    }

    public function setPictureUrl(?string $pictureUrl): self
    {
        $this->pictureUrl = $pictureUrl;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    /**
    * Hydrate Event object form decoded Json
    * Object has to be validated BEFORE with App\Service\EventDataValidator::validateJson();
    * @param stdClass $data
    */
    public function initEntityFromJson($data){

        $this->setId($data->id);
        $this->setTitle($data->title);
        $this->setDescription($data->description);
        $this->setPlaceName($data->placeName);
        $this->setCity($data->city);
        $startDate = \DateTime::createFromFormat('d-m-Y H:i:s', $data->startDate . ' 00:00:00');
        $this->setStartDate($startDate);
        $endDate = \DateTime::createFromFormat('d-m-Y H:i:s', $data->endDate  . ' 00:00:00');
        $this->setEndDate($endDate);
        $startTime = \DateTime::createFromFormat('d-m-Y H:i:s', '01-01-0000 ' . $data->startTime);
        $this->setStartTime($startTime);
        $this->setEventUrl($data->eventUrl);
        $this->setPictureUrl($data->pictureUrl);
        $this->setPicture($data->picture);

        return $this;
    }
}
