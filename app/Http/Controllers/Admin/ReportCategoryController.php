<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReportCategoryRequest;
use App\Http\Requests\UpdateReportCategoryRequest;
use App\Interfaces\ReportCategoryRepositoryInterface;
use SweetAlert2\Laravel\Swal;
use Illuminate\Support\Facades\Storage;


class ReportCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private ReportCategoryRepositoryInterface $ReportCategoryRepository;

    public function __construct(ReportCategoryRepositoryInterface $ReportCategoryRepository)
    {
        $this->ReportCategoryRepository = $ReportCategoryRepository;
    }

    public function index()
    {
        $categories = $this->ReportCategoryRepository->getAllReportCategories();
        return view('pages.admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReportCategoryRequest $request)
    {
        $category = $request->validated();

        $category['image'] = $request->file('gambar')->store('assets/reportCategory' , 'public');

        $this->ReportCategoryRepository->createReportCategory($category);


        Swal::fire([
        'position' => "top-end",
        'icon'=> "success",
        'title'=> "Data Kategori Baru Berhasil Dibuat",
        'showConfirmButton='=> TRUE,
        'timer'=> 1000]);

        return redirect()->route('admin.Category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = $this->ReportCategoryRepository->getReportCategoryById($id);

        return view('pages.admin.category.show' , compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = $this->ReportCategoryRepository->getReportCategoryById($id);

        return view('pages.admin.category.edit' , compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReportCategoryRequest $request, string $id)
    {
        $data = $request->validated();

        if($request->gambar){
            $data['image'] = $request->file('gambar')->store('assets/reportCategory', 'public');
            Storage::disk('public')->delete( $request['old-image']);
        }

        $this->ReportCategoryRepository->updateReportCategory($data , $id);


        Swal::fire([
        'position' => "top-end",
        'icon'=> "success",
        'title'=> "Data Kategori Baru Berhasil DiUbah",
        'showConfirmButton='=> TRUE,
        'timer'=> 1000]);

        return redirect()->route('admin.Category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = $this->ReportCategoryRepository->getReportCategoryById($id);

        Storage::disk('public')->delete($category['image']);

        $this->ReportCategoryRepository->deleteReportCategory($id);

        Swal::fire([
        'position' => "top-end",
        'icon'=> "success",
        'title'=> "Data Kategori Baru Berhasil DiHapus",
        'showConfirmButton='=> TRUE,
        'timer'=> 1000]);

        return redirect()->route('admin.Category.index');

    }
}
