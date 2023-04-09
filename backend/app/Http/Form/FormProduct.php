<?php

namespace Application\Source\Http\Form;

use function Symfony\Component\String\b;

class FormProduct
{
    private array $rules = [
        'sku' => 'required',
        'name' => 'required',
        'price' => 'required',
        'type' => ['required', 'allowed_types'],
        'value' => 'required'
    ];

    public function validate(array $args): bool
    {
        $errors = 0;
        $rules = $this->getRules();

        foreach ($rules as $item => $rule) {
            $value = null;

            if (!array_key_exists($item, $args)) {
                $errors++;
                break;
            } else {
                $value = $args[$item];
                unset($args[$item]);

                if (is_array($rule)) {
                    foreach ($rule as $r) {
                        if ($this->switchCaseRules($r, $value)) $errors++;
                    }
                } else {
                    if ($this->switchCaseRules($rule, $value)) $errors++;
                }
            }
        }

        return $errors === 0;
    }

    private function switchCaseRules($rule, $value): bool
    {
        $hasError = false;

        switch ($rule) {
            case 'required':
                if (is_null($value)) {
                    $hasError = true;
                }
                break;
            case 'allowed_types':
                switch ($value) {
                    case 'cd':
                    case 'book':
                    case 'furniture':
                        break;
                    default:
                        $hasError = true;
                        break;
                }
                break;
            default:
                break;
        }

        return $hasError;
    }

    private function getRules()
    {
        return $this->rules;
    }
}