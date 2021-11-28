<?php

namespace App\IdentityAccess\Domain;

use App\Common\Domain\DomainEventRecording;
use App\Common\Domain\Id;
use App\Common\Domain\RecordingDomainEvents;
use App\IdentityAccess\Domain\Role;
use Doctrine\Common\Collections\ArrayCollection;

class User implements RecordingDomainEvents
{
    use DomainEventRecording;

    private $roles;

    public function __construct(private Id $id, private string $name, private string $email, private string $password)
    {
        $this->setId($id);
        $this->setName($name);
        $this->setEmail($email);
        $this->setPassword($password);
        $this->setRoles([]);

        $this->recordThat(new UserRegistered($this->id, $this->name, $this->email));
    }

    public function getId(): Id
    {
        return $this->id;
    }

    private function setId(Id $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    private function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    private function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    private function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles(): array
    {
        return $this->roles->toArray();
    }

    private function setRoles(array $roles): self
    {
        $this->roles = new ArrayCollection($roles);

        return $this;
    }

    public function assignRole(Role $role): void
    {
        if ($this->roles->contains($role)) {
            throw new RoleAlreadyAssigned();
        }

        $this->roles->add($role);
    }
}
