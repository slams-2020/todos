<?php

return array(
  '#namespace' => 'controllers',
  '#uses' => array (
  'HtmlMessage' => 'Ajax\\semantic\\html\\collections\\HtmlMessage',
  'Router' => 'Ubiquity\\controllers\\Router',
  'DAO' => 'Ubiquity\\orm\\DAO',
  'URequest' => 'Ubiquity\\utils\\http\\URequest',
  'TodoItem' => 'models\\TodoItem',
  'TodoDAOLoader' => 'services\\TodoDAOLoader',
),
  '#traitMethodOverrides' => array (
  'controllers\\TodoController' => 
  array (
  ),
),
  'controllers\\TodoController' => array(
    array('#name' => 'property', '#type' => 'mindplay\\annotations\\standard\\PropertyAnnotation', 'type' => '\\Ajax\\php\\ubiquity\\JsUtils', 'name' => 'jquery')
  ),
  'controllers\\TodoController::$loader' => array(
    array('#name' => 'autowired', '#type' => 'Ubiquity\\annotations\\di\\AutowiredAnnotation'),
    array('#name' => 'var', '#type' => 'mindplay\\annotations\\standard\\VarAnnotation', 'type' => 'TodoDAOLoader')
  ),
  'controllers\\TodoController::setLoader' => array(
    array('#name' => 'param', '#type' => 'mindplay\\annotations\\standard\\ParamAnnotation', 'type' => '\\services\\TodoSessionLoader', 'name' => 'loader')
  ),
  'controllers\\TodoController::delete' => array(
    array('#name' => 'param', '#type' => 'mindplay\\annotations\\standard\\ParamAnnotation', 'type' => 'string', 'name' => 'id'),
    array('#name' => 'get', '#type' => 'Ubiquity\\annotations\\router\\GetAnnotation', 'delete/{id}')
  ),
  'controllers\\TodoController::index' => array(
    array('#name' => 'route', '#type' => 'Ubiquity\\annotations\\router\\RouteAnnotation', '_default')
  ),
  'controllers\\TodoController::add' => array(
    array('#name' => 'get', '#type' => 'Ubiquity\\annotations\\router\\GetAnnotation', "add")
  ),
  'controllers\\TodoController::submit' => array(
    array('#name' => 'post', '#type' => 'Ubiquity\\annotations\\router\\PostAnnotation', "add")
  ),
  'controllers\\TodoController::clear' => array(
    array('#name' => 'get', '#type' => 'Ubiquity\\annotations\\router\\GetAnnotation', "clear")
  ),
  'controllers\\TodoController::testDb' => array(
    array('#name' => 'route', '#type' => 'Ubiquity\\annotations\\router\\RouteAnnotation', "test/db")
  ),
  'controllers\\TodoController::update' => array(
    array('#name' => 'get', '#type' => 'Ubiquity\\annotations\\router\\GetAnnotation', "update/{id}","name"=>"todo.update"),
    array('#name' => 'param', '#type' => 'mindplay\\annotations\\standard\\ParamAnnotation', 'type' => 'string', 'name' => 'id')
  ),
);

