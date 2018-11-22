<?php

namespace App\Entity;

class ProductSearch
{
  /**
   * Max price for product filtering
   *
   * @var int|null
   * 
   */
  private $maxPrice;

  /**
   * Product type for filtering
   *
   * @var int|null
   */
  private $productType;


  /**
   * Get max price for product filtering
   *
   * @return  int|null
   */ 
  public function getMaxPrice()
  {
    return $this->maxPrice;
  }

  /**
   * Set max price for product filtering
   *
   * @param  int|null  $maxPrice  Max price for product filtering
   *
   * @return  self
   */ 
  public function setMaxPrice($maxPrice)
  {
    $this->maxPrice = $maxPrice;

    return $this;
  }

  /**
   * Get product type for filtering
   *
   * @return  int|null
   */ 
  public function getProductType()
  {
    return $this->productType;
  }

  /**
   * Set product type for filtering
   *
   * @param  int|null  $productType  Product type for filtering
   *
   * @return  self
   */ 
  public function setProductType($productType)
  {
    $this->productType = $productType;

    return $this;
  }
}