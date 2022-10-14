<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DummyController extends Controller
{
    function main() {
        return view('main', ['activeHome' => 'active']);
    }
    function any(Request $request) {
        $method = $request->method();
        return 'any, has llegado con el método:' . $method;
    }   
    function delete() {
        return 'delete';
    }
    function get() {
        //return 'get: ' . csrf_token();
        return view('dummy.get');
    }    
    function post() {
        return 'post';
    }   
    function put() {
        return 'put';
    }
}
