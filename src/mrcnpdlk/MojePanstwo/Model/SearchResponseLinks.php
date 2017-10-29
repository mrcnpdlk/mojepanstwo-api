<?php
/**
 * MOJEPANSTWO-API
 *
 * Copyright © 2017 pudelek.org.pl
 *
 * @license MIT License (MIT)
 *
 * For the full copyright and license information, please view source file
 * that is bundled with this package in the file LICENSE
 *
 * @author  Marcin Pudełek <marcin@pudelek.org.pl>
 */

declare (strict_types=1);

namespace mrcnpdlk\MojePanstwo\Model;

/**
 * Class SearchResponseLinks
 *
 * @package mrcnpdlk\MojePanstwo\Model
 */
class SearchResponseLinks
{
    /**
     * Link do bieżacej strony wyników
     *
     * @var string
     */
    public $self;
    /**
     * Link do poprzedniej strony wyników
     *
     * @var string
     */
    public $prev;
    /**
     * Link do pierwszej strony wyników
     *
     * @var string
     */
    public $first;
    /**
     * Link do następnej strony wyników
     *
     * @var string
     */
    public $next;
    /**
     * Link do ostatniej strony wyników
     *
     * @var string
     */
    public $last;

    /**
     * SearchResponseLinks constructor.
     *
     * @param string|null $self
     * @param string|null $first
     * @param string|null $next
     * @param string|null $last
     */
    public function __construct(string $self = null, string $first = null, string $next = null, string $last = null, string $prev = null)
    {
        $this->self  = $self;
        $this->first = $first;
        $this->next  = $next;
        $this->last  = $last;
        $this->prev  = $prev;
    }
}
