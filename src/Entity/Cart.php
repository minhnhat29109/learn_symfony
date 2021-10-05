<?php

namespace App\Entity;

use App\Repository\CartRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CartRepository::class)
 */
class Cart
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="date_time", type="datetime", nullable=true)
     */
    private $datetime;

    /**
     * @var User|null
     * @ORM\OneToOne(targetEntity="User")
     */
    private $user;

    /**
     * @var Collection|Task[]
     * @ORM\ManyToMany(targetEntity="Task")
     */
    private $tasks;

    public function __construct()
    {
        $this->tasks = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * @param mixed $datetime
     */
    public function setDatetime($datetime): void
    {
        $this->datetime = $datetime;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    /**
     * @return Task[]|Collection
     */
    public function getTasks()
    {
        return $this->tasks;
    }

    /**
     * @param Task[]|Collection $tasks
     */
    public function setTasks($tasks): void
    {
        $this->tasks = $tasks;
    }


}
