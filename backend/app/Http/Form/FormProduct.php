<?php

namespace Application\Source\Http\Form;

class FormProduct
{
    private array $rules = [
        'sku' => 'required',
        'name' => 'required',
        'price' => 'required',
        'type' => 'required',
        'value' => 'required'
    ];

    public function validate(array $args)
    {
        $errors = 0;
        $rules = $this->getRules();

        foreach ($rules as $item => $rule) {
            $value = $args[$item] ?? '';

            switch ($rule) {
                case 'required':
                    if (empty($value)) {
                        $errors++;
                    }
                    break;
                default:
                    $errors++;
                    break;
            }
        }

        return $errors;
    }

    private function getRules()
    {
        return $this->rules;
    }
}