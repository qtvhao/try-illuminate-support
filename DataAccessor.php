<?php
use Illuminate\Support\Collection;

/**
 * Created by PhpStorm.
 * User: qtvha
 * Date: 3/9/2017
 * Time: 7:56 PM
 */
class DataAccessor
{
    /**
     * @var mixed
     */
    public $target;

    public static function make(&$data)
    {
        return new static($data);
    }

    public function __construct(&$target)
    {
        $this->target = &$target;
    }

	private static function data_set(&$target, $key, $value, $overwrite = true)
	{
		$segments = is_array($key) ? $key : explode('.', $key);
		if (($segment = array_shift($segments)) === '*') {
			if (! static::accessible($target)) {
				$target = [];
			}
			if ($segments) {
				foreach ($target as &$inner) {
					static::data_set($inner, $segments, $value, $overwrite);
				}
			} elseif ($overwrite) {
				foreach ($target as &$inner) {
					$inner = self::value( $value, $inner, $segment );
				}
			}
		} elseif (static::accessible($target)) {
			if ($segments) {
				if (! static::exists($target, $segment)) {
					$target[$segment] = [];
				}
				static::data_set($target[$segment], $segments, $value, $overwrite);
			} elseif ($overwrite || ! static::exists($target, $segment)) {
				$target[$segment] = self::value( $value, $target[$segment], $segment );
			}
		} elseif (is_object($target)) {
			if ($segments) {
				if (! isset($target->{$segment})) {
					$target->{$segment} = [];
				}
				static::data_set($target->{$segment}, $segments, $value, $overwrite);
			} elseif ($overwrite || ! isset($target->{$segment})) {
				$target->{$segment} = self::value( $value, $target->{$segment}, $segment );
			}
		} else {
			$target = [];
			if ($segments) {
				static::data_set($target[$segment], $segments, $value, $overwrite);
			} elseif ($overwrite) {
				$target[$segment] = self::value( $value, $target->{$segment}, $segment  );
			}
		}
		return $target;
	}

	private static function data_fill(&$target, $key, $value)
	{
		return static::data_set($target, $key, $value, false);
	}

	private static function explodePluckParameters($value, $key)
	{
		$value = is_string($value) ? explode('.', $value) : $value;
		$key = is_null($key) || is_array($key) ? $key : explode('.', $key);
		return [$value, $key];
	}

	private static function exists($array, $key)
	{
		if ($array instanceof ArrayAccess) {
			return $array->offsetExists($key);
		}
		return array_key_exists($key, $array);
	}

	private static function accessible( $value ) {
		return is_array($value) || $value instanceof ArrayAccess;
	}

	private static function collapse($array)
	{
		$results = [];
		foreach ($array as $values) {
			if ($values instanceof \Illuminate\Support\Collection) {
				$values = $values->all();
			} elseif (! is_array($values)) {
				continue;
			}
			$results = array_merge($results, $values);
		}
		return $results;
	}


	private static function value($value)
	{
		if ( $value instanceof Closure ) {
			if ( func_num_args() === 2 ) {
				return $value(func_get_arg( 1 ));
			} elseif(func_num_args() === 3){
				return $value( func_get_arg( 1 ), func_get_arg( 2 ));
			} else {
				return $value();
			}
		} else {
			return $value;
		}
	}

	public function get($key, $default = null)
    {
        return $this->data_get($this->target, $key, $default);
    }

    public function set($key, $value)
    {
        return static::data_set($this->target,$key,$value);
    }

    public function fill($key, $value)
    {
        return static::data_fill($this->target,$key,$value);
    }

    public function collect($key, $default = [])
    {
	    if ( function_exists( 'collect') ) {
		    return collect( $this->get( $key, $default ) );
	    }
	    throw new Exception();
    }

    public function dd($key = null)
    {
        if(is_null($key)){
            if($this->target instanceof \Illuminate\Contracts\Support\Arrayable){
                dd($this->target->toArray());
            }
            dd($this->target);
        }
        dd($this->get($key));
    }

	private static function data_get($target, $key, $default = null)
	{
		if (is_null($key)) {
			return $target;
		}
		$key = is_array($key) ? $key : explode('.', $key);
		while (! is_null($segment = array_shift($key))) {
			if ($segment === '*') {
				if ($target instanceof Collection) {
					$target = $target->all();
				} elseif (! is_array($target)) {
					return static::value($default);
				}
				$result = static::pluck($target, $key);
				return in_array('*', $key) ? static::collapse($result) : $result;
			}
			if (static::accessible($target) && static::exists($target, $segment)) {
				$target = $target[$segment];
			} elseif (is_object($target) && isset($target->{$segment})) {
				$target = $target->{$segment};
			} else {
				return static::value($default);
			}
		}
		return $target;
	}
	public static function pluck($array, $value, $key = null)
	{
		$results = [];
		list($value, $key) = static::explodePluckParameters($value, $key);
		foreach ($array as $item) {
			$itemValue = static::data_get($item, $value);
			// If the key is "null", we will just append the value to the array and keep
			// looping. Otherwise we will key the array using the value of the key we
			// received from the developer. Then we'll return the final array form.
			if (is_null($key)) {
				$results[] = $itemValue;
			} else {
				$itemKey = static::data_get($item, $key);
				if (is_object($itemKey) && method_exists($itemKey, '__toString')) {
					$itemKey = (string) $itemKey;
				}
				$results[$itemKey] = $itemValue;
			}
		}
		return $results;
	}

	public function serialize() {
		return serialize($this->target);
	}
}
