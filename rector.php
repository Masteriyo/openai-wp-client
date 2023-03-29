<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\SetList;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\DowngradeLevelSetList;
use Rector\CodeQuality\Rector\Class_\InlineConstructorDefaultToPropertyRector;

return static function (RectorConfig $rectorConfig) {
	$rectorConfig->paths(array(
		__DIR__ . '/src',
	));

	$rectorConfig->skip(array(
		__DIR__ . '/src/Contracts/Response.php',
	));

	$rectorConfig->sets(array(
		LevelSetList::UP_TO_PHP_70,
		DowngradeLevelSetList::DOWN_TO_PHP_70
	));
};
