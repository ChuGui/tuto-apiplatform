<?php


namespace App\Entity;


use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Dependency
 * @package App\Entity
 * @ApiResource (
 *     itemOperations={
 *          "get",
 *          "delete"
 *      },
 *     collectionOperations={
 *          "get",
 *          "post" = {
 *              "denormalization_context"={
 *                  "groups"={"put:Dependency"}
 *              }
 *          },
 *     },
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
     * @Assert\Length(min=2)
     * @Assert\NotBlank()
     * @Groups({"put:Dependency"})
     */
    private string $name;

    /**
     * @var string
     * @Assert\Length(min=2)
     * @Assert\NotBlank()
     * @ApiProperty(
     *     description="Version de la dépendance",
     *     openapiContext={"example" = "5.2.*"}
     * )
     * @Groups({"put:Dependency"})
     */
    private string $version;

    public function __construct(string $name, string $version)
    {
        $this->uuid = Uuid::uuid5(Uuid::NAMESPACE_URL, $name)->toString();
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

    /**
     * @param string $version
     */
    public function setVersion(string $version): void
    {
        $this->version = $version;
    }

}
