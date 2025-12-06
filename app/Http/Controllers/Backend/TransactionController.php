<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\TransactionDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(TransactionDataTable $dataTables){
        return $dataTables->render('admin.transaction.index');
    }
}
