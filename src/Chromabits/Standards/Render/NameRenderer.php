<?php

namespace Chromabits\Standards\Render;

use Chromabits\Nucleus\Exceptions\CoreException;
use Chromabits\Nucleus\Foundation\BaseObject;
use Chromabits\Nucleus\View\Interfaces\RenderableInterface;
use PhpParser\Node\Name;
use PhpParser\Node\Name\FullyQualified;
use PhpParser\Node\Name\Relative;

/**
 * Class NameRenderer
 *
 * @author Eduardo Trujillo <ed@chromabits.com>
 * @package Chromabits\Standards\Render
 */
class NameRenderer extends BaseObject implements RenderableInterface
{
    /**
     * @var Name|FullyQualified|Relative
     */
    private $name;

    /**
     * Construct an instance of a NameRenderer.
     *
     * @param $name
     */
    public function __construct($name)
    {
        parent::__construct();

        $this->name = $name;
    }

    /**
     * Render the object into a string.
     *
     * @return mixed
     * @throws CoreException
     */
    public function render()
    {
        if ($this->name instanceof Name) {
            return implode('\\', $this->name->parts);
        } elseif ($this->name instanceof FullyQualified) {
            return '\\' . implode('\\', $this->name->parts);
        } elseif ($this->name instanceof Relative) {
            return 'namespace\\' . implode('\\', $this->name->parts);
        }

        throw new CoreException();
    }
}