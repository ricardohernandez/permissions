<?php

namespace App\Http\Controllers\Back_end;

use App\Models\User;
use Inertia\Inertia;
use App\Helpers\DatesHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
    {
        $this->authorize('view',Auth::user());
        $user = auth()->user();
        
        if ($user->can('dashboard.index')) {
            $date_from = date('Y-m', strtotime('-12 months', strtotime(date("Y-m"))));
            $date_to = date('Y-m');

            return Inertia::render('Back_end/Dashboard/Index',
                [
                    "filters" => array("date_from" => $date_from,"date_to" => $date_to)
                ]
            );

        }else{
            abort(403);
        }
       
    }

    public function barJSChartData(Request $request){
        if (Auth::user()->can('dashboard.index')) {
            $months = DatesHelper::getMonthsInRange(request('date_from')."-01",request('date_to')."-01");
            $count = count($months);
            $labels=array();

            if($count>13){
                return response()->json(array("res" => "error" , "msg" => __('dashboard_date_range_error')));
            }

            if(strtotime(request('date_from')) >strtotime(request('date_to'))){
                return response()->json(array("res" => "error" , "msg" => __('filter_date_range')));
            }

            foreach($months as $m){
                $temp = array();
                $temp[] = DatesHelper::monthsToStr(substr($m,5,6))."-".substr($m,0,4);
                $labels[] = $temp;
            }
        
            $active = array();
            foreach($months as $m){
                $query = User::whereMonth('date_admission',substr($m,5,6))->where('active',1)->orderBy('date_admission','asc');//->whereYear('date_admission',substr($m,0,4))
                $active[] = $query->count();
            }

            $noactive = array();
            foreach($months as $m){
                $query = User::whereMonth('date_admission',substr($m,5,6))->where('active',0)->orderBy('date_admission','asc');//->whereYear('date_admission',substr($m,0,4))
                $noactive[] = $query->count();
            }

            $array = [
                'labels' => $labels,
                'datasets' => [
                        [
                            'type' => 'bar',
                            'label' => __('active'),
                            'backgroundColor' => 'rgba(26, 86, 219, .7)',//'#3730A3',
                            'borderColor' => 'rgba(26, 86, 219, 1)',
                            'data' => $active,
                            'barThickness'=> 22,
                            'borderWidth' =>2,
                            'hoverBorderWidth'=>0,
                            'order' => 2,
                            'yAxisID'=> "y-active"
                        ],
                        [
                            'type' => 'bar',
                            'label' => __('no_active'),
                            'backgroundColor' => 'rgba(223, 46, 7, .7)',//'#3730A3',
                            'borderColor' => 'rgba(223, 46, 7, 1)',
                            'data' => $noactive,
                            'barThickness'=> 22,
                            'borderWidth' =>2,
                            'hoverBorderWidth'=>0,
                            'order' => 3,
                            'yAxisID' => "y-active"
                        ],
                        [
                            'type' => 'line',
                            'label' => 'Porc',
                            'backgroundColor' => 'rgba(25, 130, 117, .7)',//'#3730A3',
                            'borderColor' => 'rgba(25, 130, 117, .8)',
                            'data' => [1,2,3,4,1,2,3,5,7,8,1,2,14],
                            'fill' => false, 
                            'pointBorderColor' => 'rgba(25, 130, 117, 1)',    
                            'pointBackgroundColor' => 'white',
                            'order' => 1,
                            'lineTension' => 0.4,    
                            'yAxisID' => "y-perc",
                            'datalabels'=> array(
                                /* "title" => null, */
                                "color" => "white",
                                'anchor' => 'end',
                                'align' => 'end',
                                'backgroundColor' => 'rgba(25, 130, 117, .8)',
                                'borderRadius' => 4,
                                'padding' => 4,
                                'font' => array(
                                    'weight' => 'bold'
                                ),
                            ),

                        ]
                    ]
                ];
            return response()->json(array("res" => "ok" , "array" => $array));

        }else{
             abort(403);
        }
    }

    public function barDataChart(Request $request){
        if (Auth::user()->can('dashboard.index')) {
            $active = request("label");
            $date = request("x");
            $date = explode("-", $date);
            $month = DatesHelper::monthsToNumber($date[0]);
            $year = $date[1];

            $query = User::with(['permissions', 'roles','leader.user'])->whereMonth('date_admission',$month);
        
            if($active=="Active"){
                $query->active()->orderBy('date_admission','asc');
            } 

            return response()->json(array("array" => $query->get()->toArray() , "info" => $request->all()));
        }else{
            abort(403);
        }
    }
    
    public function lineJSChartData(){
        if (Auth::user()->can('dashboard.index')) {
            $data = [
                    'labels' => [
                        'January',
                        'February',
                        'March',
                        'April',
                        'May',
                        'June',
                        'July',
                        'August',
                        'September',
                        'October',
                        'November',
                        'December'
                    ],
                    'datasets' => [
                            [
                                'label' => 'Data 1',
                                'backgroundColor' => 'rgba(55, 48, 163, .7)',
                                'borderColor' => "rgba(55, 48, 163, 1)",
                                'data' => [40, 20, 12, 39, 10, 40, 39, 80, 40, 20, 12, 11],
                                'fill' => true, 
                                'pointBorderColor' => 'rgba(55, 48, 163, 1)',    
                                'pointBackgroundColor' => 'white',
                                'borderWidth' =>2,
                                'lineTension' => 0.25,        
                            ], 
                            [
                                'label' => 'Data 2',
                                'backgroundColor' => 'rgba(234, 88, 12, .7)',
                                'borderColor' => "rgba(234, 88, 12, 1)",
                                'data' => [10, 30, 22, 19, 50, 120, 19, 20, 30, 10, 12, 21],
                                'fill' => true, 
                                'borderWidth' =>2,
                                'pointBorderColor' => 'rgba(234, 88, 12, 1)',
                                'pointBackgroundColor' => 'white',
                                'lineTension' => 0.25, 
                            ], 

                        ]
                    ];
            
            return response()->json($data);
        }else{
            abort(403);
        }
    }

    public function pieChartData(){
        $array = [];
        $array[] = array("Estado","cantidad");
        $array[] = array("Activo",10);
        $array[] = array("No Activo",20);
        return $array;
    }

    public function barChartData(){
        $array = [];
        $array[] = array(
            "Mes",
            "Activos",
            array('role'=> 'annotation'),
            "No activos",
            array('role'=> 'annotation')
        );
        
        $array[] = array("Jun",10,"10",7,"7");
        $array[] = array("Jul",5,"5",9,"9");
        return $array;
    }

    public function columnChartData(){
        $array = [];
        $array[] = array(
            "Mes",
            "Activos",
            array('role'=> 'annotation'),
            "No activos",
            array('role'=> 'annotation')
        );
        
        $array[] = array("Jun",10,"10",7,"7");
        $array[] = array("Jul",5,"5",9,"9");
        return $array;
    }

    
    public function comboChartData(){
        $array = [];
        $array[] = array(
            "Mes",
            "Porc",
            "Activos",
            array('role'=> 'annotation'),
            "No activos",
            array('role'=> 'annotation'),
        );
        $array[] = array("jun",9,15,"15",4,"4");
        $array[] = array("jul",6,12,"12",6,"6");
        $array[] = array("ago",7,20,"20",3,"3");
        $array[] = array("sep",9,11,"11",2,"2");
        $array[] = array("oct",15,3,"3",6,"6");
        return $array;
    }

    
}
