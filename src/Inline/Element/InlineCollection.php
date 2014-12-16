<?php

/*
 * This file is part of the league/commonmark package.
 *
 * (c) Colin O'Dell <colinodell@gmail.com>
 *
 * Original code based on stmd.js
 *  - (c) John MacFarlane
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace League\CommonMark\Inline\Element;

use League\CommonMark\Util\ArrayCollection;

class InlineCollection extends AbstractBaseInline
{
    /**
     * @var ArrayCollection|AbstractBaseInline[]
     */
    private $inlines;

    public function __construct($inlines)
    {
        $this->inlines = $inlines;
    }

    /**
     * @return ArrayCollection|AbstractBaseInline[]
     */
    public function getInlines()
    {
        return $this->inlines;
    }
}