<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StateList
 *
 * @ORM\Table(name="state_list")
 * @ORM\Entity(repositoryClass="App\Repository\StatesRepository")
 */
class StateList
{
    /**
     * @var int
     *
     * @ORM\Column(name="state_id", type="smallint", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="state_list_state_id_seq", allocationSize=1, initialValue=1)
     */
    private $stateId;

    /**
     * @var string
     *
     * @ORM\Column(name="state_name", type="string", length=50, precision=0, scale=0, nullable=false, unique=false)
     */
    private $stateName;

    public function getStateId(): ?int
    {
        return $this->stateId;
    }

    public function getStateName(): ?string
    {
        return $this->stateName;
    }

    public function setStateName(string $stateName): self
    {
        $this->stateName = $stateName;

        return $this;
    }


}
