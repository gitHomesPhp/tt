<?php

declare(strict_types=1);

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Arr;

class ITNValidator implements Rule
{
    private string $message = 'The validation error message';

    /**
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $countSymbols = iconv_strlen($value, 'UTF-8');

        if ($countSymbols !== 10 && $countSymbols !== 12) {
            $this->message = 'ITN must have 10 or 12 symbols';
            return false;
        }

        if ($countSymbols === 10) {
            return $this->checkFor10Symbols($value);
        }

        if ($countSymbols === 12) {
            return $this->checkFor12Symbols($value);
        }

        return true;
    }

    public function message(): string
    {
        return $this->message;
    }

    private function checkFor10Symbols(string $value): bool
    {
        $value = str_split($value);
        $multiples = [2, 4, 10, 3, 5, 9, 4, 6, 8, 0];

        $sum = array_sum(
            array_map(
                fn($value, $multiple) => $value * $multiple,
                $value,
                $multiples
            )
        );

        $control = $sum % 11;

        if ($control > 9) {
            $control %= 10;
        }

        if ($control === (int) $value[9]) {
            return true;
        }

        $this->message = 'ITN don\'t valid';

        return false;
    }

    private function checkFor12Symbols(string $value): bool
    {
        $value = str_split($value);
        $multiples = [7, 2, 4, 10, 3, 5, 9, 4, 6, 8, 0, 0];

        $sum = array_sum(
            array_map(
                fn($value, $multiple) => $value * $multiple,
                $value,
                $multiples
            )
        );

        $control1 = $sum % 11;

        if ($control1 > 9) {
            $control1 %= 10;
        }

        $multiples = [3, 7, 2, 4, 10, 3, 5, 9, 4, 6, 8, 0];

        $sum = array_sum(
            array_map(
                fn($value, $multiple) => $value * $multiple,
                $value,
                $multiples
            )
        );

        $control2 = $sum % 11;

        if ($control2 > 9) {
            $control2 %= 10;
        }

        if ($control1 === (int) $value[10] && $control2 === (int) $value[11]) {
            return true;
        }

        $this->message = 'ITN don\'t valid';

        return false;
    }
}
