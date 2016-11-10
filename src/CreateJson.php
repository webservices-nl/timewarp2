<?php

namespace TestCode;

use Doctrine\Common\Annotations\AnnotationRegistry;
use EventStore\EventStore;
use EventStore\Http\GuzzleHttpClient;
use TestCode\Event as Event;

require_once __DIR__ . '/../vendor/autoload.php';

AnnotationRegistry::registerLoader('class_exists');

$scenario1 = [
    new Event\NewEstablishment (new \DateTime('2010-03-01'), 'Brilliant Future B.V.', 'Software'),
    new Event\Relocation       (new \DateTime('2010-12-01'), 'Rembrandtlaan 6, Amsterdam NL', 500),
    new Event\Employee         (new \DateTime('2010-12-15'), 50),
    new Event\NewPosition      (new \DateTime('2012-01-15'), 'David Watts', 'CEO', 'Ronald Wired'),
    new Event\Employee         (new \DateTime('2012-12-15'), 70),
    new Event\Profit           (new \DateTime('2013-01-15'), 100000),
    new Event\TakeOver         (new \DateTime('2013-01-15'), 'Poison BV'),
    new Event\Employee         (new \DateTime('2013-12-15'), 170),
    new Event\Relocation       (new \DateTime('2014-12-01'), 'Beethovenlaan 80, Amsterdam NL', 1500),
    new Event\Profit           (new \DateTime('2015-01-15'), 500000),
    new Event\NewPosition      (new \DateTime('2015-01-30'), 'Freddie Crooner', 'CEO', 'David Watts'),
    new Event\Profit           (new \DateTime('2015-02-15'), 400000),
    new Event\NewPosition      (new \DateTime('2015-04-15'), 'Johnny Cool', 'CEO', 'Freddie Crooner'),
    new Event\Profit           (new \DateTime('2015-04-20'), -5000),
    new Event\AcquiredBy       (new \DateTime('2015-05-15'), 'FuzzyLogic B.V.'),
];

$scenario2 = [
    new Event\NewEstablishment (new \DateTime('2010-03-01'), 'FuzzyLogic B.V.', 'Software'),
    new Event\Relocation       (new \DateTime('2010-12-01'), 'Sesamestraat 22, Utrecht NL', 50),
    new Event\Employee         (new \DateTime('2010-12-15'), 10),
    new Event\Profit           (new \DateTime('2011-01-15'), -5000),
    new Event\Employee         (new \DateTime('2011-06-15'), 20),
    new Event\AcquiredBy       (new \DateTime('2012-08-15'), 'MicroLogic B.V.'),
    new Event\NewPosition      (new \DateTime('2012-09-15'), 'Walter Spark', 'CEO'),
    new Event\Relocation       (new \DateTime('2012-12-01'), 'Donald Duck 22, Amsterdam NL', 150),
    new Event\Employee         (new \DateTime('2012-12-15'), 70),
    new Event\Profit           (new \DateTime('2012-01-15'), 1000000),
    new Event\TakeOver         (new \DateTime('2015-05-15'), 'Brilliant Future B.V.'),
];

$company1 = new CompanyHistory('Brilliant Future B.V.', $scenario1);
$company2 = new CompanyHistory('FuzzyLogic B.V.', $scenario2);

file_put_contents('company1.json', json_encode($company1->getEvents()->toStreamData(), JSON_PRETTY_PRINT));
file_put_contents('company2.json', json_encode($company2->getEvents()->toStreamData(), JSON_PRETTY_PRINT));