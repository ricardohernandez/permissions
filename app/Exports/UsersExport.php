<?php
namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class UsersExport implements FromView
{
    protected $registros;

    public function __construct($registros)
    {
        $this->registros = $registros;
    }
    
    public function view(): View
    {
        return view('excel.users', ['users' => $this->registros]);
    }

}
