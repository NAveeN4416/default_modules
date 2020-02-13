<?PHP defined('BASEPATH') OR exit('No direct script access allowed');

$route['authentication/(:any)'] = 'acp/authentication/$1';
$route['datatable/(:any)'] = 'acp/datatable/$1';

$route['export/(:any)'] = 'acp/export/$1';
$route['export/(:any)/(:num)'] = 'acp/export/$1/$2';

$route['acp_company/(:any)'] = 'acp/company/$1';
$route['acp_company/(:any)/(:num)'] = 'acp/company/$1/$2';
$route['acp_company/(:any)/(:num)/(:num)'] = 'acp/company/$1/$2/$3';

$route['acp/reservations/(:any)'] = 'reservations/$1';
$route['acp/reservations/(:any)/(:num)'] = 'reservations/$1/$2';
$route['acp/reservations/(:any)/(:num)/(:num)'] = 'reservations/$1/$2/$3';

$route['acp/join_as_partners'] = 'acp/clients/join_as_partners';
$route['acp/view_partner/(:any)'] = 'acp/clients/view_partner/$1';

$route['acp']    = 'acp/index';
$route['acp/partners']    = 'acp/clients/listall';
$route['ar/acp'] = 'acp/index/ar';
$route['en/acp'] = 'acp/index/en';
$route['ar/acp/login'] = 'acp/login';
$route['en/acp/login'] = 'acp/login';
