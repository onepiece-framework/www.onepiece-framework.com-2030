<?php
/**	op-skeleton-2030:/asset/init/function/GitSubmoduleRepository.php
 *
 * Add another repository.
 *
 * <pre>
 * php asset/init/submodules.php local=1 dir=/var/git/ ssh=1 host=arch
 * </pre>
 *
 * @created    2026-01-10
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
require_once(__DIR__.'/Request.php');
require_once(__DIR__.'/Execute.php');
require_once(__DIR__.'/GitInitLocal.php');

/**	Add option repository.
 *
 */
function GitSubmoduleRepository()
{
	//	local repository directory
	static $dir = null;
	if( $dir === null ){
		$dir = Request('dir','~/repo');
		if( $dir[0] === '~' ){
			if( $home = $_SERVER['HOME'] ?? getenv('HOME') ?? null ){
				$dir  = $home.substr($dir, 1);
			}else{
				echo "\n The home directory variable was not found. \n\n";
				exit(__LINE__);
			}
		}
		$dir = rtrim($dir, '/');
	}

	//	Check the URL.
	if(!$url = exec('git remote get-url origin') ){
		return;
	}

	//	Check an args.
	if( Request('local') or Request('ssh') ){
		//	OK
	}else{
		return;
	}

	//	Init
	$url  = trim($url);
	$temp = explode('/', $url);
	$name = array_pop($temp);
	$temp = explode('-', $name);
	$path = implode('/', $temp);

	//	local
	if( Request('local') ){
		//	Generate local path.
		$local = "{$dir}/{$path}";

		//	Check if the local repository exists.
		if( GitInitLocal($local) ){
			//	Add remote and fetch.
			$local = escapeshellarg($local);
			if( Execute("git remote add local {$local}") ){
				Execute("git fetch local");
			}
		}
	}

	//	ssh
	if( Request('ssh') ){
		$host = Request('host',   'repo');
		$dir  = Request('dir' , '~/repo');
		$url  = "{$host}:{$dir}/{$path}";
		$host = escapeshellarg($host);
		$url  = escapeshellarg($url );
		if( Execute("git remote add {$host} {$url}") ){
			Execute("git fetch {$host}");
		}
	}
}
