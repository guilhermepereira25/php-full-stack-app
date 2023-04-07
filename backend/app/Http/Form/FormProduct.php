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

    public function validate(array $args): bool
    {
        $errors = 0;
        $rules = $this->getRules();

        foreach ($rules as $item => $rule) {
            $value = null;
            if (array_key_exists($item, $args)) {
                $value = $args[$item];
                unset($args[$item]);
                break;
            }

            switch ($rule) {
                case 'required':
                    if (is_null($value)) {
                        $errors++;
                    }
                    break;
                default:
                    $errors++;
                    break;
            }
        }

        return $errors === 0;
    }

    private function getRules()
    {
        return $this->rules;
    }
}