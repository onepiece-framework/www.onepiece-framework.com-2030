<?php
/**	op-skeleton-2030:/index.php
 *
 * @genesis    2019-02-18  op-app-skeleton
 * @rebirth    2025-06-08  op-skeleton-2030
 * @license    Apache-2.0
 * @package    op-skeleton-2030
 * @copyright  Tomoaki Nagahara
 */

/**	Declare strict
 *
 */
declare(strict_types=1);

/**	Namespace
 *
 */
namespace OP;

 /**************************************************/
//  The `.htaccess` file has not been initialized. //
if( defined('_OP_APP_START_') === false ){
	include('app.php');
	exit();
}
// Don't remove this logic. It's there to help you //
/**************************************************/

/**	Get URL arguments.
 *
 * @var array $args
 */
$args = OP()->Unit()->Router()->Args();

/**	Determines which page to display.
 *
 * @var string $file
 */
$file = count($args) ? '404.php'   : 'welcome.phtml';

/**	Load template file.
 *
 */
OP()->Template($file);
