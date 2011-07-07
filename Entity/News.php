<?php

namespace IMAG\NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM,
  Symfony\Component\Validator\Constraints as Assert;

/**
 *@ORM\Entity(repositoryClass="IMAG\NewsBundle\Repository\NewsRepository")
 *@ORM\HasLifecycleCallbacks
 */

class News
{
  /**
   * @ORM\Id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   * @Assert\Type("Integer")
   */
  protected $id;

  /**
   * @ORM\Column(type="string")
   * @Assert\NotBlank(message="Title required")
   * @Assert\Type("string")
   */
  protected $title;

  /**
   * @ORM\Column(type="text")
   * @Assert\Type("string")
   * @Assert\NotBlank
   */
  protected $abstract;

  /**
   * @ORM\Column(type="text")
   * @Assert\NotBlank(message="Body mandatory")
   * @Assert\Type("string")
   */
  protected $body;
  
  /**
   * @ORM\Column(type="string")
   * @Assert\NotBlank(message="Pseudo required")
   * @Assert\Type("string")
   */
  protected $pseudo;
  
  /**
   * @ORM\Column(type="string")
   * @Assert\NotBlank(message="Mail required")
   * @Assert\Email
   */
  protected $mail;

  /**
   * @ORM\Column(type="datetime")
   * @Assert\NotNull
   * @Assert\DateTime
   */
  protected $createdAt;

  /**
   * @ORM\Column(type="datetime")
   * @Assert\NotNull
   * @Assert\DateTime
   */
  protected $updatedAt;
 
  /**
   * @ORM\Column(type="datetime")
   * @Assert\NotNull
   * @Assert\DateTime
   */
  protected $expiredAt;

  /**
   * @ORM\Column(type="text", nullable=true)
   * @Assert\File
   */
  protected $logo;

  /**
   * @ORM\ManyToOne(targetEntity="Status", inversedBy="news")
   * @ORM\JoinColumn(name="status_id", referencedColumnName="id")
   * @Assert\Type("object")
   * @Assert\NotNull
   */
  protected $status;

  /**
   * @ORM\ManyToOne(targetEntity="Category", inversedBy="news")
   * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
   * @Assert\Type("object")
   * @Assert\NotNull
   */
  protected $category;

  public function __construct()
  {
    $this->createdAt = $this->updatedAt = new \DateTime('now');
  }

  /**
   * @ORM\PreUpdate
   */
  public function update()
  {
    $this->updatedAt = new \DateTime('now');
  }
  
  /**
   *@ORM\PrePersist
   */
  public function doAddOnPrePersist()
  {
    if(empty($this->abstract)) {
      $array = preg_split('/\n/',wordwrap($this->body, 100));
      $this->abstract = sprintf("%s[...]", $array[0]);
    }
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
     * Set title
     *
     * @param text $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get title
     *
     * @return text 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set abstract
     *
     * @param text $abstract
     */
    public function setAbstract($abstract)
    {
        $this->abstract = $abstract;
    }

    /**
     * Get abstract
     *
     * @return text 
     */
    public function getAbstract()
    {
        return $this->abstract;
    }

    /**
     * Set body
     *
     * @param text $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * Get body
     *
     * @return text 
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set pseudo
     *
     * @param text $pseudo
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }

    /**
     * Get pseudo
     *
     * @return text 
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Set mail
     *
     * @param text $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * Get mail
     *
     * @return text 
     */
    public function getMail()
    {
        return $this->mail;
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
     * Set expiredAt
     *
     * @param datetime $expiredAt
     */
    public function setExpiredAt($expiredAt)
    {
        $this->expiredAt = $expiredAt;
    }

    /**
     * Get expiredAt
     *
     * @return datetime 
     */
    public function getExpiredAt()
    {
        return $this->expiredAt;
    }

    /**
     * Set logo
     *
     * @param CLOB $logo
     */
    public function setLogo(\CLOB $logo)
    {
        $this->logo = $logo;
    }

    /**
     * Get logo
     *
     * @return CLOB 
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set status
     *
     * @param IMAG\NewsBundle\Entity\Status $status
     */
    public function setStatus(\IMAG\NewsBundle\Entity\Status $status)
    {
        $this->status = $status;
    }

    /**
     * Get status
     *
     * @return IMAG\NewsBundle\Entity\Status 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set category
     *
     * @param IMAG\NewsBundle\Entity\Category $category
     */
    public function setCategory(\IMAG\NewsBundle\Entity\Category $category)
    {
        $this->category = $category;
    }

    /**
     * Get category
     *
     * @return IMAG\NewsBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }
}