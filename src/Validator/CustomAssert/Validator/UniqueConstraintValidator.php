<?php


namespace App\Validator\CustomAssert\Validator;


use App\Exception\RepositoryForClassDoesNotExistException;
use App\Repository\UserRepository;
use App\Validator\CustomAssert\Unique;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
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

        if (!$constraint instanceof Unique) {
            throw new UnexpectedTypeException($constraint, Unique::class);
        }

        if (!$entityRepository) {
            throw new RepositoryForClassDoesNotExistException($className);
        }

        if ($this->userRepository->count([$fieldName => $value]) > 0) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}