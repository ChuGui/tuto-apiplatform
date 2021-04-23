<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PostRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ORM\Entity(repositoryClass=PostRepository::class),
 * @ApiResource(
 *     normalizationContext={"groups" = {"read:Post:collection"}},
 *     denormalizationContext={"groups" = {"write:Post"}},
 *     itemOperations={
 *          "get"= {
 *          "normalization_context" = {"groups"= {"read:Post:collection", "read:Post:item", "read:Post"}}
 *       }
 *     },
 *     paginationItemsPerPage=2,
 *     paginationMaximumItemsPerPage=10,
 *     paginationClientItemsPerPage=true,
 * ),
 * @ApiFilter(SearchFilter::class, properties={"title": "partial"})
 */
class Post
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read:Post:collection"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:Post:collection", "write:Post"})
     * @Assert\Length(
     *      min=5,
     *     minMessage="La longueur est trop petite, minimum {{ limit }} caractères"
     * )
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:Post:collection", "write:Post"})
     */
    private $slug;

    /**
     * @ORM\Column(type="text")
     * @Groups({"read:Post:item", "write:Post"})
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"read:Post:item"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="posts", cascade="persist")
     * @Groups({"read:Post:collection", "write:Post"})
     * @Assert\Valid()
     */
    private $category;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }
}
