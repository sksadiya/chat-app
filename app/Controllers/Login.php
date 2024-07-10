<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;
use CodeIgniter\HTTP\ResponseInterface;

class Login extends BaseController
{
    public function index()
    {
       return view('auth/login',['title' => 'Login']);
    }
    public function log()
    {
        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required|min_length[6]',
        ];

        if (!$this->validate($rules)) {
            // Return to the register view with validation errors
            return view('auth/login', [
                'validation' => $this->validator,
            ]);
        }
        $userModel = new User();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $user = $userModel->where('email', $email)->first();

        if ($user && password_verify($password, $user->password)) {
            if ($user->role === 'subscriber') {
            $session = session();
            $session->set('isLoggedIn', true);
            $userModel->set('status', 'Online')->where('id', $user->id)->update();
            $session->set('userData', $user);
            return redirect()->to('front/dashboard')->with('success', 'login success');
            } else {
                return redirect()->to('login')->with('error', 'Access denied. You are not an admin.');
            }
        } else {
            return redirect()->to('login')->with('error', 'invalid Credentials');
        }
    }

    public function dashboard() {
        $session = session();
        if (!$session->get('isLoggedIn')) { 
            return redirect()->to('login')->with('error', 'You are not logged in.');
        }  
        $userData = $session->get('userData');

        // Load dashboard view with user data
        return view('front/dashboard', [
            'user' => $userData,
            'title'=> 'Dashboard'
        ]);
        
    }
    public function logout()
{
    $session = session();
    $user = $session->get('userData'); // Retrieve current user from session

    if ($user) {
        // Update user status to 'offline'
        $userModel = new User(); // Adjust namespace as per your application structure
        $user = $userModel->find($user->id);
        $userModel->set('status', 'Offline')->where('id', $user->id)->update();
    }

    // Remove session variables
    $session->remove(['isLoggedIn', 'userData']);

    // Redirect to homepage or desired location
    return redirect()->to(base_url('/'))->with('success', 'Logout successful.');
}
    public function register() {
        return view('auth/register',['title' => 'Register']);
    }

    public function processRegister()
    {
        $rules = [
            'username' => 'required|min_length[3]|max_length[100]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]',
            'image' => 'permit_empty|uploaded[image]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]',
            'confirm_password' => 'required|matches[password]',
        ];

        if (!$this->validate($rules)) {
            // Return to the register view with validation errors
            return view('auth/register', [
                'validation' => $this->validator,
            ]);
        }

        $userModel = new User();
        $file = $this->request->getFile('image');
        if ($file && $file->isValid()) {
            // Get the file extension
            $extension = $file->getClientExtension();

            // Generate a new secure name for the file
            $newName = time().'.'.$extension;

            // Move the uploaded file to public/images folder
            $file->move('images', $newName);

            // Set the user_image field in data to the new file name
            $user_image = $newName;
        } else {
            // If no file uploaded or not valid, set user_image to null or default image
            $user_image = null; // or set to default image name
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'user_image' => $user_image,
            'role'=> 'subscriber'
        ];

        $userModel->save($data);

        // Redirect to login page after successful registration
        return redirect()->to(base_url('login'))->with('success', 'Registration successful! Please log in.');
    }
}
