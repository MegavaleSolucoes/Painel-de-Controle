<?php
//Constantes
$configs = new HXPHP\System\Configs\Config;

$configs->title = 'Megavale Soluções - Painel';

$configs->env->add('development');

$configs->env->development->baseURI = '/http_painel/';

  $configs->env->development->database->setConnectionData([
  'host' => 'localhost',
  'user' => 'root',
  'password' => '',
  'dbname' => 'controllpainel',
  'charset' => 'utf8'
  ]);



return $configs;