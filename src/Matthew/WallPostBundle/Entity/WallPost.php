<?php
namespace Matthew\WallPostBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="wall_posts")
 */
class WallPost
{

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\Length(
     * min = 10,
     * max = 40,
     * minMessage = "Your title must be at least {{ limit }} characters long",
     * maxMessage = "Your title cannot be longer than {{ limit }} characters long"
     * )
     */
    protected $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, options={"default":"Guest"})
     */
    protected $author;

    /**
     * @ORM\Column(type="text")
     */
    protected $body;

    /**
     * @ORM\Column(type="datetime", name="create_date")
     */
    protected $create_date;

    public function __construct()
    {
        $this->create_date = new \DateTime();
    }

    /**
     *
     * @return the string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     *
     * @return the string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     *
     * @param string $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
        return $this;
    }

    /**
     *
     * @return the string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     *
     * @param string $body
     */
    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    /**
     *
     * @return the unknown_type
     */
    public function getCreateDate()
    {
        return $this->create_date;
    }

    /**
     *
     * @param
     *            mixed \DateTime|null $create_date
     */
    public function setCreateDate(\DateTime $create_date)
    {
        $this->create_date = $create_date;
        return $this;
    }
}