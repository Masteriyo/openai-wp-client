<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\Class_\InlineConstructorDefaultToPropertyRector;
use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;

return static function (RectorConfig $rectorConfig) {
	$rectorConfig->paths(array(
		__DIR__ . '/src',
	));

	$rectorConfig->skip(array(
		__DIR__ . '/src/Contracts/Response.php',
	));

	$rectorConfig->sets(array(
		LevelSetList::UP_TO_PHP_70,
	));
};
