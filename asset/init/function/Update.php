<?php
/**	op-skeleton-2030:/asset/init/function/Update.php
 *
 * @created    2026-04-07
 * @license    Apache-2.0
 * @package    op-skeleton-2030
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

/**	Update OP managed Git repositories.
 *
 * @created    2026-01-04 op-skeleton-2030:/asset/init/update.php
 * @created    2026-04-07 op-skeleton-2030:/asset/init/function/Update.php
 * @param      string     $type
 * @param      string     $name
 * @param      array      $config
 * @return     bool
 */
function Update( string $type, string $name, array $config, bool $init ) : bool
{
	//	Init
	$dir    = Dir($type);
	$path   = $config['path']   ?? $name;
	$remote = $config['remote'] ?? 'origin';
	$branch = $config['branch'] ?? _OP_APP_BRANCH_;
//	"_OP_APP_BRANCH_" is an int, which can cause a type error in escapeshellarg().
//	$branch = (string)$branch;

	//	Escape
	$remote = escapeshellarg($remote);
	$branch = escapeshellarg($branch);

	//	Check direcory exists.
	if(!file_exists("{$dir}/{$path}") ){
		return true;
	}

	//	Change directory.
	chdir("{$dir}/{$path}");

	//	Check flag
	if( $init ){

	}else{
		//	Args
		$target = Request('remote', '--all');

		//	Fetch
		`git fetch {$target}`;

		//	Pull
		if( Request('pull', '1') ){
			`git pull --rebase {$remote} {$branch}`;
		}

		//	Submodule
		if( file_exists('.gitmodules') ){
			$save_dir = getcwd();
			foreach( GitSubmoduleConfig('.gitmodules', getcwd()) as $config ){
				//	Check if exists.
				if( empty($config['path']) ){
					continue;
				}
				//	Change directory.
				chdir($config['path']);
				//	Fetch and pull.
				if( Execute("git fetch {$target}") ){
					Execute("git pull {$remote} {$branch}");
				}
				chdir($save_dir);
			}
			chdir($save_dir);
		}
	}

	//	...
	return true;
}
