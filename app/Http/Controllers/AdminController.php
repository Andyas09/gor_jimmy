<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    private function setActive($page)
    {
        return [
            'Dashboard' => $page,
            'DashboardActive' => true,
        ];
    }
    public function index()
    {
        $data = [
            'totalProduk' => '3',
            'totalKategori' => '1',
            'totalUser' => '1',
            'totalPesanan' => '1',
            'totalPendapatan' => '1',
        ];

        return view(
            'admin.pages.dashboard',
            array_merge($data, $this->setActive('dashboard'), $this->setActive('dashboard'))
        );
    }
}
