<?php
// create_product.php <name>
require_once "bootstrap.php";

$newProductName = $argv[1];

$product = new \src\Entity\City();
$product->setCityName($newProductName);

$entityManager->persist($product);
$entityManager->flush();

echo "Created City with ID " . $product->getId() . "\n";
