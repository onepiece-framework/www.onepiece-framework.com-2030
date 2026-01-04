<?php
/**	op-skeleton-model:/asset/init/update.php
 *
 * Init and update a non-Git managed submodules.
 *
 * <pre>
 * php asset/init/update.php remote=local pull=0
 * </pre>
 *
 * @created    2026-01-04
 * @license    Apache-2.0
 * @package    op-skeleton
 * @subpackage model
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

//	Define Git root.
if(!defined('_ROOT_GIT_') ){
	define('_ROOT_GIT_', trim(`git rev-parse --show-toplevel`));

	//	Init submodules.
	`git submodule foreach git fetch --all`;
	`git submodule foreach git pull`;
}

//	Get branch number.
if(!defined('_OP_APP_BRANCH_') ){
	(function($git_root){
		include("{$git_root}/asset/config/op.php");
	})(_ROOT_GIT_);
}

//	Include.
require_once(__DIR__.'/function/Display.php');
require_once(__DIR__.'/function/Request.php');
require_once(__DIR__.'/function/GitSubmoduleRepository.php');

//	Get config list.
foreach( glob(_ROOT_GIT_.'/asset/config/submodule/*/*.php') as $glob ){
	//	Change directory.
	chdir(_ROOT_GIT_);

	//	Init variables.
	$temp = explode('/', $glob);
	$file = array_pop($temp);
	$type = array_pop($temp);
	$name = explode('.', $file)[0];

	//	Get each config.
	$config = (function($glob){
		return include($glob);
	})($glob);

	//	Check if skip
	if( $config['skip'] ??  null ){
		continue;
	}

	//	Init
	$init = Init( $type, $name, $config );

	//	Update
	Update( $type, $name, $config, $init );
}

/**	Init
 *
 * @created    2026-01-04
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
	$dir    = _ROOT_GIT_."/asset/{$type}";

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
		return false;
	}

	//	Change URL.
	if( $github = Request('github') ){
		$url = str_replace('onepiece-framework', $github, $url);
	}

	//	Change directory.
	chdir($dir);

	// Display label.
	echo "{$dir}/{$path} --> {$branch} \n";
	echo "{$url} \n";

	//	Clone.
	`git clone {$url} {$path} -b {$branch}`;

	//	Change directory
	chdir($path);

	//	Set hooks path.
	$hooks_path = _ROOT_GIT_.'/asset/init/hooks/';

	//	Git clone
	`git submodule update --init --recursive`;

	//	Set local hooks.
	`git config core.hooksPath {$hooks_path}`;

	//	Set local hooks to submodules.
	`git submodule foreach git config core.hooksPath {$hooks_path}`;

	//	main submodule
	GitSubmoduleRepository();

	//	nested submodules
	if( $paths = `git submodule foreach pwd` ){
		foreach( explode("\n", $paths) as $path ){
			if( file_exists($path) ){
				GitSubmoduleRepository();
			}
		}
	}

	//	return;
	return true;
}

/**	Update
 *
 * @created    2026-01-04
 * @param      string     $type
 * @param      string     $name
 * @param      array      $config
 * @return     bool
 */
function Update( string $type, string $name, array $config, bool $init ) : bool
{
	//	Init
	$dir    = _ROOT_GIT_."/asset/{$type}";
	$path   = $config['path']   ?? $name;
	$remote = $config['remote'] ?? 'origin';
	$branch = $config['branch'] ?? _OP_APP_BRANCH_;

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
		if( Request('pull', '') ){
			`git pull {$remote} {$branch}`;
		}
	}

	//	...
	return true;
}
