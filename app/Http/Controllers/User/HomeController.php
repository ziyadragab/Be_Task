<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\HomeInterface;

class HomeController extends Controller
{
    private $homeInterface;
    public function __construct(HomeInterface $home)
    {
      $this->homeInterface=$home;
    }

    public function index(){
        return $this->homeInterface->index();
    }
}
