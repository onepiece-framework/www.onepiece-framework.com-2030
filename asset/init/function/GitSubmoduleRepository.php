<?php
/**	op-skeleton-model:/asset/init/function/GitSubmoduleRepository.php
 *
 * Add another repository.
 *
 * <pre>
 * php asset/init/submodules.php local=1 dir=/var/git/ ssh=1 host=arch
 * </pre>
 *
 * @created    2026-01-10
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

/**	Include
 *
 */
require_once(__DIR__.'/Request.php');

/**	Add option repository.
 *
 */
function GitSubmoduleRepository()
{
	//	Save current branch.
	$current_branch = trim(`git branch --show-current` ?? '');

	//	Check the URL.
	if(!$url = `git remote get-url origin` ){
		return;
	}

	//	Check an args.
	if( Request('local') or Request('ssh') ){
		//	OK
	}else{
		return;
	}

	//	Init
	$dir  = Request('dir') ?? '~/repo';
	$dir  = rtrim($dir, '/');
	$url  = trim($url);
	$temp = explode('/', $url);
	$name = array_pop($temp);
	$temp = explode('-', $name);
	$path = implode('/', $temp);

	//	local
	if( Request('local') ){
		$url = "{$dir}/{$path}";
		`git remote add local {$url}`;
		`git fetch local`;
	}

	//	ssh
	if( Request('ssh') ){
		$host = Request('host') ?? 'repo';
		$url = "{$host}:{$dir}/{$path}";
		`git remote add {$host} {$url}`;
		`git fetch {$host}`;
	}

	//	Recovery branch.
	if( $current_branch ){
		if( $current_branch !== trim(`git branch --show-current` ?? '') ){
			`git switch {$current_branch}`;
		}
	}
}
