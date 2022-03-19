<?php

namespace App\Infrastructure\Service;


use App\Infrastructure\Exception\InvalidRequestException;
use App\Infrastructure\Repository\BaseRepository\Contracts\EntityInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ValidationService
{
    /**
     * @var ValidatorInterface
     */
    private ValidatorInterface $validator;

    /**
     * @param ValidatorInterface $validator
     */
    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @param EntityInterface $entity
     * @throws InvalidRequestException
     */
    public function validator(EntityInterface $entity)
    {
        $violationsList = $this->validator->validate($entity);
        if (\count($violationsList) > 0) {
            $message = '';
            foreach ($violationsList as $violation) {
                $message .= ' | ' . $violation->getMessage();
            }
            throw new InvalidRequestException($message);
        }
    }
}