<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Roles
 *
 * @ORM\Table(name="roles")
 * @ORM\Entity(repositoryClass="App\Repository\RolesRepository")
 */
class Roles
{
    /**
     * @var int
     *
     * @ORM\Column(name="role_id", type="smallint", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="roles_role_id_seq", allocationSize=1, initialValue=1)
     */
    private $roleId;

    /**
     * @var string
     *
     * @ORM\Column(name="role_name", type="string", length=10, precision=0, scale=0, nullable=false, unique=false)
     */
    private $roleName;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_admin", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $isAdmin;

    public function getRoleId(): ?int
    {
        return $this->roleId;
    }

    public function getRoleName(): ?string
    {
        return $this->roleName;
    }

    public function setRoleName(string $roleName): self
    {
        $this->roleName = $roleName;

        return $this;
    }

    public function getIsAdmin(): ?bool
    {
        return $this->isAdmin;
    }

    public function setIsAdmin(bool $isAdmin): self
    {
        $this->isAdmin = $isAdmin;

        return $this;
    }


}
