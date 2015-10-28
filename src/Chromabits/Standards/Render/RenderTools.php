<?php

namespace Chromabits\Standards\Render;

use Chromabits\Nucleus\Support\Std;
use Chromabits\Nucleus\View\Interfaces\RenderableInterface;

/**
 * Class RenderTools
 *
 * @author Eduardo Trujillo <ed@chromabits.com>
 * @package Chromabits\Standards\Render
 */
class RenderTools
{
    public static function renderAndImplode(array $parts, $glue = '')
    {
        return implode($glue, Std::map(function ($part) {
            if ($part instanceof RenderableInterface) {
                return $part->render();
            }

            return (string) $part;
        }, $parts));
    }
}