<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchDocumentController extends Controller
{
    private $type = "Documents";
    private $singular = "Document";
    private $plural = "Documents";
    private $view = "dashboard.documents.search";

    public function index(){
        $data = array(
            "page_title" => $this->plural . " Search",
            "page_heading" => $this->plural . ' List',
            "breadcrumbs" => array("/dashboard" => 'Dashboard', "/dashboard/document/search" => 'Search'),
            "module" => ['type' => $this->type, 'singular' => $this->singular, 'plural' => $this->plural, 'view' => $this->view],
            "active_module" => "users"
        );
        return view('dashboard.documents.search', $data);
    }
}
