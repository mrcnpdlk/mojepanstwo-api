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
class SearchResponseItem
{
    /**
     * @var string
     */
    public $id;
    /**
     * @var string
     */
    public $dataset;
    /**
     * @var string
     */
    public $url;
    /**
     * @var string
     */
    public $mp_url;
    /**
     * @var string
     */
    public $schema_url;
    /**
     * @var string
     */
    public $global_id;
    /**
     * @var string
     */
    public $slug;
    /**
     * @var mixed
     */
    public $score;
    /**
     * @var \stdClass
     */
    public $data;
}
