<?php

namespace EgitimBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ogrenciler
 *
 * @ORM\Table(name="ogrenci")
 * @ORM\Entity
 */
class Ogrenciler
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="ad", type="string", length=255)
     */
    private $ad;

    /**
     * @var string
     *
     * @ORM\Column(name="soyad", type="string", length=255)
     */
    private $soyad;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set ad
     *
     * @param string $ad
     * @return Ogrenciler
     */
    public function setAd($ad)
    {
        $this->ad = $ad;

        return $this;
    }

    /**
     * Get ad
     *
     * @return string 
     */
    public function getAd()
    {
        return $this->ad;
    }

    /**
     * Set soyad
     *
     * @param string $soyad
     * @return Ogrenciler
     */
    public function setSoyad($soyad)
    {
        $this->soyad = $soyad;

        return $this;
    }

    /**
     * Get soyad
     *
     * @return string 
     */
    public function getSoyad()
    {
        return $this->soyad;
    }
}
