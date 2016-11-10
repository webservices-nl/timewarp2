<?php

namespace TestCode\Event;

trait MoneyTrait
{
    protected static function formatCurrency(float $amount)
    {
        setlocale(LC_MONETARY, 'nl_NL.UTF-8');

        return money_format('%+n', $amount);
    }
}
