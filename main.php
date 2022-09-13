<?php
abstract class Animal
{
    private static $countId = 0;
    private $id;

    function __construct()
    {
        $this->id = self::$countId;
        self::$countId++;
    }

    /**
     * Get the animal id.
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get the quantity of products from the animal.
     *
     * @return int
     */
    public abstract function getProduct(): int;
}

class Cow extends Animal
{
    public function getProduct(): int
    {
        return rand(8, 12);
    }
}

class Chicken extends Animal
{
    public function getProduct(): int
    {
        return rand(0, 1);
    }
}

class Farm
{
    /**
     * The array of farm animals.
     *
     * @var array
     */
    private $animals = [];

    /**
     * The array of products.
     *
     * @var array
     */
    private $products = [];

    /**
     * The array of animals counters.
     *
     * @var array
     */
    private $countAnimals = [];

    /**
     * Get the number of each type of animal.
     *
     * @return array
     */
    public function getCountAnimals(): array
    {
        return $this->countAnimals;
    }

    /**
     * Add an animal to the farm.
     *
     * @return void
     */
    public function addAnimal($animal)
    {
        $this->animals[] = $animal;
        if (!array_key_exists(get_class($animal), $this->products)) {
            $this->products[get_class($animal)] = 0;
        }
        if (!array_key_exists(get_class($animal), $this->countAnimals)) {
            $this->countAnimals[get_class($animal)] = 1;
        }
        else {
            $this->countAnimals[get_class($animal)] += 1;
        }
    }

    /**
     * Collect products from all animals.
     *
     * @return void
     */
    public function collectProducts()
    {
        foreach ($this->animals as $animal) {
            $this->products[get_class($animal)] += $animal->getProduct();
        }
    }

    /**
     * Get products from all animals.
     *
     * @return array
     */
    public function getProducts(): array
    {
        return $this->products;
    }
}


$farm = new Farm();

//добавление 10 коров и 20 кур
for ($i = 0; $i < 10; $i++) {
    $farm->addAnimal(new Cow());
}
for ($i = 0; $i < 20; $i++) {
    $farm->addAnimal(new Chicken());
}

//вывод кол-ва животных на ферме
$countAnimals = $farm->getCountAnimals();
foreach ($countAnimals as $key => $countAnimal) {
    echo 'Кол-во животных вида "' . $key . '" равно ' . $countAnimal . '<br>';
}

//сбор продукции 7 раз
for ($i = 0; $i < 7; $i++) {
    $farm->collectProducts();
}

//вывод кол-во продукции
$products = $farm->getProducts();
foreach ($products as $key => $product) {
    echo 'Общее кол-во собранной продукции у животного "' . $key . '" равно ' . $product . '<br>';
}

//добавление 1 коровы и 5 кур
$farm->addAnimal(new Cow());
for ($i = 0; $i < 5; $i++) {
    $farm->addAnimal(new Chicken());
}

//вывод кол-ва животных на ферме
$countAnimals = $farm->getCountAnimals();
foreach ($countAnimals as $key => $countAnimal) {
    echo 'Кол-во животных вида "' . $key . '" равно ' . $countAnimal . '<br>';
}

//сбор продукции 7 раз
for ($i = 0; $i < 7; $i++) {
    $farm->collectProducts();
}

//вывод на экран кол-во продукции
$products = $farm->getProducts();
foreach ($products as $key => $product) {
    echo 'Общее кол-во собранной продукции у животного "' . $key . '" равно ' . $product . '<br>';
}
