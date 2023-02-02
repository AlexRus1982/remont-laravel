<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class WebController extends Controller
{
    //----------------------------------------------------------------------------------
    #region admin functions
    public function categories() {
        $categories = DB::table('categories')
        ->join('hierarchy_category', 'categories.id', '=', 'hierarchy_category.category_id')
        ->orderBy('order_place')
        ->get();

        return '{"server_answer" : "success", "data" : ' . "{$categories}" . ' }';
    }

    public function GetProductsList() {
        $items = DB::table('catalog')
        ->paginate(30);

        return $items;
    }

    public function ProductInfo($id) {
        $product = DB::table('catalog')
        ->where('id', $id)
        ->get();

        return '{"server_answer" : "success", "data" : ' . "{$product}" . ' }';
    }

    public function ProductSave($id, Request $request) {

        $phpData = [];
        foreach($request->savedData as $data){
            $phpData["{$data[0]}"] = $data[1];
        }

        $product = DB::table('catalog')
        ->where('id', $id)
        ->update($phpData);
    
        return '{"server_answer" : "success"}';
    }

    public function categoryParent($id) {
        $category = DB::table('categories')
        ->where('id', $id)
        ->get();

        $categories = DB::table('categories')
        ->join('hierarchy_category', 'categories.id', '=', 'hierarchy_category.category_id')
        ->where('parent_id', $id)
        ->orderBy('order_place')
        ->get();

        return '{"server_answer" : "success", "data" : ' . "{$categories}" . ', "category" : ' . "{$category}" . '}';
    }

    public function categoryInfo($id) {
        $categories = DB::table('categories')
        ->join('hierarchy_category', 'categories.id', '=', 'hierarchy_category.category_id')
        ->where('category_id', $id)
        ->get();

        return '{"server_answer" : "success", "data" : ' . "{$categories}" . ' }';
    }

    public function CreateCategory(Request $request) {
        $id = DB::table('categories')
        ->insertGetId([
            'category_active' => $request->category_active, 
            'category_name'   => $request->category_name,
            'url'             => $request->url,
            'description'     => $request->description,
            //'category_image' => $request->category_image,
        ]);

        DB::table('hierarchy_category')
        ->insert([
            'parent_id' => $request->parent_id, 
            'category_id' => $id,
        ]);

        return '{"server_answer" : "success", "id" : ' . "{$id}" .' }';
    }

    public function SaveCategory($id, Request $request) {
        DB::table('categories')
        ->where('id', $id)
        ->update([
            'category_active' => $request->category_active, 
            'category_name'   => $request->category_name,
            'url'             => $request->url,
            'description'     => $request->description,
            //'category_image' => $request->category_image,
        ]);

        DB::table('hierarchy_category')
        ->updateOrInsert(
            [ 'category_id' => $id, ], //условия поиска
            [ 'parent_id' => $request->parent_id, ] //обновление значений
        );

        return '{"server_answer" : "success" }';
    }

    public function DeleteCategory($id) {
        DB::table('categories')
        ->where('id', $id)
        ->delete();

        DB::table('hierarchy_category')
        ->where('category_id', $id)
        ->delete();

        return '{"server_answer" : "success" }';
    }

    public function ProductsShortList(Request $request) {
        $list = DB::table('catalog')
        ->select(
            'id',
            'Артикул',
            'Фото товара',
            'Наименование',
            'Цена',
            'Включен',
            'URL адрес',
            'Описание'
        )->get();

        return '{"server_answer" : "success", "list" : ' . "{$list}" .' }';
    }

    public function ProductsShortListNotCategory(Request $request) {
        $list = DB::table('catalog')
        ->select(
            'id',
            'Артикул',
            'Фото товара',
            'Наименование',
            'Цена',
            'Включен',
            'URL адрес',
            'Описание'
        )
        ->get();


        $hierarchy = DB::table('hierarchy_products')
        ->select(
            'product_id'
        )
        ->get();

        $hierarchyValues = [];
        foreach ($hierarchy as $item) {
            array_push($hierarchyValues, $item->product_id);
        }

        $notCategorylist = $list->reject(function ($value, $key) use ($hierarchyValues) {
            return in_array($value->id, $hierarchyValues);
        });

        return response()->json([
            "server_answer" => "success",
            "list" => $notCategorylist,
        ]);
    }

    public function ProductsAddToCategory(Request $request) {
        foreach($request->products as $product){
            $item = DB::table('hierarchy_products')
            ->where('parent_id', $product[0])
            ->where('product_id', $product[1])
            ->get();
            if (count($item) == 0){
                DB::table('hierarchy_products')->insert(['parent_id' => $product[0], 'product_id' => $product[1]]);
            }
        }
        
        return '{"server_answer" : "success" }';
    }

    public function ItemsForParent($id) {
        $items = DB::table('catalog')
        ->join('hierarchy_products', 'catalog.id', '=', 'hierarchy_products.product_id')
        ->where('hierarchy_products.parent_id', $id)
        ->orderBy('order_place')
        ->get();

        return '{"server_answer" : "success", "list" : ' . "{$items}" . ' }';
    }

    public function ProductDeleteFromCategory(Request $request) {
        DB::table('hierarchy_products')
        ->where('parent_id', $request->parent_id)
        ->where('product_id', $request->product_id)
        ->delete();

        return '{"server_answer" : "success"}';
    }

    public function ProductsDeleteFromCategory(Request $request) {
        $checkedArray = $request->checkedArray;
        Log::debug(json_encode($checkedArray));

        foreach($checkedArray as $item){
            DB::table('hierarchy_products')
            ->where('parent_id', $item['parent_id'])
            ->where('product_id', $item['product_id'])
            ->delete();
        }

        return '{"server_answer" : "success"}';
    }
    #endregion
    //----------------------------------------------------------------------------------

    //----------------------------------------------------------------------------------
    #region order functions
    public function SetCategoriesOrder(Request $request) {
        foreach ($request->orders as $order) {
            DB::table('hierarchy_category')
            ->where('category_id', $order['id'])
            ->update([
                'order_place' => $order['index']
            ]);
        }
        return '{"server_answer" : "success"}';
    }

    public function SetProductsOrder(Request $request) {
        foreach ($request->orders as $order) {
            DB::table('hierarchy_products')
            ->where('product_id', $order['id'])
            ->update([
                'order_place' => $order['index']
            ]);
        }
        return '{"server_answer" : "success"}';
    }
    #endregion
    //----------------------------------------------------------------------------------
    
    //----------------------------------------------------------------------------------
    #region conditions
    public function GetActiveTab(Request $request) {
        $activeTab = DB::table('admin_conditins')
        ->select('active_tab')
        ->get()[0]->active_tab;

        return '{"server_answer" : "success", "activeTab" : "'. $activeTab .'"}';
    }

    public function SetActiveTab(Request $request) {
        DB::table('admin_conditins')
        ->update(['active_tab' => $request->activeTab]);

        return '{"server_answer" : "success"}';
    }
    #endregion
    //----------------------------------------------------------------------------------
    
    //----------------------------------------------------------------------------------
    #region properties
    /** получение списка свойств
     */
    public function PropertiesList() {
        return view('admin.includes.tabs.tab_properties');
    }

    /** изменение порядка
     *  порядок $request->orders
     */
    public function SetPropertiesOrder(Request $request) {
        foreach ($request->orders as $order) {
            DB::table('properties')
            ->where('id', $order['id'])
            ->update([
                'order_place' => $order['index']
            ]);
        }
        return '{"server_answer" : "success"}';
    }

    /** вставка нового столбца
     *  вставка столбца - ALTER TABLE `catalog` ADD `Свойство: новое` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL AFTER `Свойство: Цена`;
     *  имя нового столбца $request->newName
     */
    public function AddProperty(Request $request) {

        $columnNames = DB::getSchemaBuilder()
        ->getColumnListing('catalog');

        $properties = [];

        foreach($columnNames as $columnName){
            if (mb_strpos($columnName, 'Свойство: ') !== false){
                $properties[] = $columnName;
            }
        }

        if (in_array($request->newName, $properties)) {
            return response()->json([
                "server_answer" => "error",
                "error_type" => "Такое свойство уже есть !!!",
            ]);
        }

        $lastProperty = end($properties);
        $sqlRequest = "ALTER TABLE `catalog` ADD `{$request->newName}` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL AFTER `{$lastProperty}`";

        DB::statement($sqlRequest);

        return response()->json([
            "server_answer" => "success",
            "last_name" => $lastProperty,
        ]);
    }

    /** удаление столбца
     *  удаление столбца - ALTER TABLE `catalog` DROP `Свойство: Тест`;
     *  имя удаляемого столбца $request->columnName
     */
    public function DelProperty(Request $request) {
        $columnNames = DB::getSchemaBuilder()
        ->getColumnListing('catalog');

        if (!in_array($request->columnName, $columnNames)) {
            return response()->json([
                "server_answer" => "error",
                "error_type" => "Нет такого свойства !!!",
            ]);
        }


        $sqlRequest = "ALTER TABLE `catalog` DROP `{$request->columnName}`";
        DB::statement($sqlRequest);

        DB::table('properties')
        ->where('column_name', $request->columnName)
        ->delete();

        return response()->json([
            "server_answer" => "success",
        ]);
    }

    /** переименование столбца
     *  переименование столбца - ALTER TABLE `catalog` CHANGE `Цена` `Цена2` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;
     *  старое имя столбца $request->columnName
     *  новое имя столбца $request->newName
     */
    public function RenameProperty(Request $request) {
        $columnNames = DB::getSchemaBuilder()
        ->getColumnListing('catalog');

        if (!in_array($request->columnName, $columnNames)) {
            return response()->json([
                "server_answer" => "error",
                "error_type" => "Нет такого свойства !!!",
            ]);
        }

        $sqlRequest = "ALTER TABLE `catalog` CHANGE `{$request->columnName}` `{$request->newName}` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL";
        DB::statement($sqlRequest);

        DB::table('properties')
        ->where('column_name', $request->columnName)
        ->update([
            'column_name' => $request->newName, 
        ]);

        return response()->json([
            "server_answer" => "success",
        ]);
    }

    /** показать в фильтре
     *  $id - ид записи своства
     *  $request->inFilter - "1" или "0"
     */
    public function PropertySetFilter($id, Request $request) {
        DB::table('properties')
        ->where('id', $id)
        ->update([
            'in_filtr' => $request->inFilter, 
        ]);

        return response()->json([
            "server_answer" => "success",
        ]);
    }

    /** показать в карточке товара
     *  @param $id - ид записи своства
     *  @param $request->inCard - "1" или "0"
     */
    public function PropertySetCard($id, Request $request) {
        DB::table('properties')
        ->where('id', $id)
        ->update([
            'in_card' => $request->inCard, 
        ]);

        return response()->json([
            "server_answer" => "success",
        ]);
    }

    /** получить список уникальных значений свойства
     *  @param $request->columnName - "1" или "0"
     */
    public function PropertiesValuesList(Request $request) {
        $used = DB::table('catalog')
        ->where([
            [$request->columnName, '<>', 'NULL'],
            [$request->columnName, '<>', ''],
        ])->get();

        return response()->json([
            "server_answer" => "success",
            "values" => $used,
        ]);
    }

    /** получить форму уникальных значений свойства
     *  @param $request->propertyName
     */
    public function PropertiesValuesForm(Request $request) {
        return view('admin.includes.offcanvas.property_values', ['propertyName' => $request->propertyName]);
    }
    #endregion
    //----------------------------------------------------------------------------------

    //----------------------------------------------------------------------------------
    #region tags
    /** получение списка свойств
     */
    public function TagsList() {
        return view('admin.includes.tabs.tab_properties');
    }

    /** изменение порядка
     *  порядок $request->orders
     */
    public function SetTagsOrder(Request $request) {
        foreach ($request->orders as $order) {
            DB::table('tags')
            ->where('property_url', $order['property_url'])
            ->update([
                'property_order' => $order['index']
            ]);
        }
        return '{"server_answer" : "success"}';
    }

    /** вставка нового столбца
     *  список $request->tags
     */
    public function AddTags(Request $request) {

        foreach ($request->tags as $tag) {
            $item = DB::table('tags')
            ->where('property_url', $tag['property_url'])
            ->get();

            if (!count($item)) {
                DB::table('tags')
                ->insert($tag);
            }
        }
    
        return response()->json([ "server_answer" => "success", ]);
    }

    /** удаление столбца
     *  список $request->tags
     *  имя удаляемого столбца $request->columnName
     */
    public function DelTags(Request $request) {

        foreach ($request->tags as $tag) {
            DB::table('tags')
            ->where('property_url', $tag['property_url'])
            ->delete();
        }
    
        return response()->json([ "server_answer" => "success", ]);
    }
    #endregion
    //----------------------------------------------------------------------------------

}
