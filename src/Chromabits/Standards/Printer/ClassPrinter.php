<?php

namespace Chromabits\Standards\Printer;

use Chromabits\Nucleus\Support\Arr;
use Chromabits\Nucleus\Support\Std;
use Chromabits\Standards\Render\NameRenderer;
use PhpParser\Node\Name;
use PhpParser\Node\Stmt\Namespace_;

/**
 * Class ClassicPrinter
 *
 * @author Eduardo Trujillo <ed@chromabits.com>
 * @package Chromabits\Standards\Printer
 */
class ClassPrinter
{
    public function go(array $statements)
    {
        $lines = ['<?php', ''];

        $lines = Std::concat($lines, $this->renderNamespaces($statements));

        return implode("\n", $lines);
    }

    public function renderNamespaces(array $statements)
    {
        $namespaces = Std::filter(function ($node) {
            return $node instanceof Namespace_;
        }, $statements);
        $count = count($namespaces);

        if ($count === 0) {
            return ['// No namespaces found.'];
        } elseif ($count === 1) {
            return $this->renderNamespace($namespaces[0]);
        }

        $result = [];
        $current = 1;

        foreach ($result as $namespace) {
            $result[] = $this->renderNamespace($namespace, false);

            if ($current < $count) {
                $result[] = [''];
            }

            $count++;
        }

        return $result;
    }

    public function renderNamespace(Namespace_ $namespace, $single = true)
    {
        $result = [];

        if ($namespace->hasAttribute('comments')) {
            foreach ($namespace->getAttributes()['comments'] as $comment) {
                $result[] = $comment->getText();
                $result[] = '';
            }
        }

        if ($single) {
            $result[] = 'namespace ' . (new NameRenderer($namespace->name))->render() . ';';
        } else {
            $result[] = 'namespace ' . (new NameRenderer($namespace->name))->render();
            $result[] = '{';
            $result[] = '}';
        }

        return $result;
    }

    public function printUseBlock()
    {

    }
}