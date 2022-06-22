<?php

namespace App\Entity;

use App\Repository\CartDetailRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CartDetailRepository::class)]
class CartDetail
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $Quantity;

    #[ORM\Column(type: 'float')]
    private $Price;

    #[ORM\OneToMany(mappedBy: 'cartdetail', targetEntity: Product::class)]
    private $CartDetail;

    public function __construct()
    {
        $this->CartDetail = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->Quantity;
    }

    public function setQuantity(int $Quantity): self
    {
        $this->Quantity = $Quantity;

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

    /**
     * @return Collection<int, Product>
     */
    public function getCartDetail(): Collection
    {
        return $this->CartDetail;
    }

    public function addCartDetail(Product $cartDetail): self
    {
        if (!$this->CartDetail->contains($cartDetail)) {
            $this->CartDetail[] = $cartDetail;
            $cartDetail->setCartdetail($this);
        }

        return $this;
    }

    public function removeCartDetail(Product $cartDetail): self
    {
        if ($this->CartDetail->removeElement($cartDetail)) {
            // set the owning side to null (unless already changed)
            if ($cartDetail->getCartdetail() === $this) {
                $cartDetail->setCartdetail(null);
            }
        }

        return $this;
    }
}
