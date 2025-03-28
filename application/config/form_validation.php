<?php

$config = [

	///////// validation for Client registration
	'user_profile_validation' => [
		[
			'field' => 'fname',
			'label' => 'First Name',
			'rules' => 'required|trim',
		],
		[
			'field' => 'lname',
			'label' => 'Last Name',
			'rules' => 'required|trim',
		],
		[
			'field' => 'desgntn',
			'label' => 'Designation',
			'rules' => 'required|trim',
		],
		[
			'field' => 'mobile_no',
			'label' => 'Mobile No',
			'rules' => 'required|trim|numeric',
		],
		[
			'field' => 'email_id',
			'label' => 'Email ID',
			'rules' => 'required|trim|valid_email',
		],
		[
			'field' => 'address',
			'label' => 'Address',
			'rules' => 'required|trim',
		],
		[
			'field' => 'set_pswrd',
			'label' => 'Set Password',
			'rules' => 'required|trim|min_length[8]|max_length[12]',
		],
	],

	'user_profile_ast_validation' => [
		[
			'field' => 'fname',
			'label' => 'First Name',
			'rules' => 'required|trim',
		],
		[
			'field' => 'lname',
			'label' => 'Last Name',
			'rules' => 'required|trim',
		],
		[
			'field' => 'desgntn',
			'label' => 'Designation',
			'rules' => 'required|trim',
		],
		[
			'field' => 'mobile_no',
			'label' => 'Mobile No',
			'rules' => 'required|trim|numeric',
		],
		[
			'field' => 'email_id',
			'label' => 'Email ID',
			'rules' => 'required|trim|valid_email',
		],
		[
			'field' => 'address',
			'label' => 'Address',
			'rules' => 'required|trim',
		],
		[
			'field' => 'user_id_new',
			'label' => 'Set User ID',
			'rules' => 'required|trim|max_length[20]|is_unique[depart_users.unique_user_id]',
		],
		[
			'field' => 'set_pswrd',
			'label' => 'Set Password',
			'rules' => 'required|trim|min_length[8]|max_length[12]',
		],
	],




	'dc_profile_creation_validation' => [
		[
			'field' => 'name',
			'label' => 'Name',
			'rules' => 'required|trim',
		],

		[
			'field' => 'dist_code',
			'label' => 'District Code',
			'rules' => 'required|trim',
		],
		[
			'field' => 'type',
			'label' => 'Type',
			'rules' => 'required|trim',
		],

		[
			'field' => 'phone_no',
			'label' => 'Mobile No',
			'rules' => 'required|trim|numeric',
		],

		[
			'field' => 'user_name',
			'label' => 'Set User Name',
			'rules' => 'required|trim|max_length[20]',
		],
		[
			'field' => 'new_password',
			'label' => 'Set Password',
			'rules' => 'required|trim',
		],

		[
			'field' => 'date_of_joining',
			'label' => 'Joining Date',
			'rules' => 'required',
		],

		// [
		// 	'field' => 'date_of_relese',
		// 	'label' => 'Release Date',
		// 	'rules' => 'required',
		// ],
	],

	'aidc_md_profile_creation_validation' => [
		[
			'field' => 'name',
			'label' => 'Name',
			'rules' => 'required|trim|max_length[100]',
			'errors' => [
				'required' => 'The {field} is required.',
				'alpha_space' => 'The {field} may only contain alphabetical characters and spaces.',
				'max_length' => 'The {field} cannot exceed 50 characters.'
			]
		],
		// [
		// 	'field' => 'mobile',
		// 	'label' => 'Mobile No',
		// 	'rules' => 'required|numeric|exact_length[10]',
		// 	'errors' => [
		// 		'required' => 'The {field} is required.',
		// 		'numeric' => 'The {field} must contain only numbers.',
		// 		'exact_length' => 'The {field} must be exactly 10 digits long.'
		// 	]
		// ],
		[
			'field' => 'email',
			'label' => 'Email ID',
			'rules' => 'required|trim|valid_email',
			'errors' => [
				'required' => 'The {field} is required.',
				'valid_email' => 'Please provide a valid {field}.'
			]
		],
		[
			'field' => 'new_password',
			'label' => 'Set Password',
			'rules' => 'required|trim|min_length[7]|max_length[20]|regex_match[/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[\W_]).+$/]',
			'errors' => [
				'required' => 'The {field} is required.',
				'min_length' => 'The {field} must be at least 8 characters long.',
				'max_length' => 'The {field} cannot exceed 20 characters.',
				'regex_match' => 'The {field} must contain at least one uppercase letter, one lowercase letter, one number, and one special character.'
			]
		],
		[
			'field' => 'org',
			'label' => 'Organisation',
			'rules' => 'required|trim|max_length[100]',
			'errors' => [
				'required' => 'The {field} is required.',
				'max_length' => 'The {field} cannot exceed 100 characters.'
			]
		]
	]
];
