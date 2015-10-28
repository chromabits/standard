<?php

namespace Chromabits\Standards\Render;

class RenderContext
{
    protected $indent = '    ';

    protected $indentLevel = 0;

    public function cloneAndLevel()
    {
        $clone = clone $this;

        $clone->increaseIndentLevel();

        return $clone;
    }

    /**
     * @return int
     */
    public function getIndentLevel()
    {
        return $this->indentLevel;
    }

    /**
     * @param int $indentLevel
     */
    public function setIndentLevel($indentLevel)
    {
        $this->indentLevel = $indentLevel;
    }

    public function increaseIndentLevel()
    {
        $this->indentLevel++;
    }
}