<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\User;
use App\Libraries\Hash;

use CodeIgniter\Email\Email;

class Auth extends BaseController
{
    public function __construct()
    {
        helper(['url', 'form']);
    }

    /** Rendering forms */
    public function index()
    {
        return view('auth/login');
    }

    public function register()
    {
       return view('auth/register');
    }

    /** Add new User */

    public function create_user()
    {
        $validated = $this->validate([
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Your name must not be empty.'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required' => 'Your email must not be empty.',
                    'valid_email' => 'Invalid email format. (e.g. example@gmail.com)',
                    'is_unique' => 'Email is already taken.'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => 'Password must not be empty.',
                    'min_length' => 'Password length should be atleast 8 characters.'
                ]
            ],
            'confirm_password' => [
                'rules' => 'required|min_length[8]|matches[password]',
                'errors' => [
                    'required' => 'Confirm Password must not be empty.',
                    'min_length' => 'Confirm Password length should be atleast 8 characters.',
                    'matches' => 'Password did not match.'
                ]
            ],
            'image' => [
                'rules' => 'uploaded[image]|mime_in[image,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Please select an image to upload.',
                    'mime_in' => 'Only JPEG, JPG, and PNG images are allowed.'
                ]
            ]
        ]);

        if(!$validated)
        {
             return view('auth/register', ['validation' => $this->validator]);
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => Hash::make($this->request->getPost('password')),
            'avatar' => $this->request->getFile('image')->getName(),
            'verification_number' => $this->send_code($this->request->getPost('email'))
        ];

        $config['upload_path'] = getcwd().'/images';

        if(!is_dir($config['upload_path']))
        {
            mkdir($config['upload_path'], 0777);
        }

        $image = $this->request->getFile('image');
        if ($image->isValid() && ! $image->hasMoved())
        {
            $image->move($config['upload_path'] , $image->getName());
        }

        $user = new User();
        $query = $user->insert($data);

        if(!$query)
        {
            return redirect()->back()->with('fail', 'Failed to add user.');
        }
        else
        {
            return redirect()->to('auth/verify-account');
        }
    }

    /** Login user */

    public function login()
    {
        $validated = $this->validate([
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email field is required.',
                    'valid_email' => 'Invalid email format. (e.g. example@gmail.com)'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => 'Password field is required.',
                    'min_length' => 'Password length should be at least 8 characters.'
                ]
            ]
        ]);

        if (!$validated) {
            return redirect()->to('auth/login')->with('status', 'Invalid email or password.');
        }

        $user = new User();
        $userData = $user->where('email', $this->request->getVar('email'))->first();

        if (!$userData) {
            return redirect()->to('auth/login')->with('status', 'Invalid email or password.');
        }

        $hashedPassword = $userData['password'];
        $password = $this->request->getVar('password');
        $isPasswordCorrect = Hash::check($password, $hashedPassword);

        if (!$isPasswordCorrect) {
            return redirect()->to('auth/login')->with('status', 'Invalid email or password.');
        }

        $sessionData = [
            'id' => $userData['id'],
            'name' => $userData['name'],
            'email' => $userData['email'],
            'avatar' => $userData['avatar'],
            'isLoggedIn' => true
        ];

        if($userData['verification_status'] == 'unverified'){
            $this->send_code($userData['email'], $userData['verification_number']);
            return redirect()->to('auth/verify-account');
        }

        session()->set($sessionData);

        return redirect()->to('/');
    }

    /** Logout user */

    public function logout()
    {
        // Destroy user session
        session()->destroy();

        // Redirect to login page
        return redirect()->to('auth/login');
    }

    /** send verification code */

    public function send_code($userEmail, $code = null)
    {
        $code1 = rand(000001, 999999);
        $email = new Email();
        $email->initialize(config('Email'));

        $email->setFrom('accountverifier@gmail.com', 'Authenticator');
        $email->setTo($userEmail);
        $email->setSubject('Verification Code');
        if($code != null){
            $email->setMessage('Your verification code is: '. $code);
        }else{
            $email->setMessage('Your verification code is: '. $code1);
        }
        

        if ($email->send()) {
            return $code;
        } else {
            echo 'Error sending email.';
        }
    }

    /** Verify account */

    public function verify(){
        return view('auth/verification');
    }

    public function verify_code(){
        $validated = $this->validate([
            'code' => [
                'rules' => 'required|min_length[6]|max_length[6]',
                'errors' => [
                    'required' => 'Code field is required.',
                    'min_length' => 'Invalid verification code.',
                    'max_length' => 'Invalid verification code.'
                ]
            ]
        ]);

        $user = new User();
        $userData = $user->where('verification_number', $this->request->getVar('code'))->first();

        if (!$userData) {
            return view('auth/login', ['validation' => 'Invalid verification code.']);
        }

        $data = [
            'name'                  => $userData['name'],
            'email'                 => $userData['email'],
            'avatar'                => $userData['avatar'],
            'password'              => $userData['password'],
            'verification_status'   => 'verified',
            'verification_number'   => $userData['verification_number']
        ];

        $user->update($userData['id'], $data);

        return redirect()->to('auth/login');
    }
}
