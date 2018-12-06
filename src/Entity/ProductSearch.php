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
  private $category;


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
   * Get product category for filtering
   *
   * @return  int|null
   */ 
  public function getCategory()
  {
    return $this->category;
  }

  /**
   * Set product category for filtering
   *
   * @param  int|null  $category  Product category for filtering
   *
   * @return  self
   */ 
  public function setCategory($category)
  {
    $this->category = $category;

    return $this;
  }
}