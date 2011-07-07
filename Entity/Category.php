<?php

namespace IMAG\NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM,
  Symfony\Component\Validator\Constraints as Assert,
  Symfony\Bridge\Doctrine\Validator\Constraints as DocVal;

/**
 * @ORM\Entity(repositoryClass="IMAG\NewsBundle\Repository\CategoryRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(uniqueConstraints={@ORM\UniqueConstraint(name="unique_libelle", columns={"libelle"})})
 * @DocVal\UniqueEntity(fields={"libelle"})
 */

class Category
{
   /**
   * @ORM\Id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;

  /**
   * @ORM\Column(type="string")
   * @Assert\NotBlank(message="Libelle mandatory")
   */
  protected $libelle;

  /**
   * @ORM\Column(name="created_at", type="datetime")
   * @Assert\DateTime
   * @Assert\NotNull
   */
  protected $createdAt;
  
  /**
   * @ORM\Column(name="updated_at", type="datetime")
   * @Assert\DateTime
   * @Assert\NotNull
   */
  protected $updatedAt;

  /**
   * @ORM\Column(type="integer")
   * @Assert\NotNull
   * @Assert\Type("Integer")
   */
  protected $level;

  /**
   * @ORM\OneToMany(targetEntity="News", mappedBy="category")
   * @Assert\Type("object")
   */
  protected $news;
  
  public function __construct()
  {
    $this->createdAt = $this->updatedAt = new \DateTime('now');
    $this->news = new \Doctrine\Common\Collections\ArrayCollection();
  }
  
  /**
   * @ORM\PreUpdate
   */
  public function update()
  {
    $this->updatedAt = new \DateTime('now');
  }
  
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }

    /**
     * Get libelle
     *
     * @return string 
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set createdAt
     *
     * @param datetime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Get createdAt
     *
     * @return datetime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param datetime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * Get updatedAt
     *
     * @return datetime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set level
     *
     * @param integer $level
     */
    public function setLevel($level)
    {
        $this->level = $level;
    }

    /**
     * Get level
     *
     * @return integer 
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Add news
     *
     * @param IMAG\NewsBundle\Entity\News $news
     */
    public function addNews(\IMAG\NewsBundle\Entity\News $news)
    {
        $this->news[] = $news;
    }

    /**
     * Get news
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getNews()
    {
        return $this->news;
    }
}