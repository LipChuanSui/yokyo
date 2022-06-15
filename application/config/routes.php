<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['posts/create'] = 'posts/create';
$route['posts/update'] = 'posts/update';
$route['posts/sports'] = 'posts/sports';
$route['posts'] = 'posts/index';
$route['posts/(:any)'] = 'posts/view/$1';

$route['timetable'] = 'timetable/index';
$route['timetable/create'] = 'timetable/create';
//$route['timetable/(:any)'] = 'timetable/sports/$1';
$route['emails'] = 'emails/index';

$route['default_controller'] = 'pages/view';
$route['(:any)'] = 'pages/view/$1';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
