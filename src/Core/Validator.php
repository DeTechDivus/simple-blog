<?php

namespace App\Core;

class Validator {
    /** @var array The array to store validation errors. */
    protected $errors = [];

    /**
     * Validate the given data against the provided rules.
     * 
     * @param array $data The data to validate.
     * @param array $rules The validation rules.
     * @return bool True if validation passes, false if it fails.
     */
    public function validate(array $data, array $rules) {
        foreach ($rules as $field => $ruleset) {
            $rulesArray = explode('|', $ruleset);
            foreach ($rulesArray as $rule) {
                $this->applyRule($data, $field, $rule);
            }
        }

        if (!empty($this->errors)) {
            $this->returnValidationError($data);
        }

        return true;
    }

    /**
     * Apply a validation rule to a field in the data.
     * 
     * @param array $data The data to validate.
     * @param string $field The field to validate.
     * @param string $rule The validation rule to apply.
     */
    protected function applyRule($data, $field, $rule) {
        list($ruleName, $ruleValue) = array_pad(explode(':', $rule), 2, null);

        switch ($ruleName) {
            case 'required':
                if (empty($data[$field])) {
                    $this->errors[$field] = ucfirst($field) . ' is required.';
                }
                break;

            case 'email':
                if (!filter_var($data[$field], FILTER_VALIDATE_EMAIL)) {
                    $this->errors[$field] = 'Invalid email format.';
                }
                break;

            case 'min':
                if (strlen($data[$field]) < $ruleValue) {
                    $this->errors[$field] = ucfirst($field) . ' must be at least ' . $ruleValue . ' characters.';
                }
                break;

            case 'max':
                if (strlen($data[$field]) > $ruleValue) {
                    $this->errors[$field] = ucfirst($field) . ' must not exceed ' . $ruleValue . ' characters.';
                }
                break;

            // Add more rules as needed
        }
    }

    /**
     * Return validation errors as a JSON response.
     * 
     * @param array $data The data that failed validation.
     */
    protected function returnValidationError($data) {
        header('Content-Type: application/json');
        echo json_encode(['errors' => $this->errors]);
        http_response_code(422);
        exit();
    }
}

/**
 * The Validator class provides methods for validating data against a set of rules.
 * 
 * - validate: Validates the given data against the provided rules.
 * - applyRule: Applies a validation rule to a field in the data.
 * - returnValidationError: Returns validation errors as a JSON response.
 * 
 * This class follows the Single Responsibility Principle (SRP) by focusing solely on the validation of data.
 */
