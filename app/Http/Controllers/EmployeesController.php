<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Classes\Utility;
use Storage;
use App\Models\Companies;
use App\Models\Employees;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use File;
use Hash;
use Illuminate\Http\Request;
use View;

class EmployeesController extends Controller
{
    private $type = "employees";
    private $singular = "Employee";
    private $plural = "Employees";
    private $view = "dashboard.employee.";
    private $action = "employee";
    private $db_key = "emp_id";
    private $user = [];
    private $perpage = 10;
    private $directory = 'public/storage/imgs/';
    public function __construct()
    {
        //$this->middleware('auth');
    }
    public function search($records, $request, &$data)
    {

        /*
        SET DEFAULT VALUES
        */
        if ($request->perpage)
            $this->perpage = $request->perpage;
        $data['sindex'] = ($request->page != NULL) ? ($this->perpage * $request->page - $this->perpage + 1) : 1;

        /*
        FILTER THE DATA
        */
        $params = [];
        if ($request->cons_id) {
            $params['cons_id'] = $request->cons_id;
            $records = $records->where("cons_id", $params['cons_id']);
        }
        if ($request->is_active) {
            $params['is_active'] = $request->is_active;
            $records = $records->where("is_active", $params['is_active']);
        }

        $data['request'] = $params;
        return $records;
    }
    public function index(Request $request)
    {
        $data = array();
        $data = array(
            "page_title" => $this->plural . " List",
            "page_heading" => $this->plural . ' List',
            "breadcrumbs" => array("/dashboard" =>'Dashboard', "/dashboard/employee" => $this->plural),
            "action" => url('dashboard/' . $this->action),
            "module" => ['type' => $this->type, 'singular' => $this->singular, 'plural' => $this->plural, 'view' => $this->view, 'action' => 'dashboard/' . $this->action, 'db_key' => $this->db_key],
            "active_module" => "users"
        );
        /* GET RECORDS*/
        $records = new User;
        // $records = $records::with('category');
        $records = $this->search($records, $request, $data);

        /* TOTAL RECORD BEFORE PAGINATE */

        $data['count'] = $records->count();


        // PAGINATE THE RECORDS

        $records = $records->paginate($this->perpage);
        $records->appends($request->all())->links();
        $links = $records->links();
        $records = $records->toArray();

        $records['pagination'] = $links;

        // DATA FOR VIEW

        $data['employees'] = $records;


        return view($this->view . 'list', $data);
    }

    public function index2(Request $request, $id = NULL)
    {
        $data = array();
        $data = array(
            "page_title" => $this->plural . " List",
            "page_heading" => $this->plural . ' List',
            "breadcrumbs" => array("#" => $this->plural . " List"),
            "action" => url('dashboard/' . $this->action),
            "module" => ['type' => $this->type, 'singular' => $this->singular, 'plural' => $this->plural, 'view' => $this->view, 'action' => 'dashboard/' . $this->action, 'db_key' => $this->db_key],
            "active_module" => "users"
        );

        /* GET RECORDS*/
        $records = new User;
        // $records = $records::with('category');
        $records = $this->search($records, $request, $data);

        /* TOTAL RECORD BEFORE PAGINATE */

        $data['count'] = $records->count();


        // PAGINATE THE RECORDS

        $records = $records->paginate($this->perpage);
        $records->appends($request->all())->links();
        $links = $records->links();
        $records = $records->toArray();

        $records['pagination'] = $links;

        // DATA FOR VIEW

        $data['employees'] = $records;
        $data['employ'] = User::where('id', $id)->first()->toArray();
        // dd($data['employ']);



        return view($this->view . 'user-profile', $data);
    }


    public function create(Request $request)
    {
        if ($request->method() == "POST") {
            $data = $request->all();
            if ($request->hasFile('profile_image')) {
                $sfile = $request->file('profile_image');
                // $sfilename=Storage::putFile('/public/imgs/',$sfile);
                $sfilename = Storage::disk('public')->putFile('imgs', $sfile);
                $data['profile_image'] = basename($sfilename);
            }
            $this->cleanData($data);
            $user = new User();
            $data['password'] = bcrypt($data['password']);
            $user->create($data);
            $response = array('flag' => true, 'msg' => $this->singular . ' is added sucessfully.', 'action' => 'reload');
            echo json_encode($response);
            return redirect(url('dashboard/employee'));
        }
        $data = array(
            "page_title" => "Add " . $this->singular,
            "page_heading" => "Add " . $this->singular,
            "breadcrumbs" => array(url($this->action) => $this->plural . " List", '#' => "Add New Employee"),
            "action" => url($this->action . '/create'),
        );

        // $data['offices']   =   Offices::get()->toArray();
        return view($this->view . '/create', $data);
    }

    public function edit(Request $request, $id = NULL)
    {
        $obj = User::find($id);
        if ($request->method() == "POST") {
            $data = $request->all();
            if ($request->hasFile('profile_image')) {
                $sfile = $request->file('profile_image');
                // $sfilename=Storage::putFile('/public/imgs/',$sfile);
                $sfilename = Storage::disk('public')->putFile('imgs', $sfile);
                $data['profile_image'] = basename($sfilename);

                /* Remove old profile_image */
                $image_path = base_path() . $this->directory . $obj->image;
                if (File::exists($image_path))
                    File::delete($image_path);
            }

            $this->cleanData($data);
            if (!empty($data['password'])) {
                $data['password'] = bcrypt($data['password']);
            }
            $obj->update($data);
            $response = array('flag' => true, 'msg' => $this->singular . ' is updated sucessfully.', 'action' => 'reload');
            echo json_encode($response);
            return redirect(url('dashboard/employee'));
        }
        $data = array(
            "page_title" => "Edit " . $this->singular,
            "page_heading" => "Edit " . $this->singular,
            "breadcrumbs" => array("dashboard" => "Dashboard", "#" => $this->plural . " List"),
            "action" => url($this->action . '/edit/' . $id),
            "row" => User::find($id)
        );
        return view($this->view . '/update', $data);
    }

    public function delete($id)
    {
        $user = User::find($id);
        $image_path = base_path() . $this->directory . $user->image;
        if (File::exists($image_path))
            File::delete($image_path);
        $other_docs = json_decode($user->docs_images, true);
        if (!is_null($other_docs) && !empty($other_docs)) {
            foreach ($other_docs as $image_name) {
                $path = base_path() . $this->directory . $image_name;
                if (File::exists($path))
                    File::delete($path);
            }
        }
        $user->delete();
        $response = array('flag' => true, 'msg' => $this->singular . ' has been deleted.');
        echo json_encode($response);
        return;
    }
    public function cleanData(&$data)
    {
        $unset = ['_token'];
        foreach ($unset as $value) {
            if (array_key_exists($value, $data)) {
                unset($data[$value]);
            }
        }
        $date = ['paid_at', 'joining_date'];
        foreach ($date as $value) {
            if (@$data[$value] != "")
                $data[$value] = date("Y-m-d", strtotime($data[$value]));
        }
        $filter_array = ['mobile_no', 'cnic', 'pay', 'paid_amount', 'email'];
        foreach ($filter_array as $value) {
            if (array_key_exists($value, $data)) {
                $data[$value] = str_replace(['(', ')', ' ', '-', '_'], '', $data[$value]);
                if ($value == "pay" || $value == "paid_amount") {
                    $data[$value] = ltrim($data[$value], 'Rs');
                    $data[$value] = intval(preg_replace('/[^\d.]/', '', $data[$value]));
                }
            }
        }
        //dd($data);
        if (!empty($data['first_name']) || !empty($data['last_name'])) {
            $data['fullname'] = strtolower($data['first_name'] . " " . $data['last_name']);
        }
    }


    public function updatePassword(Request $request)
    {
        $id = Auth::user()->id;
        if ($request->isMethod('POST')) {
            $passdata = $request->all();
            $validator = $request->validate([
                'password' => 'required|confirmed',
            ]);
            if ($validator == false) {
                $response = array('flag' => false, 'msg' => 'Confirmation Password not Match');
                echo json_encode($response);
                return;
            }

            $data['password'] = bcrypt($passdata['password']);
            $user = User::where('id', $id)->update($data);

            $response = array('flag' => true, 'msg' => 'Password Updated Succesfully');
            return redirect()->route('employee.profile')->with('success','Password Updated Successfully');
        }

        return view('auth.profile.updatePassword');
    }

    public function profile(){
        $user = Auth::user();
        $data = array(
            "page_title" => $this->singular .'Profile',
            "page_heading" =>$this->singular,
            "breadcrumbs" => array("/dashboard" =>'Dashboard', "/dashboard/employee/profile" => 'Profile'),
            'user'=>$user
        );

        return view('auth.profile.index' ,$data);
    }
}
