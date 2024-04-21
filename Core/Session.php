<?php

namespace Core;

class Session 
{
	const flash_key = '__flash__';

	public static function get($key, $default = null)
	{
		return $_SESSION[static::flash_key][$key] ?? $_SESSION[$key] ?? $default;	
	}

	public static function put($key, $value)
	{
		$_SESSION[$key]	= $value;
	}

	public static function flash($key, $value)
	{
		$_SESSION[static::flash_key][$key]	= $value;
	}

	public static function unflash()
	{
		unset($_SESSION[static::flash_key]);
	}

	public static function flush()
	{
		$_SESSION = [];	
	}

	public static function destroy()
	{
		static::flush();
        session_destroy();

        $params = session_get_cookie_params();
        setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain']);
	}
}