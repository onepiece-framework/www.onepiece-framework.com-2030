<?php
/**	op-skeleton-2030:/asset/config/git-rebase-rules.php
 *
 * @created    2025-01-08
 * @license    Apache-2.0
 * @package    op-skeleton-2030
 * @copyright  Tomoaki Nagahara
 */

/**	Declare strict
 *
 */
declare(strict_types=1);

/**	namespace
 *
 */
namespace OP;

//	...
return [
	//	Allowed commit message prefix.
	'prefix' => [
		'New: ',
		'Add: ',
		'Chg: ',
		'Fix: ',
		'Del: ',
		'Doc: ',
		'Mov: ',
		'2024: ',
		'2025: ',
		'2026: ',
		'2027: ',
		'2028: ',
		'2029: ',
		'2030: ',
	],
	//	Deny commit message word.
	'deny'   => [
	],
];
