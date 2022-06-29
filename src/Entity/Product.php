<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $Name;

    #[ORM\Column(type: 'string', length: 255)]
    private $Type;

    #[ORM\Column(type: 'string', length: 255)]
    private $Image;

    #[ORM\Column(type: 'float')]
    private $Price;

    #[ORM\ManyToOne(targetEntity: OrderDetail::class, inversedBy: 'product')]
    private $orderdetail;

    #[ORM\ManyToOne(targetEntity: CartDetail::class, inversedBy: 'product')]
    private $cartdetail;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(string $Type): self
    {
        $this->Type = $Type;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->Image;
    }

    public function setImage(string $Image): self
    {
        $this->Image = $Image;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->Price;
    }

    public function setPrice(float $Price): self
    {
        $this->Price = $Price;

        return $this;
    }

    public function getOrderdetail(): ?orderdetail
    {
        return $this->orderdetail;
    }

    public function setOrderdetail(?orderdetail $orderdetail): self
    {
        $this->orderdetail = $orderdetail;

        return $this;
    }

    public function getCartdetail(): ?cartdetail
    {
        return $this->cartdetail;
    }

    public function setCartdetail(?cartdetail $cartdetail): self
    {
        $this->cartdetail = $cartdetail;

        return $this;
    }
}
