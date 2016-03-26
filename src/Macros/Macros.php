<?php

/**
 *
 * This file is part of the Macdom
 *
 * Copyright (c) 2015-2016 Vladimír Macháček
 *
 * For the full copyright and license information, please view the file license.md that was distributed with this source code.
 *
 */

namespace Machy8\Macdom\Macros;

use Machy8\Macdom\Macros\CoreMacros;

class Macros extends CoreMacros {

	/**
	 * @param string $macro
	 * @param string $ln
	 * @return array
	 */
	public function replace($macro, $ln) {
		$replacement = NULL;
		$exists = FALSE;
		if (isset($this->macros[$macro])) {
			$line = trim(strstr($ln, ' '));
			$replacement = isset($this->macros[$macro]['function'])
					? call_user_func($this->macros[$macro]['function'], $line)
					: $this->{'macro' . ucfirst($this->macros[$macro])}($line);
			$exists = TRUE;
		}
		return [
			'exists' => $exists,
			'replacement' => $replacement
		];
	}
}
