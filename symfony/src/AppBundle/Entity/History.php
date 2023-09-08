<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * History
 *
 * @ORM\Table(name="history", indexes={
 *     @ORM\Index(name="idx_created_at", columns={"createdAt"})
 * })
 * @ORM\Entity(repositoryClass="AppBundle\Repository\HistoryRepository")
 */
class History
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="firstIn", type="integer")
     */
    private $firstIn;

    /**
     * @var int
     *
     * @ORM\Column(name="secondIn", type="integer")
     */
    private $secondIn;

    /**
     * @var int
     *
     * @ORM\Column(name="firstOut", type="integer")
     */
    private $firstOut;

    /**
     * @var int
     *
     * @ORM\Column(name="secondOut", type="integer")
     */
    private $secondOut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedAt", type="datetime")
     */
    private $updatedAt;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set firstIn
     *
     * @param integer $firstIn
     *
     * @return History
     */
    public function setFirstIn($firstIn)
    {
        $this->firstIn = $firstIn;

        return $this;
    }

    /**
     * Get firstIn
     *
     * @return int
     */
    public function getFirstIn()
    {
        return $this->firstIn;
    }

    /**
     * Set secondIn
     *
     * @param integer $secondIn
     *
     * @return History
     */
    public function setSecondIn($secondIn)
    {
        $this->secondIn = $secondIn;

        return $this;
    }

    /**
     * Get secondIn
     *
     * @return int
     */
    public function getSecondIn()
    {
        return $this->secondIn;
    }

    /**
     * Set firstOut
     *
     * @param integer $firstOut
     *
     * @return History
     */
    public function setFirstOut($firstOut)
    {
        $this->firstOut = $firstOut;

        return $this;
    }

    /**
     * Get firstOut
     *
     * @return int
     */
    public function getFirstOut()
    {
        return $this->firstOut;
    }

    /**
     * Set secondOut
     *
     * @param integer $secondOut
     *
     * @return History
     */
    public function setSecondOut($secondOut)
    {
        $this->secondOut = $secondOut;

        return $this;
    }

    /**
     * Get secondOut
     *
     * @return int
     */
    public function getSecondOut()
    {
        return $this->secondOut;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return History
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return History
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
