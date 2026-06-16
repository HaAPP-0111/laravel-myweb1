<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
<<<<<<< HEAD
=======
use PhpParser\Node\Param;
>>>>>>> fca0cb4305e90ded0a3aae37799d569b63faf474

class DemoController extends Controller
{
    public function index()
    {
        return view('demoindex');
    }

    public function index2()
    {
        $data = "ABC";
        return view('demoindex2', compact('data'));
    }

    public function index3()
    {
        return response()->json([
<<<<<<< HEAD
            'status' => true,
            'data' => [
                'name' => 'san pham 1',
                'price' => 240000
=======
            'status' => 'true',
            'data' => [
                'name' => 'San Pham 1',
                'price' => 24000
>>>>>>> fca0cb4305e90ded0a3aae37799d569b63faf474
            ]
        ]);
    }

    public function index4($id)
    {
        $data = "ABC";
<<<<<<< HEAD
        return view('demoindex4', compact('data','id'));
=======
        return view('demoindex4', compact('data', 'id'));
>>>>>>> fca0cb4305e90ded0a3aae37799d569b63faf474
    }

    public function index5($id = null)
    {
        $data = "ABC";
        dump($id);
<<<<<<< HEAD
        return view('demoindex5', compact('data','id'));
    }

   public function index6($param1, $param2)
{
    $data = "Website Laravel";

    return view('demoindex6', [
        'data' => $data,
        'param1' => $param1,
        'param2' => $param2
    ]);
}
}
=======
        return view('demoindex5', compact('data', 'id'));
    }

    public function index6($parram1, $parram2)
    {
        $data = "ABC";
        return view('demoindex6', compact('data', 'parram1', 'parram2'));
    }
}
>>>>>>> fca0cb4305e90ded0a3aae37799d569b63faf474
