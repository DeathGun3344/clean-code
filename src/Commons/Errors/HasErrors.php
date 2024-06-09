<?php

namespace DeathGun\CleanCode\Commons\Errors;

trait HasErrors
{
    /**
     * @var array Error[]
     */
    private array $errors = [];


    /**
     * @codeCoverageIgnore
     * @return Error[]
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    public function hasErrors(): bool
    {
        return !empty($this->errors);
    }

    public function getError(string $field): ?Error
    {
        /** @var Error $error */
        foreach ($this->errors as $error) {
            if ($error->field === $field) {
                return $error;
            }
        }
        return null;
    }

    public function addError(Error $error): void
    {
        $this->errors[] = $error;
    }

    /**
     * @param Error[] $errors
     * @return void
     */
    public function addErrors(array $errors): void
    {
        foreach ($errors as $error) {
            $this->addError($error);
        }
    }

    public function getErrorCount(): int
    {
        return count($this->errors);
    }
}
