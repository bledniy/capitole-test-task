<?php

declare(strict_types=1);

namespace App\Common\Application\Service\Validator;

use App\Exception\ValidationException;
use Symfony\Component\Validator\ConstraintViolationListInterface;

interface ValidatorServiceInterface
{
    public function validate($value, $constraint = null, $groups = null): ConstraintViolationListInterface;

    /**
     * @throws ValidationException
     */
    public function validateWithThrowsException($value, $constraint = null, $groups = null): bool;
}
