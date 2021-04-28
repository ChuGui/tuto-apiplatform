<?php


namespace App\Entity;


use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * Class Dependency
 * @package App\Entity
 * @ApiResource (
 *     itemOperations={"get"},
 *     collectionOperations={"get"},
 *     paginationEnabled=false
 * )
 */
class Dependency
{

    /**
     * @var string
     * @ApiProperty(identifier=true)
     */
    private string $uuid;

    /**
     * @var string
     * @ApiProperty(description="Nom de la dépendance")
     */
    private string $name;

    /**
     * @var string
     * @ApiProperty(
     *     description="Version de la dépendance",
     *     openapiContext={"example" = "5.2.*"}
     * )
     */
    private string $version;

    public function __construct(string $uuid, string $name, string $version)
    {
        $this->uuid = $uuid;
        $this->name = $name;
        $this->version = $version;
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

}
