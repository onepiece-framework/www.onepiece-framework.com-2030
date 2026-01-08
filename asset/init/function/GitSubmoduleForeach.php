<?php
/**	op-skeleton-model:/asset/init/function/GitSubmoduleForeach.php
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

//	Include function files.
require_once(__DIR__.'/Request.php');
require_once(__DIR__.'/GitSubmoduleConfig.php');
require_once(__DIR__.'/GitCheckoutTargetBranch.php');

/**	Git submodule foreach.
 *
 * @created    2025-07-03
 * @param      string     $git_root
 */
function GitSubmoduleForeach( string $git_root )
{
	//	Save current directory.
	$save_dir = getcwd();

	//	Change the owner name on GitHub.
	if( $github = Request('github') ){
		`bash {$git_root}/asset/init/github.sh {$github}`;
		`git submodule sync`;
		`git submodule foreach git fetch`;
	}

	//	Get git submodule config.
	$configs = GitSubmoduleConfig('.gitmodules', $git_root);

	//	...
	$hooks_path = "{$git_root}/asset/init/hooks/";

	//	Switch branch.
	foreach( $configs as $config ){
		//	...
		$path   = $config['path'];
		$remote = $config['remote'] ?? 'origin';
		$branch = $config['branch'] ?? _OP_APP_BRANCH_;

		//	...
		chdir("$git_root/$path");
		echo getcwd() ." --> {$branch}". PHP_EOL;

		//	...
		GitCheckoutTargetBranch( $remote, $branch );

		//	...
		`git config core.hooksPath {$hooks_path}`;

		//	...
		if( $config['submodule'] ?? null ){
			GitSubmoduleForeach("$git_root/$path");
		}
	}

	//	Recovery current directory.
	chdir($save_dir);
}
