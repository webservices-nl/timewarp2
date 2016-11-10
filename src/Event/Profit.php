<?php

namespace TestCode\Event;

use JMS\Serializer\Annotation as Serializer;

class Profit extends AbstractEvent
{

    use MoneyTrait;

    protected $profit;

    public function __construct(\DateTime $datetime, $profit)
    {
        parent::__construct($datetime);
        $this->profit = self::formatCurrency($profit);
    }

    protected static function getType() : string
    {
        return 'profit';
    }

    public function getData()
    {
        return ['profit' => $this->profit];
    }
}
