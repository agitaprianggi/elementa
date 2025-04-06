<?php
namespace SCart\Core\Front\Controllers;

use SCart\Core\Front\Controllers\RootFrontController;
use SCart\Core\Front\Models\ShopCategory;
use SCart\Core\Front\Models\ShopBrand;
use SCart\Core\Front\Models\ShopProduct;
use SCart\Core\Front\Models\ShopProductInfo;

class ShopCategoryController extends RootFrontController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Process front get category all
     *
     * @param [type] ...$params
     * @return void
     */
    public function allCategoriesProcessFront(...$params)
    {
        if (config('app.seoLang')) {
            $lang = $params[0] ?? '';
            sc_lang_switch($lang);
        }
        return $this->_allCategories();
    }

    /**
     * display list category root (parent = 0)
     * @return [view]
     */
    private function _allCategories()
    {
        $sortBy = 'sort';
        $sortOrder = 'asc';
        $filter_sort = sc_request('filter_sort','','string');
        $filterArr = [
            'sort_desc' => ['sort', 'desc'],
            'sort_asc' => ['sort', 'asc'],
            'id_desc' => ['id', 'desc'],
            'id_asc' => ['id', 'asc'],
        ];
        if (array_key_exists($filter_sort, $filterArr)) {
            $sortBy = $filterArr[$filter_sort][0];
            $sortOrder = $filterArr[$filter_sort][1];
        }

        $itemsList = (new ShopCategory)
            ->getCategoryRoot()
            ->setSort([$sortBy, $sortOrder])
            ->setPaginate()
            ->setLimit(sc_config('item_list'))
            ->getData();

        sc_check_view($this->templatePath . '.screen.shop_item_list');
        return view(
            $this->templatePath . '.screen.shop_item_list',
            array(
                'title'       => sc_language_render('front.categories'),
                'itemsList'   => $itemsList,
                'keyword'     => '',
                'description' => '',
                'layout_page' => 'shop_item_list',
                'filter_sort' => $filter_sort,
                'breadcrumbs' => [
                    ['url'    => '', 'title' => sc_language_render('front.categories')],
                ],
            )
        );
    }

    /**
     * Process front get category detail
     *
     * @param [type] ...$params
     * @return void
     */
    public function categoryDetailProcessFront(...$params)
    {
        if (config('app.seoLang')) {
            $lang = $params[0] ?? '';
            $alias = $params[1] ?? '';
            sc_lang_switch($lang);
        } else {
            $alias = $params[0] ?? '';
        }
        return $this->_categoryDetail($alias);
    }


    /**
     * Category detail: list category child + product list
     * @param  [string] $alias
     * @return [view]
     */
    private function _categoryDetail($alias)
    {
        $sortBy = 'sort';
        $sortOrder = 'asc';
        $arrBrandId = [];
        $filter_sort = sc_request('filter_sort','','string');
        $filterArr = [
            'price_desc' => ['price', 'desc'],
            'price_asc' => ['price', 'asc'],
            'sort_desc' => ['sort', 'desc'],
            'sort_asc' => ['sort', 'asc'],
            'id_desc' => ['id', 'desc'],
            'id_asc' => ['id', 'asc'],
        ];
        if (array_key_exists($filter_sort, $filterArr)) {
            $sortBy = $filterArr[$filter_sort][0];
            $sortOrder = $filterArr[$filter_sort][1];
        }

        $keyword = sc_request('keyword','', 'string');
        $bid = sc_request('bid','', 'string');
        $price = sc_request('price','', 'string');
        $brand = sc_request('brand','', 'string');

        if ($bid) {
            $arrBrandId = explode(',', $bid);
        } else {
            if ($brand) {
                $arrAliasBrand = explode(',', $brand);
                $arrBrandId = ShopBrand::whereIn('alias', $arrAliasBrand)->pluck('id')->toArray();
            }
        }

        $category = (new ShopCategory)->getDetail($alias, $type = 'alias');

        if ($category) {
            // Ambil data dari model ShopCategory
            $arrCate = (new ShopCategory)->getListSub($category->id);

            // Ambil data dari kedua model TANPA limit
            $productsA = (new ShopProduct)
                ->setKeyword($keyword)
                ->getProductToCategory($arrCate)
                ->getProductToBrand($arrBrandId)
                ->setRangePrice($price)
                ->setPaginate(false)
                ->setSort([$sortBy, $sortOrder])
                ->getData();

            $productsB = (new ShopProductInfo)
                ->setKeyword($keyword)
                ->getProductToCategory($arrCate)
                ->getProductToBrand($arrBrandId)
                ->setRangePrice($price)
                ->setPaginate(false)
                ->setSort([$sortBy, $sortOrder])
                ->getData();

            // Merge hasil
            $mergedProducts = $productsA->merge($productsB)->values();

            // Manual pagination
            $page = request()->get('page', 1);
            $perPage = sc_config('product_list');
            $total = $mergedProducts->count();
            $pagedProducts = $mergedProducts->forPage($page, $perPage)->values();

            // Buat paginator yang dikirim ke view
            $products = new \Illuminate\Pagination\LengthAwarePaginator(
                $pagedProducts,
                $total,
                $perPage,
                $page,
                ['path' => request()->url(), 'query' => request()->query()]
            );

            $subCategory = (new ShopCategory)
                ->setParent($category->id)
                ->setLimit(sc_config('item_list'))
                ->setPaginate()
                ->getData();

            sc_check_view($this->templatePath . '.screen.shop_product_list');
            return view(
                $this->templatePath . '.screen.shop_product_list',
                array(
                    'title'       => $category->title,
                    'categoryId'  => $category->id,
                    'description' => $category->description,
                    'keyword'     => $category->keyword,
                    'products'    => $products,
                    'category'    => $category,
                    'subCategory' => $subCategory,
                    'layout_page' => 'shop_product_list',
                    'og_image'    => sc_file($category->getImage()),
                    'filter_sort' => $filter_sort,
                    'breadcrumbs' => [
                        ['url'    => sc_route('category.all'), 'title' => sc_language_render('front.categories')],
                        ['url'    => '', 'title' => $category->title],
                    ],
                )
            );
        } else {
            return $this->itemNotFound();
        }
    }
}
