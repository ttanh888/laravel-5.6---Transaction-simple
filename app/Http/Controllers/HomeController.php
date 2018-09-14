<?php

namespace App\Http\Controllers;

use App\Group;
use App\User;
use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    function index()
    {
        return view('welcome');
    }


    function noTransaction()
    {

        User::create([
            'name' => str_random(10),
            'email' => str_random(10).'@example.com',
            'password' => '123456'
        ]);

        Group::create([
            'name' => 'group1',
        ]);
    }

    function transaction()
    {
        DB::beginTransaction();
        try{

            User::create([
                'name' => str_random(10),
                'email' => str_random(10).'@example.com',
                'password' => '123456'
            ]);

            Group::create([
                'name' => str_random(10).'group-name',
            ]);

            DB::commit();

            return 'OK';
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }
}
