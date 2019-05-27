<?php

/*
 * This file is part of the league/commonmark-ext-smartpunct package.
 *
 * (c) Colin O'Dell <colinodell@gmail.com>
 *
 * Original code based on the CommonMark JS reference parser (http://bitly.com/commonmark-js)
 *  - (c) John MacFarlane
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace League\CommonMark\Ext\SmartPunct;

use League\CommonMark\Delimiter\Delimiter;
use League\CommonMark\Delimiter\Processor\DelimiterProcessorInterface;
use League\CommonMark\Inline\Element\AbstractStringContainer;

final class QuoteProcessor implements DelimiterProcessorInterface
{
    /** @var string */
    private $normalizedCharacter;

    /** @var string */
    private $openerCharacter;

    /** @var string */
    private $closerCharacter;

    /**
     * QuoteProcessor constructor.
     *
     * @param string $char
     * @param string $opener
     * @param string $closer
     */
    private function __construct(string $char, string $opener, string $closer)
    {
        $this->normalizedCharacter = $char;
        $this->openerCharacter = $opener;
        $this->closerCharacter = $closer;
    }

    /**
     * {@inheritdoc}
     */
    public function getOpeningCharacter(): string
    {
        return $this->normalizedCharacter;
    }

    /**
     * {@inheritdoc}
     */
    public function getClosingCharacter(): string
    {
        return $this->normalizedCharacter;
    }

    /**
     * {@inheritdoc}
     */
    public function getMinLength(): int
    {
        return 1;
    }

    /**
     * {@inheritdoc}
     */
    public function getDelimiterUse(Delimiter $opener, Delimiter $closer): int
    {
        return 1;
    }

    /**
     * {@inheritdoc}
     */
    public function process(AbstractStringContainer $opener, AbstractStringContainer $closer, int $delimiterUse)
    {
        $opener->insertAfter(new Quote($this->openerCharacter));
        $closer->insertBefore(new Quote($this->closerCharacter));
    }

    /**
     * Create a double-quote processor
     *
     * @return QuoteProcessor
     */
    public static function createDoubleQuoteProcessor(): self
    {
        return new self(Quote::DOUBLE_QUOTE, Quote::DOUBLE_QUOTE_OPENER, Quote::DOUBLE_QUOTE_CLOSER);
    }

    /**
     * Create a single-quote processor
     *
     * @return QuoteProcessor
     */
    public static function createSingleQuoteProcessor(): self
    {
        return new self(Quote::SINGLE_QUOTE, Quote::SINGLE_QUOTE_OPENER, Quote::SINGLE_QUOTE_CLOSER);
    }
}
