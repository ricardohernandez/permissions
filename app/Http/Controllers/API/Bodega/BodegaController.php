<?php

namespace App\Http\Controllers\API\Bodega;

use Inertia\Inertia;
use App\Helpers\DatesHelper;
use Illuminate\Http\Request;
use App\Helpers\PaginationHelper;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class BodegaController extends Controller
{

    public function index(Request $request){

        return Inertia::render('API_bodega/Mantenedor_materiales/Index',
            [
                'materiales' => $this->getMaterialesList(20),
                'tbfilters' => request()->all(['search'])
            ]
        );

    }

    public function getMaterialesList($paginate){

        if(request('search')!=""){
            $data = [
                'search' => request('search'),
            ];
            
            $response = Http::withHeaders(
                [
                    'accept' => 'application/json',
                    'x-api-key' => 'key2',
                    'Content-Type' => 'application/x-www-form-urlencoded'
                ]
            )->withBasicAuth('admin', '1234')->get("http://localhost/api/api/",$data);

        }else{

            $response = Http::withHeaders(
                [
                    'accept' => 'application/json',
                    'x-api-key' => 'key2',
                    'Content-Type' => 'application/x-www-form-urlencoded'
                ]
            )->withBasicAuth('admin', '1234')->get("http://localhost/api/api/");
        }

        /* dd($response->body()); */
        $response = $response->json($key = null);

        if($response!=FALSE){
            $collection = new Collection();
            foreach($response as $item){
                $collection->push((object)['descripcion' => $item["descripcion"],
                    'imagen'=>$item["imagen"],
                    'codigo'=>$item["codigo"],
                    'id'=>$item["id"],
                ]);
            }
            $data = PaginationHelper::paginate($collection, $paginate)->withQueryString();
        }else{
            $data = PaginationHelper::paginate(new Collection(), $paginate)->withQueryString();
        }

        return $data;
    }

    public function create(){
        return Inertia::render('API_bodega/Mantenedor_materiales/Form'); 
    }

    public function store(Request $request){
        
        $validatedData = $request->validate([
            'codigo' => 'required',
            'descripcion' => 'required'
        ]);

        $data = [
            'codigo' => $request->codigo,
            'descripcion' => $request->descripcion,
            'estado_bodega' => "VERDADERO"
        ];

        $response = Http::asForm()->post('http://localhost/api/api/',$data);
        $statusCode = $response->status();

        if($statusCode==200){
            return redirect()->route('bodega')->with('message_success', __('save_ok'));
        }else{
            return redirect()->route('bodega')->with('message_error', $response->body());
        }

    }

    public function edit($id)
    {
        $response = Http::get("http://localhost/api/api/".$id);
        $response = $response->json();
        return Inertia::render('API_bodega/Mantenedor_materiales/Form', ['arrayData' => $response[0]]);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'codigo' => 'required',
            'descripcion' => 'required'
        ]);

        $data = [
            'id' => $request->id,
            'codigo' => $request->codigo,
            'descripcion' => $request->descripcion
        ];

        
        if ($request->hasFile('imagen') && $request->file('imagen')->isValid()) {
            $imagen = $request->file('imagen')->store('users_images', 'public');
            $file = fopen(public_path('storage/'.$imagen), 'r');
            /*   $file2 = fopen(public_path('storage/users_images/xGHdoDLH1CbMARAARfXe3URRZ5zEuLKuarV7Kllt.jpg'), 'r');  */
            $filename = $request->codigo."-".date("Ymd").".jpg";
            $response = Http::attach('imagen',$file, $filename)->post('http://localhost/api/api/'.$request->id,$data);/* ,$data */
                
        }else{
            $response = Http::asForm()->put('http://localhost/api/api/'.$request->id,$data);
        }

        $statusCode = $response->status();

        if($statusCode==200){
            return redirect()->route('bodega')->with('message_success', __('update_ok'));
        }else{
            return redirect()->route('bodega')->with('message_error', $response->body());
        }
    }
    

    public function destroy($id){
        $url = "http://localhost/api/api/".$id;
        $response = Http::delete($url);
        $statusCode = $response->status();

        if($statusCode==200){
            return redirect()->route('bodega')->with('message_success', __('deleted_ok'));
        }else{
            return redirect()->route('bodega')->with('message_error', __('server_error'));
        }
    }
    

}
