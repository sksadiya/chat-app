<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\PusherLibrary;
use App\Models\Message;
use App\Models\User;
use CodeIgniter\HTTP\ResponseInterface;

class Chat extends BaseController
{
    protected $user;
    protected $message;
    protected $pusher;

    public function __construct()
    {
        $this->user = new User();
        $this->message = new Message();
    }


    public function index()
    {
        $data['users'] = $this->user->findAll();
        $data['title'] = 'Chat';
        return view('front/chat', $data);
    }
    public function getAllUsers()
    {
    //    $users = $this->user->findAll();
        $users = $this->user->getAllUsers();
        return $this->response->setJSON($users);
    }

    public function getUserById($userId)
    {
        $user = $this->user->getUserById($userId);
        return $this->response->setJSON($user);
    }
}
