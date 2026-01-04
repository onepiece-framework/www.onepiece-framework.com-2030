<?php
/**	op-skeleton-2030:/webpack.php
 *
 * @created    2024-01-23
 * @copied     2024-11-05  op-unit-webpack --> op-skeleton-2024
 * @license    Apache-2.0
 * @version    2.0
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

//	In case of JavaScript.
$js = [
	'debug' =>  false,	 // for debug flag
	'cache' =>  true,	 // file, apcu, memcache
	'minify'=>  true,	 // File compression. Remove space character and comment.
];

//	In case of style sheet.
$css = [
	'debug' =>  false,	 // for debug flag
	'cache' =>  true,	 // file, apcu, memcache
	'minify'=>  true,	 // File compression. Remove space character and comment.
];

//	In case of is Admin.
$admin = [
	'debug' => false,
	'cache' => true,
	'minify'=> true,
];

//	...
$config = [
	'js'    => $js,
	'css'   => $css,
	'admin' => $admin,
];

//	...
return $config;
