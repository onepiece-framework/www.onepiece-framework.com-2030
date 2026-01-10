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
	//	...
	if(!$url = `git remote get-url origin` ){
		return;
	}
	$url  = trim($url);
	$temp = explode('/', $url);
	$name = array_pop($temp);
	$temp = explode('-', $name);
	$path = implode('/', $temp);

	//	local
	if( Request('local') ){
		$dir = Request('dir') ?? '~/repo';
		$dir = rtrim($dir, '/');
		$url = "{$dir}/{$path}";
		`git remote add local {$url}`;
		`git fetch local`;

		//	ssh
		if( Request('ssh') ){
			$host = Request('host') ?? 'repo';
			$url = "{$host}:{$dir}/{$path}";
			`git remote add {$host} {$url}`;
			`git fetch {$host}`;
		}
	}
}
