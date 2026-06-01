<?php

namespace App\Http\Controllers\Api\Blog\Admin;

//use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Repositories\BlogCategoryRepository;
use Illuminate\Support\Str;
use App\Http\Controllers\Blog\Admin\BaseController;
use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Http\Requests\BlogCategoryCreateRequest;

class CategoryController extends BaseController
{
    public function __construct(private BlogCategoryRepository $blogCategoryRepository)
    {
        //parent::__construct();
    }
    public function index()
    {
        //$paginator = BlogCategory::paginate(5);
        $paginator = $this->blogCategoryRepository->getAllWithPaginate(5);

        return $paginator;
    }

    public function store(BlogCategoryCreateRequest $request)
    {$data = $request->input();
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        $item = (new BlogCategory())->create($data);

        if ($item) {
            return [
                'success' => true,
                'message' => 'Успішно збережено'
            ];
        } else {
            return ['message' => 'Помилка збереження'];
        }
    }

    public function update(BlogCategoryUpdateRequest $request, $id)
    {
        $this->blogCategoryRepository->getEdit($id);

        if (empty($item)) {
            return back()
                ->withErrors(['msg' => "Запис id=[{$id}] не знайдено"])
                ->withInput();
        }

        $data = $request->all();

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        $result = $item->update($data);

        if ($result) {
            return ['success' => 'Успішно збережено'];
        } else {
            return ['msg' => 'Помилка збереження'];
        }

    }
    public function getAllWithPaginate($perPage = null)
    {
        $columns = ['id', 'title', 'parent_id'];

        $result = $this
            ->startConditions()
            ->select($columns)
            ->paginate($perPage);

        return $result;
    }
}
