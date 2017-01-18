<?php

namespace Lrt\Entity;

/**
 * @Entity(readOnly=true)
 * @Entity(repositoryClass="Lrt\Repository\DataItemRepository")
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
     * @Column(type="text", name="from_host")
     */
    private $fromHost;

    /**
     * @Column(type="decimal", precision=10, scale=4, name="bldom")
     */
    private $bLDom;

    public function __construct(
        $anchorText,
        $linkStatus,
        $fromUrl,
        $fromHost,
        $bLDom
    ) {
        $this->anchorText = $anchorText;
        $this->linkStatus = $linkStatus;
        $this->fromUrl = $fromUrl;
        $this->fromHost = $fromHost;
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
    public function getFromHost()
    {
        return $this->fromHost;
    }

    /**
     * @param mixed $fromHost
     */
    public function setFromHost($fromHost)
    {
        $this->fromHost = $fromHost;
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
