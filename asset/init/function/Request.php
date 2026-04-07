<?php
/**	op-skeleton-model:/asset/init/function/Request.php
 *
 * @created    2025-10-30
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

/**	Request
 *
 * <pre>
 * //  Get CLI argument.
 * $value = Request('key');
 *
 * //  If not set.
 * $value = Request('key') ?? 'default value';
 *
 * //  Is set but empty string.
 * $value = Request('key','In case of empty string') ?? 'In case of null';
 * </pre>
 *
 * @created    2025-07-10
 * @param      string     $key
 * @param      string     $default
 * @return     string     $value
 */
function Request( string $key, ?string $default=null ) : ?string
{
	//	...
	static $_request = null;

	//	...
	if( $_request === null ){
		//	...
		foreach( ($_SERVER['argv'] ?? []) as $argv ){
			//	...
			if(!strpos($argv, '=')){
				continue;
			}

			//	2 is key=a=b
			$tmp = explode('=', $argv, 2);

			//	...
			if(!preg_match('/^[a-zA-Z0-9_-]+$/', $tmp[0])){
				continue;
			}

			//	Allow path-like CLI values such as /var/git, ~/repo
			if(!preg_match('/^[-_a-zA-Z0-9\.\/~]+$/', $tmp[1])){
				continue;
			}

			//	...
			$_request[$tmp[0]] = $tmp[1];
		}
	}

	//	...
	return (isset($_request[$key]) and strlen($_request[$key])) ? $_request[$key] : $default;
}
