<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DummyController extends Controller
{
    function any(Request $request){ //si quiero una request debo ponerlo primero en los parametros.
        //@method = $request->method();
        return 'any, has llegado con el método';
        }
        function delete(){
        return delete('dummyget');
        }
        function get(){
        return view('dummyget');
        }
        function post(){
        return post('dummyget');
        }
        function put(){
        return put('dummyget');
        }
}