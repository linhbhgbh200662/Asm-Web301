<?php

namespace App\Entity;

use App\Repository\OrderDetailRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderDetailRepository::class)]
class OrderDetail
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $Quantity;

    #[ORM\Column(type: 'float')]
    private $UnitPrice;

    #[ORM\OneToMany(mappedBy: 'orderdetail', targetEntity: Product::class)]
    private $OrderDetail;

    public function __construct()
    {
        $this->OrderDetail = new ArrayCollection();
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

    public function getUnitPrice(): ?float
    {
        return $this->UnitPrice;
    }

    public function setUnitPrice(float $UnitPrice): self
    {
        $this->UnitPrice = $UnitPrice;

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getOrderDetail(): Collection
    {
        return $this->OrderDetail;
    }

    public function addOrderDetail(Product $orderDetail): self
    {
        if (!$this->OrderDetail->contains($orderDetail)) {
            $this->OrderDetail[] = $orderDetail;
            $orderDetail->setOrderdetail($this);
        }

        return $this;
    }

    public function removeOrderDetail(Product $orderDetail): self
    {
        if ($this->OrderDetail->removeElement($orderDetail)) {
            // set the owning side to null (unless already changed)
            if ($orderDetail->getOrderdetail() === $this) {
                $orderDetail->setOrderdetail(null);
            }
        }

        return $this;
    }
}
