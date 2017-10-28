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

namespace mrcnpdlk\MojePanstwo;


class QueryBuilder
{
    private $query = [];
    /**
     * @var string
     */
    private $sContext;

    private function __construct(string $sContext = null)
    {
        $this->query['conditions'] = [];
        $this->query['page']       = 1;
        $this->query['limit']      = 50;
        $this->setContext($sContext);
    }

    static public function create(string $sContext = null)
    {
        return new QueryBuilder($sContext);
    }


    public function addLayer(string $layerName)
    {
        $this->query['layers'][] = $layerName;

        return $this;
    }

    public function getQuery()
    {
        return http_build_query($this->query);

    }

    public function limit(int $limit = 50)
    {
        $this->query['limit'] = $limit;

        return $this;
    }

    public function orderBy(string $property, string $order = 'asc')
    {
        return $this;
    }

    public function page(int $page = 1)
    {
        $this->query['page'] = $page;

        return $this;
    }

    public function setContext(string $sContext = null)
    {
        $this->sContext = !empty($sContext) ? $sContext : null;

        return $this;
    }

    public function where(string $property, $value)
    {
        if (empty($this->setContext())) {
            $this->query['conditions'][$property] = $value;
        } else {
            $this->query['conditions'][sprintf("%s.%s", $this->sContext, $property)] = $value;
        }


        return $this;
    }
}
