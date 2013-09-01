<?php
namespace Perga\ProductBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\Request;

class MenuBuilder
{
    private $factory;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createMainMenu(Request $request)
    {
        $menu = $this->factory->createItem('root');

        $menu->addChild('Главная', array('uri' => '/'));
        $menu->addChild('Продукция', array('uri' => '/products'));
        $menu->addChild('Контакты', array('uri' => '/contact'));
        // ... add more children

        return $menu;
    }
}