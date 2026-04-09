<?php
/**	op-skeleton-2030:/asset/init/function/Init.php
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

/**	Init OP managed Git repositories.
 *
 * @created    2026-01-04 op-skeleton-2030:/asset/init/update.php
 * @moved      2026-04-07 op-skeleton-2030:/asset/init/function/Init.php
 * @param      string     $type
 * @param      string     $name
 * @param      array      $config
 * @return     bool
 */
function Init( string $type, string $name, array $config ) : bool
{
	//	Init variables.
	$url    = $config['url']    ??  null;
	$path   = $config['path']   ?? $name;
	$branch = $config['branch'] ?? _OP_APP_BRANCH_;
//	"_OP_APP_BRANCH_" is an int, which can cause a type error in escapeshellarg().
//	$branch = (string)$branch;

	//	Get dir of path.
	$dir = Dir($type);

	//	Create directory.
	if(!file_exists($dir) ){
		if(!mkdir($dir) ){
			Display("mkdir is failed: {$dir}");
			return false;
		}
	}

	//	Check if already exists.
	if( file_exists("{$dir}/{$path}") ){
		return false;
	}

	//	Check if URL.
	if(!$url){
		echo "\nURL is empty: {$type}, {$name} \n\n";
		return false;
	}

	//	Escape
	$url    = escapeshellarg($url);
	$path   = escapeshellarg($path);
	$branch = escapeshellarg($branch);

	//	Change URL.
	if( $github = Request('github') ){
		//	Add original remote after git clone.
		$onepie = $url;

		//	Replace remote URL: https://github.com/onepiece-framework/op-core.git --> https://github.com/{$github}/op-core.git
		$url = str_replace('onepiece-framework', $github, $url);
	}

	//	Change directory.
	chdir($dir);

	// Display label.
	echo "{$dir}/{$path} --> {$branch} \n";
	echo "{$url} \n";

	//	Clone.
	/* @var $output array */
	/* @var $status int   */
	if( $depth = Request('depth') ){
		//	This feature for only CI.
		$depth = "--depth='1'";
	}else{
		$depth = null;
	}

	//	Execute git clone.
	$comand = "git clone {$depth} {$url} {$path} -b {$branch}";
	exec("{$comand} 2>&1", $output, $status);
	if( $status ){
		echo "Command: {$comand}\n";
		echo "Error code: {$status}\n";
		echo join("\n", $output).PHP_EOL;
		exit(__LINE__);
	}

	//	Change directory
	if(!chdir( $config['path'] ?? $name ) ){
		exit(__LINE__);
	}

	//	Add original remote.
	if( $onepie ?? null ){
		exec("git remote add onepie {$onepie}");
	}

	//	Set hooks path.
	GitHooks();

	//	Change the github owner name.
	GitSubmoduleGithub();

	//	Each submodule.
	GitSubmoduleRepository();

	//	Nested submodules.
	if( $paths = `git submodule foreach pwd` ){
		foreach( explode("\n", $paths) as $path ){
			$path = trim($path);
			if(!file_exists($path) ){ continue; }
			if(!chdir($path)){
				echo "ERROR: {$path}\n";
				continue;
			}

			//	Add another remote.
			GitSubmoduleRepository();

			//	detached --> _OP_APP_BRANCH_
			if(!trim(`git branch --show-current` ?? '')){
				foreach( explode("\n", `git branch`) as $branch ){
					$branch = trim($branch);
					if( $branch == _OP_APP_BRANCH_ ){
						exec('git switch '._OP_APP_BRANCH_);
						continue 2;
					}
				}
				exec('git checkout origin/'._OP_APP_BRANCH_.' -b '._OP_APP_BRANCH_);
			};
		}
	}

	//	return;
	return true;
}
