<?php


namespace App\Entity\Collection;


use App\Entity\UserSchoolMembership;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class MembershipCollection extends ArrayCollection
{
    public function getAdministratorRoleUsers(): Collection
    {
        return $this->getUsersWithNeededRole(UserSchoolMembership::ROLE_ADMINISTRATOR);
    }

    public function getStudentRoleUsers(): Collection
    {
        return $this->getUsersWithNeededRole(UserSchoolMembership::ROLE_STUDENT);
    }

    public function getDriverRoleUsers(): Collection
    {
        return $this->getUsersWithNeededRole(UserSchoolMembership::ROLE_DRIVER);
    }

    public function getSchoolsWithRoleAdministrator(): Collection
    {
        return $this->getSchoolsWithNeededRole(UserSchoolMembership::ROLE_ADMINISTRATOR);
    }

    public function getSchoolsWithRoleStudent(): Collection
    {
        return $this->getSchoolsWithNeededRole(UserSchoolMembership::ROLE_STUDENT);
    }

    public function getSchoolsWithRoleDriver(): Collection
    {
        return $this->getSchoolsWithNeededRole(UserSchoolMembership::ROLE_DRIVER);
    }

    private function getSchoolsWithNeededRole(string $role): Collection
    {
        $schoolsWithNeededRole = new ArrayCollection();

        /** @var UserSchoolMembership $membership */
        foreach ($this as $membership) {
            if ($membership->getRole() === $role) {
                $schoolsWithNeededRole->add($membership->getSchool());
            }
        }

        return $schoolsWithNeededRole;
    }

    private function getUsersWithNeededRole(string $role): Collection
    {
        $usersWithNeededRole = new ArrayCollection();

        /** @var UserSchoolMembership $membership */
        foreach ($this as $membership) {
            if ($membership->getRole() === $role) {
                $usersWithNeededRole->add($membership->getUser());
            }
        }

        return $usersWithNeededRole;
    }
}