<?php
namespace DmitryDulepov\Filename2Title\Extractor;
/***************************************************************
*  Copyright notice
*
*  (c) 2016 Dmitry Dulepov <dmitry.dulepov@gmail.com>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

use TYPO3\CMS\Core\Resource\File;
use TYPO3\CMS\Core\Resource\Index\ExtractorInterface;

class PrimitiveTitleExtractor implements ExtractorInterface   {

	/**
	 * Returns an array of supported file types;
	 * An empty array indicates all filetypes
	 *
	 * @return array
	 */
	public function getFileTypeRestrictions() {
		return array();
	}

	/**
	 * Get all supported DriverClasses
	 *
	 * Since some extractors may only work for local files, and other extractors
	 * are especially made for grabbing data from remote.
	 *
	 * Returns array of string with driver names of Drivers which are supported,
	 * If the driver did not register a name, it's the classname.
	 * empty array indicates no restrictions
	 *
	 * @return array
	 */
	public function getDriverRestrictions() {
		return array();
	}

	/**
	 * Returns the data priority of the extraction Service.
	 * Defines the precedence of Data if several extractors
	 * extracted the same property.
	 *
	 * Should be between 1 and 100, 100 is more important than 1
	 *
	 * @return int
	 */
	public function getPriority() {
		return 1;
	}

	/**
	 * Returns the execution priority of the extraction Service
	 * Should be between 1 and 100, 100 means runs as first service, 1 runs at last service
	 *
	 * @return int
	 */
	public function getExecutionPriority() {
		return 1;
	}

	/**
	 * Checks if the given file can be processed by this Extractor
	 *
	 * @param File $file
	 * @return bool
	 */
	public function canProcess(File $file) {
		return $file->exists();
	}

	/**
	 * Converts the file name to the title.
	 *
	 * @param File $file
	 * @param array $previousExtractedData optional, contains the array of already extracted data
	 * @return array
	 */
	public function extractMetaData(File $file, array $previousExtractedData = []) {
		return [
			'title' => preg_replace('/[\-_]/', ' ', pathinfo($file->getForLocalProcessing(false), PATHINFO_FILENAME))
		];
	}
}
