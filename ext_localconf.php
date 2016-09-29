<?php

$extractorRegistry = \TYPO3\CMS\Core\Resource\Index\ExtractorRegistry::getInstance();
$extractorRegistry->registerExtractionService(\DmitryDulepov\Filename2Title\Extractor\PrimitiveTitleExtractor::class);
unset($extractorRegistry);
