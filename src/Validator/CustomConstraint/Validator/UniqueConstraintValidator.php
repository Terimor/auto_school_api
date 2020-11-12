<?php


namespace App\Validator\CustomConstraint\Validator;


use App\Constants\ValidatorConst;
use App\Entity\User;
use App\Exception\RepositoryForClassDoesNotExistException;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class UniqueConstraintValidator extends ConstraintValidator
{
    private UserRepository $userRepository;
    private EntityManagerInterface $em;

    public function __construct(UserRepository $userRepository, EntityManagerInterface $em)
    {
        $this->userRepository = $userRepository;
        $this->em = $em;
    }

    public function validate($value, Constraint $constraint)
    {
        $className = $this->context->getClassName();
        $entityRepository = $this->em->getRepository($className);
        $fieldName = $this->context->getPropertyName();

        if (!$entityRepository) {
            throw new RepositoryForClassDoesNotExistException($className);
        }

        if ($this->userRepository->count([$fieldName => $value]) > 0) {
            $this->context->buildViolation(ValidatorConst::ERROR_TYPE_VALUE_EXISTS)->addViolation();
        }
    }
}