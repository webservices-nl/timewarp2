<?php

namespace TestCode\Event;

use EventStore\ValueObjects\Identity\UUID;
use EventStore\WritableToStream;

/**
 * Class AbstractEvent
 */
abstract class AbstractEvent implements WritableToStream
{
    /**
     * @var \DateTime
     */
    protected $dateTime;

    /**
     * @var string
     */
    protected $type;

    /**
     * AbstractEvent constructor.
     *
     * @param \DateTime $dateTime
     */
    protected function __construct(\DateTime $dateTime)
    {
        $this->dateTime = $dateTime;
        $this->type = static::getType();
    }

    abstract protected static function getType() : string;

    abstract public function getData();


    public abstract function formatHtml();

    public function toStreamData()
    {
        return [
            'eventId' => (new UUID())->toNative(),
            'eventType' => $this->type,
            'dateTime' => $this->dateTime->format('Y-m-d'),
            'data' => $this->getData(),
            'contentHtml'=>$this->formatHtml()
        ];
    }
}
