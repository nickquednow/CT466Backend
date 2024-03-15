# API documentation
This is specific documentation that is for the API specifics.
# Table of Contents
1. [Defaults](#defaults)
	1. [Permission Order](#defaults_permission_order)
	2. [Default Options](#defaults_default_options)
2. [Login](#login)
	1. [attempt_login](#login_attempt_login)
		1. [Request Fields](#login_attempt_login_request_fields)
			1. [username](#login_attempt_login_request_fields_username)
			2. [password](#login_attempt_login_request_fields_password)
		2. [Response Fields](#login_attempt_login_response_fields)
			1. [success](#login_attempt_login_response_fields_success)
			2. [session](#login_attempt_login_response_fields_session)
3. [Labs](#lab)
	1. [get_classes](#lab_get_classes)
		1. [Request Fields](#lab_get_classes_request_fields)
		   1. [session](#lab_get_classes_request_fields_session) 
		2. [Response Fields](#lab_get_classes_response_fields)
		   1. [length](#lab_get_classes_response_fields_length)
		   2. [classes](#lab_get_classes_response_fields_classes)
	1. [get_labs](#lab_get_labs)
		1. [Request Fields](#lab_get_labs_request_fields)
		   1. [session](#lab_get_labs_request_fields_session) 
		   1. [class](#lab_get_labs_request_fields_class) 
		2. [Response Fields](#lab_get_labs_response_fields)
		   1. [length](#lab_get_labs_response_fields_length)
		   2. [labs](#lab_get_labs_response_fields_classes)
4. [Error Master Reference](#error_master_reference)
	1. [Codes](#error_master_reference_codes)

<a name="defaults" id="defaults"></a>
# Defaults
<a name="defaults_permission_order" id="defaults_permission_order"></a>
## Permission Order
Due to permissions being important in controlling access, the following permission order is used to verify if a specific permission will have access to a specific resource:

1. User Deny
2. User Allow
3. Group Deny
4. Group Allow
5. Domain Deny
6. Domain Allow
7. Default Deny
8. Default Allow

This has specifically been used to allow for the most specific permission to be used first (with Denys taking higher priority), and having whatever is default, as last.
<a name="defaults_default_options" id="defaults_default_options"></a>
## Default Options
<a name="login" id="login"></a>
# Login
<a name="login_attempt_login" id="login_attempt_login"></a>
## attempt_login
URI: `/api/login/attempt_login.php`
Request Format: `application/json`
Response Format: `application/json`
<a name="login_attempt_login_request_fields" id="login_attempt_login_request_fields"></a>
### Request Fields
<a name="login_attempt_login_request_fields_username" id="login_attempt_login_request_fields_username"></a>
#### username
This is coming from the supplied username in the login form.
The domain will be prepended to the username in the Windows-like manner (`DOMAIN\USERNAME`)
<a name="login_attempt_login_request_fields_password" id="login_attempt_login_request_fields_password"></a>
#### password
This is coming from the supplied password in the login form. This is in encoded in plain text.
<a name="login_attempt_login_response_fields" id="login_attempt_login_response_fields"></a>
### Response Fields
<a name="login_attempt_login_response_fields_success" id="login_attempt_login_response_fields_success"></a>
#### success
This field will either return `True` or `False` to signify if the login was successful.
<a name="login_attempt_login_response_fields_session" id="login_attempt_login_response_fields_session"></a>
#### session
This field will ONLY be present if the login was successful. This will contain a string with the session key.
<a name="lab" id="lab"></a>
# Labs
<a name="lab_get_classes" id="lab_get_classes"></a>
## get_classes
URI: `/api/labs/get_classes.php`
Request Format: `application/json`
Response Format: `application/json`
<a name="lab_get_classes_request_fields" id="lab_get_classes_request_fields"></a>
### Request Fields
<a name="lab_get_classes_request_fields_session" id="lab_get_classes_request_fields_session"></a>
#### session
The session key that has been acquired from the login request
<a name="lab_get_classes_response_fields" id="lab_get_classes_response_fields"></a>
### Response Fields
<a name="lab_get_classes_response_fields_length" id="lab_get_classes_response_fields_length"></a>
#### length
This is the length of the array that is contained in the classes array.
<a name="lab_get_classes_response_fields_classes" id="lab_get_classes_response_fields_classes"></a>
#### classes
This is an array of strings that contain the name of the class that is provided by the instructor.
<a name="lab_get_labs" id="lab_get_labs"></a>
## get_labs
URI: `/api/labs/get_labs.php`
Request Format: `application/json`
Response Format: `application/json`
<a name="lab_get_labs_request_fields" id="lab_get_labs_request_fields"></a>
### Request Fields
<a name="lab_get_labs_request_fields_session" id="lab_get_labs_request_fields_session"></a>
#### session
The session key that has been acquired from the login request
<a name="lab_get_labs_request_fields_class" id="lab_get_labs_request_fields_class"></a>
#### class
The class name returned by the `get_classes` API call.
<a name="lab_get_labs_response_fields" id="lab_get_labs_response_fields"></a>
### Response Fields
<a name="lab_get_labs_response_fields_length" id="lab_get_labs_response_fields_length"></a>
#### length
This is the length of the array that is contained in the labs array.
<a name="lab_get_labs_response_fields_labs" id="lab_get_labs_response_fields_labs"></a>
#### labs
This is an array of strings that contain the name of the lab that is provided by the instructor.
<a name="error_master_reference" id="error_master_reference"></a>
# Error Master Reference
This is a cumulative list of all codes and the corresponding error messages
<a name="error_master_reference_codes" id="error_master_reference_codes"></a>
## Codes
 - `1` => `Malformed Request`
## Messages
 - `Malformed Request` => `A Malformed request was made, and a log has been made of this. if the error persists, please notify the administrator.`
