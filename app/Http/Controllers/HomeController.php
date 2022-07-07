<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Home;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $model;
    public function __construct()
    {
        $this->model = new Home();
    }
    public function index()
    {
        $sort = request()->input('sort');
        $condition = request()->input('condition');

        if (auth()->user()->is_role == false) {
            if ($sort > 0 && $condition == null) {
                $home = $this->model->where('user_id', auth()->user()->id)->where('category_id', $sort)->get();
            } else
            if ($condition > 0 && $sort == null) {
                $home = $this->model->where('user_id', auth()->user()->id)->where('status', $condition)->get();
            } else
                if ($sort && $condition) {
                $home = $this->model->where('status', $condition)->where('user_id', auth()->user()->id)->where('Category_id', $sort)->get();
            } else {
                $home = $this->model->with('category', 'user')->where('user_id', auth()->user()->id)->get();
            };
        } else {
            if ($sort > 0 && $condition == null) {
                $home = $this->model->where('category_id', $sort)->get();
            } else
            if ($condition > 0 && $sort == null) {
                $home = $this->model->where('status', $condition)->get();
            } else
                if ($sort && $condition) {
                $home = $this->model->where('status', $condition)->where('Category_id', $sort)->get();
            } else {
                $home = $this->model->with('category', 'user')->get();
            }
        }
        $start = [];
        $process = [];
        $finish = [];
        foreach ($home as $item) {

            if ($item->status == 1) {
                $start[] = $item;
            } else if ($item->status == 2) {
                $process[] = $item;
            } else {
                $finish[] = $item;
            }
        }
        $finish = count($finish) ?? 0;
        $start = count($start) ?? 0;
        $process = count($process) ?? 0;
        $total = count($home) ?? 0;

        $category = Category::get();

        return view('home', ['home' => $home, 'category' => $category, 'sort' => $sort, 'condition' => $condition, 'start' => $start, 'process' => $process, 'finish' => $finish, 'total' => $total]);
    }

    public function create()
    {
        $category = Category::all();
        return view('home.create', ['category' => $category]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,jpg,jpeg,png,exe,zip,rar,7z|max:5096',
            'category_id' => 'nullable',
            'status' => 'nullable'
        ]);
        $data['date'] = $data['date'] ?? date('Y-m-d');
        if ($request->hasFile('file')) {

            $file = $data['file'];
            if ($data['title'] == null) {
                $data['title'] = explode('.', $file->getClientOriginalName())[0];
            }
            $data['size'] = substr($file->getSize(), 0, -3); /* size(1024) 1mb 024 kb */
            $data['type'] = $file->getClientOriginalExtension(); /* type file */
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('files'), $fileName);
            $data['file'] = $fileName;
        }
        // elseif ($data['title'] == null) {
        //     $data['title'] = 'no title';
        // }
        $data['user_id'] = auth()->user()->id;
        $this->model->create($data);
        return redirect()->route('home');
    }
    public function dowload($id)
    {
        $home = $this->model->find($id);
        $file = public_path('files/') . $home->file;
        return response()->download($file);
    }

    public function edit($id)
    {
        $home = $this->model->find($id);
        $category = Category::all();
        return view('home.edit', ['home' => $home, 'category' => $category]);
    }

    public function update(Request $request, $id)
    {
        $item = Home::find($id);
        $data = $request->validate([
            'title' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,jpg,jpeg,png,exe,zip,rar,7z',
            'date' => 'nullable',
            'category_id' => 'required',
        ]);
        $data['date'] = $data['date'] ?? date('Y-m-d');
        if ($request->hasFile('file')) {
            $file = $data['file'];
            $size = $data['file']->getSize();
            $type = $data['file']->getClientOriginalExtension();
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('files'), $fileName);
            $data['file'] = $fileName;
            $data['size'] = substr($size, 0, -3);
            $data['type'] = $type;
            if ($item->file != null && public_path("files/") . $item->file) {
                $file = public_path("files/") . $item->file;
                unlink($file);
            }
        }
        // elseif ($data['title'] == null) {
        //     $data['title'] = 'no title';
        // }

        $data['user_id'] = auth()->user()->id;
        $item->update($data);
        return redirect()->route('home');
    }

    public function destroy($id)
    {
        $item = $this->model->find($id);
        if (file_exists(public_path("files/") . $item->file)) {
            unlink(public_path('files/') . $item->file);
        }

        $item->delete();
        return redirect()->route('home');
    }

    public function status($id)
    {
        $data = [];
        $item = Home::find($id);
        if (auth()->user()->is_role == false) {
            if ($item->status == 2) {
                $data['status'] = 1;
            } else {
                $data['status'] = 2;
            }
        } else {
            if ($item->status == 2) {
                $data['status'] = 3;
            } else {
                $data['status'] = 2;
            }
        }
        $item->update($data);

        return redirect()->route('home');
    }
    public function canceled($id)
    {
        $data = [];
        $item = Home::find($id);
        if (auth()->user()->is_role == true) {
            if ($item->status == 2) {
                $data['status'] = 4;
            }
        }
        $item->update($data);

        return redirect()->route('home');
    }
}
