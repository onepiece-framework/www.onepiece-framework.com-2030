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
require_once(__DIR__.'/GitSubmoduleGithub.php');
require_once(__DIR__.'/GitSubmoduleConfig.php');
require_once(__DIR__.'/GitSubmoduleRepository.php');
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

	//	Change the github owner name.
	GitSubmoduleGithub();

	//	Set hooks path.
	$hooks_path = _ROOT_GIT_.'/asset/init/hooks/';

	//	Download nested submodules.
	`git submodule update --init`;

	//	Main repository.
	`git config core.hooksPath {$hooks_path}`;

	//	Get git submodule config.
	$configs = GitSubmoduleConfig('.gitmodules', $git_root);

	//	Switch branch.
	foreach( $configs as $config ){
		//	...
		$path   = $config['path'];
		$remote = $config['remote'] ?? 'origin';
		$branch = $config['branch'] ?? _OP_APP_BRANCH_;

		//	...
		chdir("$git_root/$path");
		echo getcwd() ." --> {$branch}". PHP_EOL;

		//	Add local repository.
		GitSubmoduleRepository();

		//	...
		GitCheckoutTargetBranch( $remote, $branch );

		//	Each submodule.
		`git config core.hooksPath {$hooks_path}`;

		//	...
		if( file_exists('.gitmodules') ){
			GitSubmoduleForeach("$git_root/$path");
		}
	}

	//	Recovery current directory.
	chdir($save_dir);
}
