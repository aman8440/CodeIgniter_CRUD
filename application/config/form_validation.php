<?php

$config = [
  'login' => [
    [
      'field' => 'username',
      'lable' => 'User Name',
      'rules' => 'required|trim|alpha_numeric'
    ],
    [
      'field' => 'password',
      'label' => 'Password',
      'rules' => 'required'
    ]
  ],

  'signup' => [
    [
      'field' => 'name',
      'label' => 'Name',
      'rules' => 'required|trim|alpha'
    ],
    [
      'field' => 'phone',
      'label' => 'Contact Number',
      'rules' => 'required|numeric|trim|min_length[10]|max_length[10]|is_unique[tm_crud.phone]'
    ],
    [
      'field' => 'email',
      'label' => 'Email',
      'rules' => 'required|valid_email|trim|is_unique[tm_crud.email]'
    ],
    [
      'field' => 'gender',
      'label' => 'Gender',
      'rules' => 'required|trim'
    ],
    [
      'field'   => 'file',
      'label'   => 'File',
      'rules'   => 'callback_file_check'
    ],
    [
      'field' => 'password',
      'label' => 'Password',
      'rules' => 'required|min_length[8]|trim|matches[passconf]|callback_is_password_strong'
    ],
    [
      'field' => 'passconf',
      'label' => 'Password Confirmation',
      'rules' => 'required|min_length[8]|trim|callback_is_password_strong'
    ]
  ],
  'adding' => [
    [
      'field' => 'username',
      'lable' => 'User Name',
      'rules' => 'required|trim|alpha_numeric|is_unique[data_record.username]'
    ],
    [
      'field' => 'fname',
      'label' => 'First Name',
      'rules' => 'required|trim|alpha'
    ],
    [
      'field' => 'lname',
      'label' => 'Last Name',
      'rules' => 'required|trim|alpha'
    ],
    [
      'field' => 'email',
      'label' => 'Email',
      'rules' => 'required|valid_email|trim|is_unique[data_record.email]'
    ],
    [
      'field' => 'semail',
      'label' => 'Security Email',
      'rules' => 'required|valid_email|trim|is_unique[data_record.semail]'
    ],
    [
      'field' => 'timelag',
      'label' => 'Time Lag',
      'rules' => 'required|trim|numeric'
    ],
    [
      'field'   => 'register',
      'label'   => 'Register Type',
      'rules'   => 'required|trim'
    ],
    [
      'field'   => 'zeroknow',
      'label'   => 'Zero Knowledge',
      'rules'   => 'required|trim'
    ],
    [
      'field' => 'phone',
      'label' => 'Contact Number',
      'rules' => 'required|numeric|trim|min_length[10]|max_length[10]|is_unique[data_record.phone]'
    ],
    [
      'field' => 'country',
      'label' => 'Country',
      'rules' => 'required|alpha|trim'
    ],
    [
      'field' => 'password',
      'label' => 'Password',
      'rules' => 'required|min_length[8]|trim|callback_is_password_strong'
    ],
    [
      'field' => 'is_admin',
      'label' => 'Admin',
      'rules' => 'required|trim'
    ]
  ],
  'updating' => [
    [
      'field' => 'username',
      'lable' => 'User Name',
      'rules' => 'required|trim|alpha_numeric'
    ],
    [
      'field' => 'fname',
      'label' => 'First Name',
      'rules' => 'required|trim|alpha'
    ],
    [
      'field' => 'lname',
      'label' => 'Last Name',
      'rules' => 'required|trim|alpha'
    ],
    [
      'field' => 'email',
      'label' => 'Email',
      'rules' => 'required|valid_email|trim'
    ],
    [
      'field' => 'semail',
      'label' => 'Security Email',
      'rules' => 'required|valid_email|trim'
    ],
    [
      'field' => 'timelag',
      'label' => 'Time Lag',
      'rules' => 'required|trim|numeric'
    ],
    [
      'field'   => 'register',
      'label'   => 'Register Type',
      'rules'   => 'required|trim'
    ],
    [
      'field'   => 'zeroknow',
      'label'   => 'Zero Knowledge',
      'rules'   => 'required|trim'
    ],
    [
      'field' => 'phone',
      'label' => 'Contact Number',
      'rules' => 'required|numeric|trim|min_length[10]|max_length[10]'
    ],
    [
      'field' => 'country',
      'label' => 'Country',
      'rules' => 'required|alpha|trim'
    ]
  ],
  'email' => [
    [
      'field' => 'email',
      'label' => 'Email',
      'rules' => 'required|valid_email|callback_check_email_exists'
    ]
  ]
];

$config['error_prefix']='<div class="error">*';
$config['error_suffix']='</div>';
