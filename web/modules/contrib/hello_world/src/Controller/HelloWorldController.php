<?php

namespace Drupal\hello_world\Controller;

use Drupal\Core\Controller\ControllerBase;

//to use the HelloWorldSalutation service
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\RemoveCommand;
use Drupal\Core\Session\AccountInterface;
use Drupal\hello_world\HelloWorldSalutation;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


/**
 * Controller for the salutation message.
*/

class HelloWorldController extends ControllerBase {
    //start stuff to pull in the HelloWorldSalutation service
    /**
    * @var \Drupal\hello_world\HelloWorldSalutation
    */
    protected $salutation;

    /**
     * {@inheritdoc}
     */
    public static function create(ContainerInterface $container) {
        return new static(
        $container->get('hello_world.salutation')
        );
    }

    /**
     * HelloWorldController constructor.
     *
     * @param \Drupal\hello_world\HelloWorldSalutation $salutation
     */
    public function __construct(HelloWorldSalutation $salutation) {
        $this->salutation = $salutation;
    }


    //End of service stuff

    /**
     * Hello World.
    */
    public function helloWorld() {
//        debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
        return [
            '#markup' => $this->salutation->getSalutation(),
        ];
        /*
        $builder = \Drupal::formBuilder();
        $form = $builder->getForm('Drupal\hello_world\Form\SalutationConfigurationForm');
        return $form;
        */
    }
}