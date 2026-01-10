<?php
/**	op-skeleton-model:/asset/init/function/Execute.php
 *
 * @created    2025-10-28
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

/**	Execute command.
 *
 * @created    2024-10-08
 * @param      string     $comand
 * @return     bool
 */
function Execute( string $comand ) : bool
{
	/* @var $output array */
	/* @var $status int   */
	exec("{$comand} 2>&1", $output, $status);

	//	...
	if( $status ){
		echo "\n ERROR: {$comand}\n\n";
		echo join("\n", $output) . PHP_EOL . PHP_EOL;
	}

	//	...
	return empty($status) ? true: false;
}
