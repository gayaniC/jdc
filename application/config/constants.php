<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');


/* End of file constants.php */
/* Location: ./application/config/constants.php */
//tables//
define('USER',									'u01_users');
define('MODULE_OPTION',							'u03_module_options');
define('ROLE_MODULE',							'u04_user_roles_module_options');
define('USER_ROLE',								'u02_user_roles');

define('COMPANY',								'm01_company');
define('LEAVE_TYPE',							'm09_leave_type');
define('ATTENDENCE',							'm05_attendance');
define('DESG_TBL',								'm04_designation');
define('DEPT_TBL',								'm02_department');
define('EMP_TBL',								'm03_emp_personal');
define('SUPER_TBL',								'm07_supervisors');
define('LV_ALLO_TBL',							'm10_leave_allocation');
define('TASK_TBL',								'm06_emp_tasks');
define('RECRUIT_TBL',							'm08_recruitment');
define('VEHICLE_TBL',							'm11_vehicle');
define('HR_LOG',								'm12_hr_log');
define('EMAIL_TBL',								'm13_email');
define('CUST_TBL',								'm14_customer');


define('EMP_PROFILE',							't01_employee_profile');
define('EMP_EDU_TBL',							't03_emp_education');
define('EMP_PRV_WORK',							't02_prv_emp_work_details');
define('EMP_FAM_TBL',							't04_emp_family');
define('LEAVE_TBL',								't08_leave');
define('EMP_VEHICLE',							't09_emp_hs_vehicle');
define('EMP_HS_TASK',							't06_emp_hs_tasks');
define('CV_TBL',								't07_cv_fr_vacancy');
define('EMP_MANAGED',							't05_emp_managed');
define('GATE_PASS',								't11_gate_pass');
define('FUEL_CONSUMP' ,                          't12_fuel_consumption');
define('IDEAS',                                 't13_inq_idea');


define('BANK_TBL',								'h01_bank');
define('FIXED_VAL',								'h02_fixed_vals');



//error messages//
define('LOGIN_ERROR',							'Entered username or password is invalid');
define('RECORD_ADD',							'Record Added Successfully');
define('ERROR',									'Error Occured');
define('RECORD_UPDATE',							'Record Updated Successfully');
define('RECORD_DELETE',							'Record Deleted Successfully');
define('SUP_ERROR',                             'You are not assign as supervisor');

//email
define('LOGIN_EMAIL',			' <p>Please login to verify your username and password {unwrap}http://localhost/jdc{/unwrap}</p><p>This Email is auto generated. Please do not reply to this email.</p>Thanking You<br/>Regards,<br/>JDC Printing Technologies(Pvt)Ltd,<br/>304,<br/>Grandpass Road,<br/>Colombo 14.<br/>phone:	+94 (112) 389160<br/>Fax:	+94 (112) 389166<br/>Email:	jdc@jdcsl.com');

