<?php

namespace Chromabits\Standards\Render;

use Chromabits\Nucleus\Exceptions\LackOfCoffeeException;
use Chromabits\Nucleus\Foundation\BaseObject;
use Chromabits\Nucleus\View\Interfaces\RenderableInterface;
use PhpParser\Node\Stmt\Namespace_;

/**
 * Class NamespaceRenderer
 *
 * @author Eduardo Trujillo <ed@chromabits.com>
 * @package Chromabits\Standards\Render
 */
class NamespaceRenderer extends BaseObject implements RenderableInterface
{
    protected $namespace;

    protected $nameRenderer;

    /**
     * @var bool
     */
    protected $single;

    /**
     * Construct an instance of a NamespaceRenderer.
     *
     * @param Namespace_ $namespace
     * @param bool $single
     *
     * @throws LackOfCoffeeException
     */
    public function __construct(Namespace_ $namespace, $single = true)
    {
        parent::__construct();

        $this->namespace = $namespace;
        $this->nameRenderer = new NameRenderer($namespace->name);
        $this->single = $single;
    }

    /**
     * Render the object into a string.
     *
     * @return mixed
     */
    public function render()
    {
        $result = [];

        if ($this->namespace->hasAttribute('comments')) {
            foreach ($this->namespace->getAttributes()['comments'] as $comment) {
                $result[] = $comment->getText();
                $result[] = '';
            }
        }

        if ($this->single) {
            $result[] = 'namespace ' . (new NameRenderer($this->namespace->name))->render() . ';';
        } else {
            $result[] = 'namespace ' . (new NameRenderer($this->namespace->name))->render();
            $result[] = '{';
            $result[] = '}';
        }

        return $result;
    }
}