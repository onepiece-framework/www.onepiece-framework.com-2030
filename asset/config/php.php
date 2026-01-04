<?php
/**	op-skeleton-2030:/asset/config/php.php
 *
 * @created    2022-11-09  op-skeleton-2020:/config/php.php
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
error_reporting(E_ALL);
ini_set('short_open_tag', 'On' );
ini_set('display_errors', 'Off');
ini_set('log_errors'    , 'Off');

//	...
if( getenv('GITHUB_ACTIONS') === 'true' ){
	ini_set('display_errors', 'On');
}

//	Set time zone
date_default_timezone_set('Asia/Tokyo');

//	If you want to override the above settings, write them in the "_php.php" file.
if( file_exists( $path = __DIR__.'/_php.php' ) ){
	require_once($path);
}
