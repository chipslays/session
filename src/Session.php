<?php 

namespace Session;

class Session 
{
    /**
     * @var $_SESSION
     */
    private static $session;

    /**
     * Session options.
     * @see https://www.php.net/manual/ru/session.configuration.php
     */
    private static $options = [
        'name'          => 'PHPSESSID',
        'cookie_lifetime' => 86400, // seconds
    ];

    /**
     * Start session
     *
     * @param array $options Array of options (see above)
     * @return void
     */
    public static function start($options = [])
    {
        session_start(array_merge(self::$options, $options));
        self::$session = &$_SESSION;
    }

    /**
     * Set value to session
     *
     * @param mixed $key
     * @param mixed $value
     * @return void
     */
    public static function set($key, $value = null)
    {
        self::$session[$key] = $value;
    }

    /**
     * Get value from session by specific key
     *
     * @param mixed $key
     * @param mixed $default Default value if key not exists
     * @return mixed
     */
    public static function get($key, $default = null)
    {
        return self::has($key) ? self::$session[$key] : $default;
    }

    /**
     * Get value by specific key and remove this key from session
     *
     * @param mixed $key
     * @return mixed
     */
    public static function pull($key)
    {
        $value = self::get($key);
        self::remove($key);
        return $value;
    }

    /**
     * Check if a specific key exists
     *
     * @param mixed $key
     * @return boolean
     */
    public static function has($key)
    {
        return array_key_exists($key, self::$session);
    }

    /**
     * Remove specific key
     *
     * @param mixed $key
     * @return void
     */
    public static function remove($key)
    {
        unset(self::$session[$key]);
    }

    /**
     * Clear session
     *
     * @return void
     */
    public static function clear()
    {
        session_unset();
        session_destroy();
    }

    /**
     * Get and/or set the current session id
     *
     * @param string|null $id
     * @return string|false
     */
    public static function id($id = null)
    {
        return session_id($id);
    }

    /**
     * Update the current session id with a newly generated one
     *
     * @param boolean $deleteOldSession
     * @return void
     */
    public static function regenerate($deleteOldSession = false)
    {
        session_regenerate_id($deleteOldSession);
    }
}