<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\NhpProduct;
use App\Models\ProductModel;
use App\Models\Sales;
use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        try {
              if ($user->role == UserRole::Administrator) {
                  $projects = Project::get();
              } else {
                  $projects = Project::where('status', true)->get();
              }
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

        return view('projects.index', compact('projects'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
              $products = ProductModel::where('status', true)->get();
              $resellers = Sales::where('status', true)->get();
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

        return view('projects.create')
               ->with(compact('resellers'))
               ->with(compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $creator = auth()->user();
        $req = $request->all();
        try {
             $req['created_by'] = $creator->id;
             $req['status'] = true;
             $project = Project::create($req);
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

        foreach($req['products'] as $product)
        {
            $data = [
                        'project_id'  => $project->id,
                        'product_id' => $product["'pid'"],
                        'name'       => $product["'product'"],
                        'price'      => $product["'price'"],
                        'saleses'    => json_encode($req['resellers']) ?? null,
                        'status'     => true,
                        'created_by' => $creator->id ?? 1,
            ];
            try {
                $nproduct = NhpProduct::create($data);
            } catch(QueryException $e) {
                return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
            } catch(Exception $e) {
                return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
            }
        }

        return redirect()->route('projects.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        try {
              $resellers = Sales::where('status', true)->get();
              $products = ProductModel::where('status', true)->get();
              $nproducts = NhpProduct::where('project_id', $project->id)->where('status', true)->get();
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

        return view('projects.edit', compact('project'))
               ->with(compact('resellers'))
               ->with(compact('nproducts'))
               ->with(compact('products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $req = $request->all();
        /*
        $extras = implode(',', $data['extras']);
        $data['extras'] = json_encode($extras);
        */
        try {
              $creator = auth()->user();
              $req['created_by'] = $creator->id;
              if (!isset($req['salesing'])) {
                  $req['salesing'] = false;
              }
              $project->update($req);
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

        foreach($req['products'] as $product)
        {
            $data = [
                        'project_id'  => $project->id,
                        'product_id' => $product["'pid'"],
                        'name'       => $product["'product'"],
                        'price'      => $product["'price'"],
                        'saleses'    => json_encode($req['resellers']) ?? null,
                        'status'     => true,
                        'created_by' => $creator->id ?? 1,
            ];
            try {
                $nproduct = NhpProduct::create($data);
            } catch(QueryException $e) {
                return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
            } catch(Exception $e) {
                return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
            }
        }

        return redirect()->route('projects.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        try {
              if ($project->status) {
                  $project->status = false;
                  $project->save();
                  $nproducts = NhpProduct::where('project_id', $project_id)->get();
                  foreach($nproducts as $nproduct) {
                      $nproduct->status = false;
                      $nproduct->save();
                  }
                } else if (auth()->user()->role <= UserRole::Manager) {
                  $project_id = $project->id;
                  $nproducts = NhpProduct::where('project_id', $project_id)->get();
                  foreach($nproducts as $nproduct) {
                      $nproduct->delete();
                  }
                  $project->delete();
              }
        } catch (QueryException $e) {
              return response()->json(['error' => '資料庫錯誤：' . $e->getMessage()], 500);
        } catch (Exception $e) {
              return response()->json(['error' => '程式錯誤：' . $e->getMessage()], 500);
        }

        return redirect()->route('projects.index');
    }
}

