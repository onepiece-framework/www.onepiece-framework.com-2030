<?php
/**	op-skeleton-2030:/asset/init/function/GitInitLocal.php
 *
 * @created    2026-04-04
 * @license    Apache-2.0
 * @package    op-skeleton-2030
 * @copyright  Tomoaki Nagahara
 */

/**	Declare strict type
 *
 */
declare(strict_types=1);

/**	Namespace
 *
 */
namespace OP\SKELETON\INIT;

/**	Include
 *
 */
require_once(__DIR__.'/Display.php');
require_once(__DIR__.'/Execute.php');

/**	Create a local bare repository if it does not exist.
 *
 * @created    2026-04-04
 */
function GitInitLocal( string $path ) : bool
{
	//	...
	if(!file_exists($path) ){
		if(!mkdir($path, recursive:true) ){
			Display("mkdir failed: {$path}");
			return false;
		}
	}

	//	...
	if(!is_dir($path) ){
		Display("This path is not a directory: {$path}");
		return false;
	}

	//	...
	if(	file_exists($path.'/HEAD') ){
		return true;
	}

	//	...
	$save_dir = getcwd();

	//	...
	if(!chdir($path) ){
		Display("Failed to change directory: {$path}");
		return false;
	}

	//	...
	$io = Execute('git init --bare');

	//	...
	if(!chdir($save_dir) ){
		Display("Failed to change directory: {$save_dir}");
		exit(__LINE__);
	}

	//	...
	return $io;
}
