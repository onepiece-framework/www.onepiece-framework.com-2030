<?php
/**	op-skeleton-2020:/asset/config/translation.php
 *
 * @created   2022-12-30
 * @license   Apache-2.0
 * @package   op-skeleton-2020
 * @copyright Tomoaki Nagahara
 */

/**	Declare strict
 *
 */
declare(strict_types=1);

/**	namespace
 *
 */
namespace OP;

/**	Return config array.
 *
 * @return    array        $config
 */
return [
//	'execute'                =>  is move to execute.php
	'host'                   => 't9n.onepiece-framework.com',
	'language-area-id'       => 'op-translate-language-area',
	'tranlate_language_list' => md5('tranlate_language_list'),
	'tranlate_language_code' => md5('tranlate_language_code'),
	'item_language_list'     => md5('item_language_list'),
	'item_language_code'     => md5('item_language_code'),
];
