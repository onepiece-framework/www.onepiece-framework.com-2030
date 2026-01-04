<?php
/**	op-skeleton-2030:/asset/config/app_id.php
 *
 * @created   2022-10-20
 * @version   1.0
 * @package   op-skeleton-2030
 * @copyright Tomoaki Nagahara
 */

/**	Declare strict
 *
 */
declare(strict_types=1);

/**	Namespace
 *
 */
namespace OP;

/**	Set the string used as the seed for generating the AppID.
 *
 * Generates an AppID based on $seed.
 * Use an extremely long string.
 * The longer the string, the harder it is to predict.
 * We recommend including non-alphabetic characters such as kanji or emoji.
 */
$seed = require_once(__DIR__.'/app_id_seed.php');

//	Check the length of the seed string.
if( $seed and strlen($seed) < 32 ){
	throw new \Exception('The AppID seed string is too short.');
}

//	Generate an AppID.
if( defined('_IS_CI_') ){
	$app_id = 'CI';
}else if( $seed ){
	$length = (_OP_APP_BRANCH_ < 2030) ? 8: 10;
	$app_id = substr(md5($seed), 0, $length);
}else{
	$app_id = null;
}

/**	Define the AppID.
 *
 * The AppID is used for encryption.
 * Cookies are also encrypted when stored.
 * Do not expose the AppID.
 */
define('_APP_ID_' , $app_id);

//	Return config array.
return [
	OP::_APP_ID_ => $app_id
];
