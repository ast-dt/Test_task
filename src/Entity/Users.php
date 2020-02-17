<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Users
 *
 * @ORM\Table(name="users", uniqueConstraints={@ORM\UniqueConstraint(name="unique_login", columns={"login"})}, indexes={@ORM\Index(name="IDX_1483A5E9D60322AC", columns={"role_id"}), @ORM\Index(name="IDX_1483A5E95D83CC1", columns={"state_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 */
class Users
{
    /**
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=50, precision=0, scale=0, nullable=false, unique=false)
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="pswd", type="text", precision=0, scale=0, nullable=false, unique=false)
     */
    private $pswd;

    /**
     * @var string|null
     *
     * @ORM\Column(name="user_name", type="string", length=50, precision=0, scale=0, nullable=true, unique=false)
     */
    private $userName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="user_photo", type="blob", precision=0, scale=0, nullable=true, unique=false)
     */
    private $userPhoto;

    /**
     * @var \App\Entity\Roles
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Roles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="role_id", referencedColumnName="role_id", nullable=true)
     * })
     */
    private $role;

    /**
     * @var \App\Entity\StateList
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\StateList")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="state_id", referencedColumnName="state_id", nullable=true)
     * })
     */
    private $state;

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getPswd(): ?string
    {
        return $this->pswd;
    }

    public function setPswd(string $pswd): self
    {
        $this->pswd = $pswd;

        return $this;
    }

    public function getUserName(): ?string
    {
        return $this->userName;
    }

    public function setUserName(?string $userName): self
    {
        $this->userName = $userName;

        return $this;
    }

    public function getUserPhoto()
    {
        return $this->userPhoto;
    }

    public function setUserPhoto($userPhoto): self
    {
        $this->userPhoto = $userPhoto;

        return $this;
    }

    public function getRole(): ?Roles
    {
        return $this->role;
    }

    public function setRole(?Roles $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getState(): ?StateList
    {
        return $this->state;
    }

    public function setState(?StateList $state): self
    {
        $this->state = $state;

        return $this;
    }


}
