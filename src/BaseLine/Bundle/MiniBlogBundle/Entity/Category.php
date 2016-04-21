<?php

namespace BaseLine\Bundle\MiniBlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="BaseLine\Bundle\MiniBlogBundle\Repository\CategoryRepository")
 */
class Category
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description=null;

    /**
     * @ORM\OneToMany(targetEntity="Minipost", mappedBy="category")
     */
    protected $miniposts;

    public function __construct()
    {
        $this->miniposts = new ArrayCollection();
    }
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
     * Set name
     *
     * @param string $name
     *
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Category
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Add minipost
     *
     * @param \BaseLine\Bundle\MiniBlogBundle\Entity\Minipost $minipost
     *
     * @return Category
     */
    public function addMinipost(\BaseLine\Bundle\MiniBlogBundle\Entity\Minipost $minipost)
    {
        $this->miniposts[] = $minipost;

        return $this;
    }

    /**
     * Remove minipost
     *
     * @param \BaseLine\Bundle\MiniBlogBundle\Entity\Minipost $minipost
     */
    public function removeMinipost(\BaseLine\Bundle\MiniBlogBundle\Entity\Minipost $minipost)
    {
        $this->miniposts->removeElement($minipost);
    }

    /**
     * Get miniposts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMiniposts()
    {
        return $this->miniposts;
    }
}
