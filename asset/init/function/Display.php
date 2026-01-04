<?php
/**	op-skeleton-model:/asset/init/function/Display.php
 *
 * @created    2025-10-30
 * @license    Apache-2.0
 * @package    op-skeleton
 * @subpackage model
 * @copyright  Tomoaki Nagahara
 */

/**	Declare strict type
 *
 */
declare(strict_types=0);

/**	Namespace
 *
 */
namespace OP\SKELETON\INIT;

/**	Display message.
 *
 * @created    2025-07-10
 * @param      string     $message
 */
function Display( string $message)
{
	//	...
	if(!Request('display', '1') ){
		return;
	}

	//	...
	echo $message . PHP_EOL;
}
