<?php

declare(strict_types=1);

namespace App\Common\Application\Service\Validator;

use App\Exception\ValidationException;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ValidatorService implements ValidatorServiceInterface
{
    public function __construct(private readonly ValidatorInterface $systemValidator)
    {
    }

    public function validate($value, $constraint = null, $groups = null): ConstraintViolationListInterface
    {
        return $this->systemValidator->validate($value, $constraint, $groups);
    }

    /**
     * {@inheritDoc}
     */
    public function validateWithThrowsException($value, $constraint = null, $groups = null): bool
    {
        $errors = $this->validate($value, $constraint, $groups);
        $errorList = $this->generateErrorList($errors);

        if ($errorList) {
            throw new ValidationException($errorList);
        }

        return true;
    }

    public function generateErrorList(ConstraintViolationListInterface $errors): array
    {
        foreach ($errors as $error) {
            $toReturn[$error->getPropertyPath()][] = $error->getMessage();
        }

        return $toReturn ?? [];
    }
}
