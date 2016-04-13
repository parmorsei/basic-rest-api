<?php
namespace App\Lib\Api\Exceptions;

/**
 * Exception class
 */
class InvalidBasicException  extends \Exception
{
    /**
     * {@inheritdoc}
     */
    public $httpStatusCode = 200;

    /**
     * {@inheritdoc}
     */
    public $errorType = 'invalid_basic';

    /**
     * {@inheritdoc}
     */
    public function __construct($error)
    {
        parent::__construct($error);
    }
}
