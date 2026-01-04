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
declare(strict_types=0);

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

			//	...
			$tmp = explode('=', $argv);

			//	...
			$tmp[0] = escapeshellcmd($tmp[0]);
			$tmp[1] = escapeshellcmd($tmp[1]);

			//	...
			$_request[$tmp[0]] = $tmp[1];
		}
	}

	//	...
	return (isset($_request[$key]) and strlen($_request[$key])) ? $_request[$key] : $default;
}
