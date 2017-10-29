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

namespace mrcnpdlk\MojePanstwo;


use mrcnpdlk\MojePanstwo\Model\ModelAbstract;
use mrcnpdlk\MojePanstwo\Model\SearchResponse;
use mrcnpdlk\MojePanstwo\Model\SearchResponseItem;
use mrcnpdlk\MojePanstwo\Model\SearchResponseLinks;

class QueryBuilder
{
    /**
     * @var array
     */
    private $query = [];
    /**
     * @var string
     */
    private $sContext;
    /**
     * @var string|null
     */
    private $sReturnedClass;

    /**
     * QueryBuilder constructor.
     *
     * @param string|null $returnedClass
     *
     * @throws \mrcnpdlk\MojePanstwo\Exception
     */
    private function __construct(string $returnedClass = null)
    {
        if (!class_exists($returnedClass)) {
            throw new Exception(sprintf('Cannot create QueryBuilder instance. Class [%s] not defined', $returnedClass));
        }
        $reflectionA = new \ReflectionClass($returnedClass);
        if (!$reflectionA->isSubclassOf(ModelAbstract::class)) {
            throw new Exception(sprintf('Cannot create QueryBuilder instance. Class [%s] not extend ModelAbstract', $returnedClass));
        }

        $this->query['conditions'] = [];
        $this->query['page']       = 1;
        $this->query['limit']      = 50;
        $this->sReturnedClass      = $returnedClass;
        $this->setContext($returnedClass ? $returnedClass::CONTEXT : null);
    }

    /**
     * @param string|null $returnedClass
     *
     * @return \mrcnpdlk\MojePanstwo\QueryBuilder
     */
    static public function create(string $returnedClass = null)
    {
        return new QueryBuilder($returnedClass);
    }

    /**
     * @param string $layerName
     *
     * @return $this
     */
    public function addLayer(string $layerName)
    {
        $this->query['layers'][] = $layerName;

        return $this;
    }

    /**
     * Find object having ID
     *
     * @param string $id
     *
     * @return mixed
     */
    public function find(string $id)
    {
        $res = Api::getInstance()
                  ->getClient()
                  ->request($this->sContext, $id, $this)
        ;

        return new $this->sReturnedClass($res->data ?? null, $res->layers ?? null);
    }

    /**
     * Search result
     *
     * @return SearchResponse
     */
    public function get()
    {

        $res    = Api::getInstance()
                     ->getClient()
                     ->request($this->sContext, null, $this)
        ;
        $oLinks = new SearchResponseLinks(
            $res->Links->self ?? null,
            $res->Links->first ?? $res->Links->self ?? null,
            $res->Links->next ?? null,
            $res->Links->last ?? null);
        $items  = [];
        foreach ($res->Dataobject as $i) {
            $oItem             = new SearchResponseItem();
            $oItem->id         = intval($i->id);
            $oItem->dataset    = $i->dataset;
            $oItem->url        = $i->url;
            $oItem->mp_url     = $i->mp_url;
            $oItem->schema_url = $i->schema_url;
            $oItem->global_id  = intval($i->global_id);
            $oItem->slug       = $i->slug;
            $oItem->score      = $i->score;
            $oItem->data       = new $this->sReturnedClass($i->data ?? null);
            $items[]           = $oItem;
        }
        $oResp = new SearchResponse($res->Count, $res->Took, $oLinks, $items);

        return $oResp;
    }

    /**
     * @return string
     */
    public function getQuery()
    {
        return http_build_query($this->query);

    }

    /**
     * @param int $limit
     *
     * @return $this
     */
    public function limit(int $limit = 50)
    {
        $this->query['limit'] = $limit;

        return $this;
    }

    /**
     * @param string $property
     * @param string $order
     *
     * @return $this
     * @todo Zaimplementowac
     */
    public function orderBy(string $property, string $order = 'asc')
    {
        return $this;
    }

    /**
     * @param int $page
     *
     * @return $this
     */
    public function page(int $page = 1)
    {
        $this->query['page'] = $page;

        return $this;
    }

    /**
     * @param string|null $sContext
     *
     * @return $this
     */
    private function setContext(string $sContext = null)
    {
        $this->sContext = !empty($sContext) ? $sContext : null;

        return $this;
    }

    /**
     * @param string $property
     * @param        $value
     *
     * @return $this
     */
    public function where(string $property, $value)
    {
        if (empty($this->sContext)) {
            $this->query['conditions'][$property] = $value;
        } else {
            $this->query['conditions'][sprintf("%s.%s", $this->sContext, $property)] = $value;
        }

        return $this;
    }

}
