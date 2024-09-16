<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    protected function applyFilters($query, Request $request)
    {
        if ($request->has('search')) {
            $query->where('name', 'LIKE', '%' . $request->input('search') . '%');
        }

        if ($request->query('sort')) {
            $attribute = $request->query('sort');
            $sort_order = 'ASC';
            if (strncmp($attribute, '-', 1) === 0) {
                $sort_order = 'DESC';
                $attribute = substr($attribute, 1);
            }
            $query->orderBy($attribute, $sort_order);
        } else {
            $query->latest();
        }

        return $query;
    }
}
