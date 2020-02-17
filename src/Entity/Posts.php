<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Posts
 *
 * @ORM\Table(name="posts", indexes={@ORM\Index(name="IDX_885DBAFAA76ED395", columns={"user_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\PostsRepository")
 */
class Posts
{
    /**
     * @var int
     *
     * @ORM\Column(name="post_id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $postId;

    /**
     * @var string
     *
     * @ORM\Column(name="post", type="text", precision=0, scale=0, nullable=false, unique=false)
     */
    private $post;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="post_date", type="date", precision=0, scale=0, nullable=false, unique=false)
     */
    private $postDate;

    /**
     * @var \App\Entity\Users
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="user_id", nullable=true)
     * })
     */
    private $user;

    public function getPostId(): ?int
    {
        return $this->postId;
    }

    public function getPost(): ?string
    {
        return $this->post;
    }

    public function setPost(string $post): self
    {
        $this->post = $post;

        return $this;
    }

    public function getPostDate(): ?\DateTimeInterface
    {
        return $this->postDate;
    }

    public function setPostDate(\DateTimeInterface $postDate): self
    {
        $this->postDate = $postDate;

        return $this;
    }

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): self
    {
        $this->user = $user;

        return $this;
    }


}
