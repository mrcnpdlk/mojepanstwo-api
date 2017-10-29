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
 * Class SearchResponse
 *
 * @package mrcnpdlk\MojePanstwo\Model
 */
class SearchResponse
{
    /**
     * Liczba wszystkich obiektów pasujących do zapytania, kolejne strony można zwracać zmieniając parametr page
     *
     * @var integer
     */
    public $count;
    /**
     * Długość trwania zapytania w milisekundach
     *
     * @var integer
     */
    public $took;
    /**
     * @var \mrcnpdlk\MojePanstwo\Model\SearchResponseLinks
     */
    public $links;
    /**
     * @var \mrcnpdlk\MojePanstwo\Model\SearchResponseItem[]
     */
    public $items;

    /**
     * SearchResponse constructor.
     *
     * @param                                                 $count
     * @param                                                 $took
     * @param \mrcnpdlk\MojePanstwo\Model\SearchResponseLinks $links
     */
    public function __construct($count, $took, SearchResponseLinks $links, $items = [])
    {
        $this->count = intval($count);
        $this->took  = intval($took);
        $this->links = $links;
        $this->items = $items;
    }
}
