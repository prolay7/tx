<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "home";
$route['404_override'] = 'my404';
$route['page/(:any)'] = 'page/index';
$route['page/contact-us'] = 'page/contactus';
$route['page/contact'] = 'page/contact';
$route['document_viewer/(:num)'] = 'page/viewer1/$1';

/*admin*/
$route['admin'] = 'admin/index';
$route['admin/signup'] = 'admin/signup';
$route['admin/create_member'] = 'admin/create_member';
$route['admin/login'] = 'admin/index';
$route['admin/logout'] = 'admin/logout';
$route['admin/login/validate_credentials'] = 'admin/validate_credentials';
$route['admin/dashboard'] = 'dashboard/index';
$route['admin/profit'] = 'admin_profit/index';
$route['admin/profit/(:any)'] = 'admin_profit/index/$1';
$route['admin/profit/reset'] = 'admin_profit/resetsearch';

/*
$route['admin/messages'] ='admin_messages/index';
$route['admin/messages/(:any)'] ='admin_messages/index/$1';
$route['adminjobmessages/(:any)'] ='admin_messages/messages/$1';
$route['adminjobmessages/(:any)/(:any)'] ='admin_messages/messages/$1/$1';
*/

//$route['admin/blog_add'] = 'admin/blog_add';
$route['admin/jobpost'] = 'admin_jobpost/index';
$route['admin/jobpost/add'] = 'admin_jobpost/add';
$route['admin/jobpost/document/viewer/(:num)/(:any)'] = 'admin_jobpost/viewer/$1/$2';

$route['admin/pendingjobpost'] = 'admin_jobpost/pending';
$route['admin/pendingjobpost/(:any)'] = 'admin_jobpost/pending/$1';

$route['admin_jobpost/pendingEditApproval/(:any)'] = 'admin_jobpost/pendingEditApproval/$1';
$route['admin_jobpost/postPendingApproval/(:any)'] = 'admin_jobpost/postPendingApproval/$1';
$route['admin_jobpost/get/job-price'] = 'admin_jobpost/get_job_price';

$route['admin_review/review/joblist'] = 'admin_review/joblist';
$route['admin_review/review/joblist/(:num)'] = 'admin_review/joblist/$1';

$route['admin_review/joblist'] = 'admin_review/index';
$route['admin_review/joblist/(:any)'] = 'admin_review/index/$1';
$route['admin_review/showReviewDetails/(:any)'] = 'admin_review/showReviewDetails/$1';
$route['admin_review/completed'] = 'admin_review/completed';
$route['admin_review/add'] = 'admin_review/add_review_job';
$route['admin_review/viewsummary'] = 'admin_review/viewsummary';
$route['admin_review/get/translator'] = 'admin_review/get_translator';
$route['admin_review/get/review-job'] = 'admin_review/get_review_job_details';
$route['admin_review/delete/(:num)'] = 'admin_review/delete/$1';

$route['jobpost/check/line-number'] = 'admin_jobpost/check_line_numbers';
$route['cs_admin/check/line-number'] = 'cs_admin/check_line_numbers';
$route['admin_review/check/line-number'] = 'admin_review/check_line_numbers';
$route['admin_review/get/job-price'] = 'admin_review/get_job_price';
$route['admin/review/document/viewer/(:num)/(:any)'] = 'admin_review/viewer';
$route['cs_admin/viewer/(:num)/(:any)'] = 'cs_admin/viewer/$1/$2';
$route['admin/document/viewer/(:any)'] = 'admin/document_viewer/$1';

// $route['admin_jobpost/proofreadjoblist/(:any)'] = 'admin_jobpost/proofreadjoblist/$1';

$route['admin/joblist'] = 'admin_jobpost/index';
$route['admin/joblist/(:any)'] = 'admin_jobpost/index/$1';

$route['admin/hiringjob'] = 'admin_hiringjob/index';
$route['admin/hiringjob/(:num)'] = 'admin_hiringjob/index/$1';

$route['bidjob/(:any)'] = 'admin_jobpost/bid_job/$1';
$route['bidjob/(:any)/(:any)'] = 'admin_jobpost/bid_job/$1/$1';


$route['admin/jobupdate/(:num)'] = 'admin_jobpost/jobupdate/$1';
$route['admin/jobcupdate/(:num)'] = 'admin_jobpost/jobcupdate/$1';

$route['admin/awardupdate/(:num)/(:num)'] = 'admin_jobpost/awardupdate/$1/$1';
$route['admin/awardcupdate/(:num)/(:num)'] = 'admin_jobpost/awardcupdate/$1/$1';
$route['admin/cancelupdate/(:num)/(:num)'] = 'admin_jobpost/cancelupdate/$1/$1';
$route['admin/cancelcupdate/(:num)/(:num)'] = 'admin_jobpost/cancelcupdate/$1/$1';
$route['admin/awardjob'] = 'admin_awardjob/index';
$route['admin/awardjob/(:num)'] = 'admin_awardjob/index/$1';
$route['admin/awardcomplete/(:num)/(:num)'] = 'admin_awardjob/awardcomplete/$1/$1';
$route['admin/awarduncomplete/(:num)/(:num)'] = 'admin_awardjob/awarduncomplete/$1/$1';
$route['admin/complete/(:num)/(:num)'] = 'admin_awardjob/complete/$1/$1';
$route['admin/uncomplete/(:num)/(:num)'] = 'admin_awardjob/uncomplete/$1/$1';

$route['admin/invoice'] = 'admin_invoice/index';
$route['admin/invoice/(:num)'] = 'admin_invoice/index/$1';
$route['admin/invoice/edit/(:num)'] = 'admin_invoice/edit/$1';
$route['admin/deleteinvoice/(:any)'] = 'admin_invoice/delete/$1';
$route['admin/invoice/sort'] = 'admin_invoice/sort';


$route['admin/messages'] = 'messages/index';
$route['admin/messages/(:num)'] = 'messages/index/$1';


//Workflow
$route['admin/workflow'] = 'admin_workflow/index';
$route['admin/workflow/(:num)'] = 'admin_workflow/index/$1';

$route['cs_adminworkflow/workflow'] = 'cs_adminworkflow/index';
$route['cs_adminworkflow/workflow/(:num)'] = 'cs_adminworkflow/index/$1';


//Compliants
$route['admin/compliants']='admin_compliants/index';
$route['admin/instantcompliantnotification/(:any)']='admin_compliants/getinstant_complaiant_notification/$1';
$route['admin/rate']='admin_compliants/rate_translator';

$route['admin/banner'] = 'admin_banner/index';
$route['admin/banner/(:num)'] = 'admin_banner/index/$1';



$route['admin/addbanner'] = 'admin_banner/add';
$route['admin/editbanner'] = 'admin_banner/edit';
$route['admin/editbanner/(:any)'] = 'admin_banner/edit/$1';
$route['admin/deletebanner/(:any)'] = 'admin_banner/delete/$1';



$route['translator/invoice'] = 'front_invoice/index';
$route['translator/invoice/(:num)'] = 'front_invoice/index/$1';
$route['translator/privatejob'] = 'front_invoice/privatejob';
$route['translator/privatejob/(:any)'] = 'front_invoice/privatejob/$1';


$route['translator/reviewlist'] = 'translator/reviewlist';
$route['translator/reviewlist/(:num)'] = 'translator/reviewlist/$1';


$route['admin/translator/add'] = 'admin_translator/add';
$route['admin/translator/edit/(:any)'] = 'admin_translator/edit/$1';
$route['admin/translator/editprofile/(:any)'] = 'admin_translator/editprofile/$1';
$route['admin/translatorlist'] = 'admin_translator/index';
$route['admin/translatorlist/(:any)'] = 'admin_translator/index/$1';
$route['admin/translator/mail/(:num)'] = 'admin_translator/mail/$1';


$route['admin/testimonial/add'] = 'admin_testimonial/add';
$route['admin/testimoniallist'] = 'admin_testimonial/index';
$route['admin/testimoniallist/(:any)'] = 'admin_testimonial/index/$1';
$route['admin/edittestimonial/(:any)'] = 'admin_testimonial/edit/$1';
$route['admin/editprof/(:any)'] = 'admin_testimonial/editprof/$1';
$route['admin/deletetestimonial/(:any)'] = 'admin_testimonial/delete/$1';


$route['admin/mainbanner/add'] = 'admin_mainbanner/add';
$route['admin/mainbannerlist'] = 'admin_mainbanner/index';
$route['admin/mainbannerlist/(:any)'] = 'admin_mainbanner/index/$1';
$route['admin/editmainbanner/(:any)'] = 'admin_mainbanner/edit/$1';
$route['admin/editmainbannerprof/(:any)'] = 'admin_mainbanner/editmainbannerprof/$1';
$route['admin/deletemainbanner/(:any)'] = 'admin_mainbanner/delete/$1';


$route['admin_translators'] = 'admin_regtranslator/index';
$route['admin_translators/(:num)'] = 'admin_regtranslator/index/$1';
$route['admin_translators/(:num)/(:num)'] = 'admin_regtranslator/index/$1/$1';
$route['admin_translators/edit/(:num)/(:num)'] = 'admin_regtranslator/edit/$1/$1';
$route['admin_translators/delete/(:num)/(:num)'] = 'admin_regtranslator/delete/$1/$1';

$route['admin_blocked_translators'] = 'admin_blockedtranslators/index';
$route['admin_blocked_translators/(:num)'] = 'admin_blockedtranslators/index/$1';
$route['admin_blocked_translators/(:num)/(:num)'] = 'admin_blockedtranslators/index/$1/$1';


$route['admin/translatorreview/(:num)'] = 'admin_regtranslator/reviewlist/$1';
$route['admin/translatorreview/(:num)/(:num)'] = 'admin_regtranslator/reviewlist/$1/$1';

$route['admin_translators/edittranslator/(:num)'] = 'admin_regtranslator/edittranslator/$1';
$route['admin_translators/deletetranslator/(:num)'] = 'admin_regtranslator/deletetranslator/$1';






/*$route['admin/translators'] = 'admin_regtranslator/index';
$route['admin/translators/(:num)'] = 'admin_regtranslator/index/$1';
$route['admin/translators/edit/(:num)'] = 'admin_regtranslator/edit/$1';*/

//$route['admin/imagegallery/delete/(:any)'] = 'admin_imagegallery/delete/$1'; //$1 = page number
$route['translator'] = 'translator/index';


$route['translator/logout'] = 'translator/logout';
$route['translator/changepassword'] = 'translator/changepass';
$route['translator/myprofile'] = 'translator/changeprofile';
$route['translator/forgotpassword'] = 'translator/forgotpassconfirm';



/* End of file routes.php */
/* Location: ./application/config/routes.php */
$route['front/jobs'] = 'front_job/index';
$route['front/jobs/(:any)'] = 'front_job/index/$1';
$route['job/(:num)/(:any)'] = 'front_job/jobdetails/$1/$2';
$route['front/job/document/viewer/(:num)/(:any)'] = 'front_job/viewer';
$route['front/document/viewer1/(:any)'] = 'front_job/viewer1/$1';

$route['admin/send'] = 'admin_invite/send';
$route['admin/send/(:num)'] = 'admin_invite/send/$1';
$route['admin/send/(:num)/(:num)'] = 'admin_invite/send/$1/$1';

$route['admin/emaillist'] = 'admin_invite/emaillist';
$route['admin/emaillist/(:num)'] = 'admin_invite/emaillist/$1';
$route['admin/emaillist/(:num)/(:num)'] = 'admin_invite/emaillist/$1/$1';

$route['admin/cms'] = 'admin_cms/index';
$route['admin/cms/add'] = 'admin_cms/add';
$route['admin/cms/update'] = 'admin_cms/update';
$route['admin/cms/update/(:any)'] = 'admin_cms/update/$1';
$route['admin/cms/delete/(:any)'] = 'admin_cms/delete/$1';
$route['admin/cms/(:any)'] = 'admin_cms/index/$1'; //$1 = page number

$route['admin/send1'] = 'admin_invite/send1';
$route['admin/send1/(:num)'] = 'admin_invite/send1/$1';
$route['admin/send1/(:num)/(:num)'] = 'admin_invite/send1/$1/$1';

$route['admin/invitation/check'] = 'admin_translator/invitation_check';
$route['admin/invitation/(:num)'] = 'admin_translator/invitation_check/$1';
$route['admin/invitation/(:num)/(:num)'] = 'admin_translator/invitation_check/$1/$1';


$route['cs_admin/csAddForApprovalJobs'] = 'cs_admin/saveJobApproval';
$route['cs_admin/csListForApprovalJobs'] = 'cs_admin/listsJobApproval';
$route['cs_admin/csListForApprovalJobs/(:any)'] = 'cs_admin/listsJobApproval/$1';
$route['cs_admin/deletejob/(:any)'] = 'cs_admin/delete/$1';


