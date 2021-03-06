<?php

namespace Planck\Theme\PlanckBoard\View\Layout;


use Planck\Application\Application;
use Planck\Extension\FrontVendor\Package\Bootstrap;
use Planck\Extension\FrontVendor\Package\FontAwesome;
use Planck\Extension\FrontVendor\Package\Planck;

class Main extends \Planck\View\Layout
{


    public function __construct(Application $application = null)
    {
        parent::__construct($application);




        $html = $this->obInclude(__DIR__.'/template.php');
        $this->setHTML($html, true);
    }


    public function compile()
    {




        $userExtension = $this->application->getExtension(\Planck\Extension\User::class);
        $navbar = new \Planck\Theme\PlanckBoard\View\Component\Navbar();
        $this->registerComponent($navbar, '#layout-top');


        $division = new \Planck\Theme\PlanckBoard\View\Component\HorizontalDivision();

        $this->registerComponent(
            $division,
            '#sidebar-wrapper'
        );


        $logoutURL = $this->application->getExtension($userExtension->getName())->buildURL(
            'Account', 'Api', 'logout'
        );


        $articleURL = $this->application->getExtension(\Planck\Extension\Content::class)->buildURL(
            'Article', 'Main', 'list'
        );

        $imageURL = $this->application->getExtension(\Planck\Extension\Content::class)->buildURL(
            'Image', 'Main', 'list'
        );

        $statusURL = $this->application->getExtension(\Planck\Extension\Content::class)->buildURL(
            'Status', 'Main', 'index'
        );




        $this->getComponent('#sidebar-wrapper')->find('.top')->html(
            '<div><ul>'.
            '<li><a href="'.$logoutURL.'">Déconnexion</a></li>'.
            '<li><a href="'.$articleURL.'">Articles</a></li>'.
            '<li><a href="'.$imageURL.'">Images</a></li>'.
            '<li><a href="'.$statusURL.'">Status</a></li>'.

            '<li><a href="?/tags">Tags</a></li>'.
            '</ul></div>'
        );

        $adminArticleURL = '?/@extension/planck-extension-entity_editor/entity/main[manage]&entity=Planck\Extension\Content\Model\Entity\Article';
        $this->getComponent('#sidebar-wrapper')->find('.bottom')->html(
            '<div><ul>'.
                '<li><a href="'.$adminArticleURL.'">Admin article</a></li>'.
            '</ul></div>'
        );



        $this->setMainContent($this->application->getOutput());



        parent::compile();
    }

    public function render()
    {
        return parent::render(); // TODO: Change the autogenerated stub
    }



}

