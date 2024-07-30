<?php

namespace App\Common\Application\ConstantBag;

final class ExceptionMessage
{
    /**
     * Invalid argument for factory.
     */
    public const INVALID_ARGUMENT_FOR_FACTORY = 'Invalid argument for factory : %s, %s. Expected param : %s';

    /**
     * Invalid argument for operation.
     */
    public const INVALID_ARGUMENT_FOR_OPERATION = 'Invalid argument for operation:%s in class: %s';

    /**
     * Invalid argument for factory instance.
     */
    public const INVALID_ARGUMENT_FOR_FACTORY_INSTANCE
        = 'Invalid argument for factory: %s with key: %s. Should be instance of: %s, given: %s';

    /**
     * Invalid argument type for factory.
     */
    public const INVALID_ARGUMENT_TYPE_FOR_FACTORY = 'Invalid argument (%s) type for factory: %s. Should be %s';

    /**
     * Wrong signature.
     */
    public const WRONG_SIGNATURE = 'Wrong signature';

    /**
     * Invalid argument (%s) type: %s. Should be: %s.
     */
    public const INVALID_ARGUMENT_TYPE = 'Invalid argument (%s) type: %s. Should be: %s';
}
