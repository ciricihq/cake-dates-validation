<?php
namespace Cirici\Validation;

use Cake\Validation\Validation;

class DatesValidation extends Validation
{
    /**
     * Checks if the passed date(time) is a past date
     *
     * @param  mixed $check The date to be checked. Can be either string, array
     *                      or a DateTimeInterface instance.
     * @return bool
     */
    public static function past($check)
    {
        if ($check instanceof \DateTimeInterface) {
            return $check < new \DateTime();
        }

        if (is_array($check)) {
            $check = static::_getDateString($check);
        }

        return strtotime($check) < time();
    }
    /**
     * Checks if the passed date(time) is a past date
     *
     * @param  mixed $check The date to be checked. Can be either string, array
     *                      or a DateTimeInterface instance.
     * @return bool
     */
    public static function future($check)
    {
        if ($check instanceof \DateTimeInterface) {
            return $check > new \DateTime();
        }

        if (is_array($check)) {
            $check = static::_getDateString($check);
        }

        return strtotime($check) > time();
    }
}
