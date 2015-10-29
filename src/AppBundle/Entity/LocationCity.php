<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LocationCity
 *
 * @ORM\Table(name="location_city")
 * @ORM\Entity
 */
class LocationCity
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
     * @var integer
     *
     * @ORM\Column(name="location_country_id", type="integer", nullable=true)
     */
    private $locationCountryId;

    /**
     * @var integer
     *
     * @ORM\Column(name="location_region_id", type="integer", nullable=true)
     */
    private $locationRegionId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;


}
