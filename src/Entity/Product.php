<?php

namespace App\Entity;

use App\Entity\Picture;
use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 * @UniqueEntity(fields="name", message="Un produit possède déjà ce nom")
 * @ORM\HasLifecycleCallbacks
 */
class Product
{
    const TYPE = [
        0 => 'Bague',
        1 => 'Boucle',
        2 => 'Ustensile',
        3 => 'Bouton',
        4 => 'Autre'
    ];

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=3, max=100, minMessage="Le nom du produit doit faire au minimum 3 caractères", maxMessage="Le nom du produit doit faire au maximum 100 caractères ")
     * @Assert\NotBlank(message="Le nom ne peut être vide")
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $type;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank(message="le prix doit être renseigné")
     * @Assert\Range(min=1, max=9999, minMessage="Le prix doit être supérieur à 1€", maxMessage="Le prix doit être inférieur à 9999€")
     */
    private $price;

    /**
     * @ORM\Column(type="boolean")
     */
    private $inStock;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Picture", mappedBy="product", orphanRemoval=true, cascade={"persist"})
     */
    private $pictures;

    /**
     * @var mixed
     * @Assert\All({
     *  @Assert\Image(mimeTypes="image/jpeg", mimeTypesMessage="Les images doivent être au format jpeg")
     * })
     */
    private $pictureFiles;

    public function __construct()
    {
        $this->pictures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getProductType(): string
    {
        return self::TYPE[$this->type];
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function getFormattedPrice(): string
    {
        return number_format($this->price, 2, ',', ' ');
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getInStock(): ?bool
    {
        return $this->inStock;
    }

    public function setInStock(bool $inStock): self
    {
        $this->inStock = $inStock;

        return $this;
    }

    public function getIsInStock(): string
    {
        return $this->inStock ? 'En stock' : 'Produit épuisé';
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


    /**
     * Initialize slug base on the product's name - Using Slugify
     * @ORM\PrePersist
     * @ORM\PreUpdate
     * @return void
     */
    public function initializeSlug()
    {
        if(empty($this->slug)) {
            $this->slug = (new Slugify())->slugify($this->name);
        }
    }

    /**
     * @return Collection|Picture[]
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    /**
     * Get the first picture of a product for display
     *
     * @return Picture|null
     */
    public function getPicture(): ?Picture
    {
        if ($this->pictures->isEmpty()) {
            return null;
        }

        return $this->pictures->first();
    }

    public function addPicture(Picture $picture): self
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures[] = $picture;
            $picture->setProduct($this);
        }

        return $this;
    }

    public function removePicture(Picture $picture): self
    {
        if ($this->pictures->contains($picture)) {
            $this->pictures->removeElement($picture);
            // set the owning side to null (unless already changed)
            if ($picture->getProduct() === $this) {
                $picture->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return  mixed
     */ 
    public function getPictureFiles()
    {
        return $this->pictureFiles;
    }

    /**
     * @param  mixed $pictureFiles
     *
     * @return  self
     */ 
    public function setPictureFiles($pictureFiles)
    {
        foreach($pictureFiles as $pictureFile) {
            $picture = new Picture();
            $picture->setImageFile($pictureFile);
            $this->addPicture($picture);
        }
        $this->pictureFiles = $pictureFiles;

        return $this;
    }
}
