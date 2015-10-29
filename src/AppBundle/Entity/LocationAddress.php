<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LocationAddress
 *
 * @ORM\Table(name="location_address")
 * @ORM\Entity
 */
class LocationAddress
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

   /**
     * @ORM\OneToOne(targetEntity="LocationRegion")
     * @ORM\JoinColumn(name="location_region_id", referencedColumnName="id")
     */
    private $locationRegion;

    /**
     * @var string
     *
     * @ORM\Column(name="location_city", type="string", length=255, nullable=true)
     */

    /**
     * @ORM\OneToOne(targetEntity="LocationCity")
     * @ORM\JoinColumn(name="location_city_id", referencedColumnName="id")
     */
    private $locationCity;

    /**
     * @ORM\OneToOne(targetEntity="LocationCountry")
     * @ORM\JoinColumn(name="location_country_id", referencedColumnName="id")
     */
    private $locationCountry;

    /**
     * @ORM\OneToOne(targetEntity="Team", fetch="EAGER", inversedBy="address")
     */
    private $team;
}
