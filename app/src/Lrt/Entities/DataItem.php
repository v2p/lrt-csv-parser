<?php

namespace Lrt\Entities;

/**
 * @Entity(readOnly=true)
 * @Table(name="data_item")
 */
class DataItem
{
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    private $id;

    /**
     * @Column(type="text", name="anchor_text")
     */
    private $anchorText;

    /**
     * @Column(type="string", name="link_status")
     */
    private $linkStatus;

    /**
     * @Column(type="text", name="from_url")
     */
    private $fromUrl;

    /**
     * @Column(type="decimal", precision=10, scale=4, name="bldom")
     */
    private $bLDom;

    public function __construct(
        $anchorText,
        $linkStatus,
        $fromUrl,
        $bLDom
    ) {
        $this->anchorText = $anchorText;
        $this->linkStatus = $linkStatus;
        $this->fromUrl = $fromUrl;
        $this->bLDom = $bLDom;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getAnchorText()
    {
        return $this->anchorText;
    }

    /**
     * @param mixed $anchorText
     */
    public function setAnchorText($anchorText)
    {
        $this->anchorText = $anchorText;
    }

    /**
     * @return mixed
     */
    public function getLinkStatus()
    {
        return $this->linkStatus;
    }

    /**
     * @param mixed $linkStatus
     */
    public function setLinkStatus($linkStatus)
    {
        $this->linkStatus = $linkStatus;
    }

    /**
     * @return mixed
     */
    public function getFromUrl()
    {
        return $this->fromUrl;
    }

    /**
     * @param mixed $fromUrl
     */
    public function setFromUrl($fromUrl)
    {
        $this->fromUrl = $fromUrl;
    }

    /**
     * @return mixed
     */
    public function getBLDom()
    {
        return $this->bLDom;
    }

    /**
     * @param mixed $bLDom
     */
    public function setBLDom($bLDom)
    {
        $this->bLDom = $bLDom;
    }
}
