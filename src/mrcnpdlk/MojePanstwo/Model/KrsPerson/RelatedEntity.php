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

/**
 * Created by Marcin.
 * Date: 02.12.2017
 * Time: 23:19
 */

namespace mrcnpdlk\MojePanstwo\Model\KrsPerson;


use mrcnpdlk\MojePanstwo\Api;
use Sunra\PhpSimple\HtmlDomParser;

class RelatedEntity
{
    /**
     * @var string
     */
    public $opis;
    /**
     * ID podmiotu KRS
     *
     * @var int
     */
    public $podmiot_id;
    /**
     * @var null|\mrcnpdlk\MojePanstwo\Model\KrsEntity
     */
    public $podmiot;

    /**
     * RelatedEntity constructor.
     *
     * @param string $str
     *
     * @throws \mrcnpdlk\MojePanstwo\Exception
     */
    public function __construct(string $str)
    {
        $this->opis = strip_tags($str);
        try {
            $aElem = HtmlDomParser::str_get_html($str)->getElementByTagName('a');
            if ($aElem) {
                $sHref = $aElem->getAttribute('href');
                $id    = (int)str_replace('/dane/krs_podmioty/', '', $sHref);
                if ($id > 0) {
                    $this->podmiot_id = $id;
                } else {
                    throw new \RuntimeException('KRS id not found in href');
                }
            }
        } catch (\Exception $e) {
            $this->podmiot_id = null;
            Api::getInstance()
               ->getClient()
               ->getLogger()
               ->warning(sprintf('Related entity [%s] Error: %s', $str, $e->getMessage()))
            ;
        }
    }
}
