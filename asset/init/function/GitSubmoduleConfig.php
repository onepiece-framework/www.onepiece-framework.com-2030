<?php
/**	op-skeleton-model:/asset/init/function/GitSubmoduleConfig.php
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

/**	Git submodule foreach.
 *
 * @created    2025-10-29
 * @param      string     $file_name
 * @param      array      $configs
 */
function GitSubmoduleConfig( string $file_name, string $git_root ) : array
{
	//	...
	$config = [];

	//	...
	$save_dir = getcwd();

	//	...
	chdir($git_root);

	//	Get submodule names
	$names = trim(`git config --get-regexp submodule\..*\.active | grep true | sed 's/^submodule\.//;s/\.active true$//'`);

	//	...
	if( $names ){
	foreach( explode("\n", $names) as $name ){
		//	...
		foreach(['url','path','branch','follow'] as $key){
			//	Empty line --> null for NULL coalescing operator: $branch = $configs['core']['branch'] ?? 2030
			$config[$name][$key] = ($var = trim(`git config -f {$file_name} --get submodule.{$name}.{$key}` ?? '')) ? $var: null;
		}

		//	...
		$config[$name]['submodule'] = file_exists( $config[$name]['path'].'/'.$file_name ) ? '1': '0';
	}
	}

	//	...
	chdir($save_dir);

	//	...
	return $config;
}
