<?php
namespace SLIMAPI\Controller;

use Slim\Container;
use Slim\Views\Twig as TwigViews;

/**
 * Class AbstractController
 * @package SLIMAPI\Controller
 */
abstract class AbstractController
{
    /** @var TwigViews view */
    protected $view;

    /**
     * AbstractController constructor.
     * @param Container $c
     */
    public function __construct(Container $c)
    {
        $this->view = $c->get('view');
    }

    /**
     * Validate and format keys and values for insertion to the DB
     *
     */
    protected function prepareInsert($values, $validKeys)
    {
        $result = ['keys' => [], 'values' => []];
        foreach($values as $key => $value) {
            if (in_array($key, $validKeys)) {
                $result['keys'][] = $key;
                $result['values'][] = $value;
            }
        }
        return $result;
    }

    /**
     * Validate and format keys and values for updating DB
     *
     */
    protected function prepareUpdate($values, $validKeys)
    {
        foreach($values as $key => $value) {
            if (!in_array($key, $validKeys)) {
                unset($values[$key]);
            }
        }
        return $values;
    }
}
