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


use mrcnpdlk\MojePanstwo\Model\KrsPerson\RelatedEntity;

class KrsPerson extends ModelAbstract
{
    const CONTEXT = 'krs_osoby';

    /**
     * ID osoby z KRS
     *
     * @var integer
     **/
    public $id;
    /**
     * krs
     *
     * @var string
     **/
    public $imie_pierwsze;
    /**
     * @var string
     */
    public $imie_drugie;
    /**
     * @var string
     */
    public $imiona;
    /**
     * @var string
     */
    public $nazwisko;
    /**
     * @var string
     */
    public $plec;
    /**
     * @var string
     */
    public $data_urodzenia;
    /**
     * @var integer
     */
    public $liczba_zalozyciele;
    /**
     * @var integer
     */
    public $liczba_reprezentanci;
    /**
     * @var integer
     */
    public $liczba_nadzorcow;
    /**
     * @var integer
     */
    public $liczba_wspolnicy;
    /**
     * @var integer
     */
    public $liczba_akcjonariusze;
    /**
     * @var int[]
     */
    public $gmina_id;
    /**
     * @var string
     */
    public $str;
    /**
     * @var \mrcnpdlk\MojePanstwo\Model\KrsPerson\RelatedEntity[]
     */
    public $podmioty;
    /**
     * @var string
     */
    public $privacy;


    /**
     * KrsPerson constructor.
     *
     * @param \stdClass|null $oData
     * @param \stdClass|null $oLayers
     *
     * @throws \mrcnpdlk\MojePanstwo\Exception
     */
    public function __construct(\stdClass $oData = null, \stdClass $oLayers = null)
    {
        parent::__construct($oData);
        if ($oData) {
            $this->id             = $this->convertToId($this->id);
            $this->data_urodzenia = $this->data_urodzenia ? (new \DateTime($this->data_urodzenia))->format('Y-m-d') : null;
            foreach ((array)$oData->{'krs_osoby.gmina_id'} as $id) {
                $this->gmina_id[] = (int)$id;
            }
            $tPodmioty = explode('<br/>', $this->str);
            foreach ($tPodmioty as $desc) {
                $this->podmioty[] = new RelatedEntity($desc);
            }

        }
    }
}
