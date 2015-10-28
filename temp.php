<?php

if (file_exists($a = __DIR__.'/../../autoload.php')) {
    require_once ($a);
} else {
    require_once (__DIR__.'/vendor/autoload.php');
}

use Chromabits\Standards\Printer\ClassPrinter;
use PhpParser\ParserFactory;

$parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP7);

$result = $parser->parse(file_get_contents(__DIR__ . '/src/Chromabits/Standards/Console/Application.php'));

$printer = new ClassPrinter();
$result2 = $printer->go($result);

var_dump($result2);