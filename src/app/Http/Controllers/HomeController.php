<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Branch;
use App\Category;
use App\Company;
use App\Product;
use App\Product_image;
use App\User_right;
use App\User;

use DB;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branches = Branch::all();
        //dd($branches);
        return view('home.home');
    }

    public function products()
    {
        $products = Product::leftJoin('companies AS c', 'c.company_id','products.company_id')
            ->leftJoin('categories AS cat', 'cat.category_id', 'products.category_id')
            ->where('is_deleted','=',0)
            ->paginate(20);

        return view('home.products.products', compact('products'));
    }

    public function add_products()
    {
        $categories = Category::all();
        $companies = Company::all();

        return view('home.products.add', compact('categories', 'companies'));
    }

    public function add_products_post(Request $request)
    {
        if(Auth::user()->type == "admin")
        {
            $code = preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9\\-]/', ' ', urldecode(html_entity_decode(strip_tags($request->product_code)))));
            $nick = preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9\\-]/', ' ', urldecode(html_entity_decode(strip_tags($request->product_nick)))));
            $name = preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9\\-]/', ' ', urldecode(html_entity_decode(strip_tags($request->product_name)))));
            $description = preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9\\-]/', ' ', urldecode(html_entity_decode(strip_tags($request->description)))));
            $quantity = preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9\\-]/', ' ', urldecode(html_entity_decode(strip_tags($request->product_quantity)))));
            $color = preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9\\-]/', ' ', urldecode(html_entity_decode(strip_tags($request->product_color)))));
            $model = preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9\\-]/', ' ', urldecode(html_entity_decode(strip_tags($request->product_model)))));
            $cost_price = preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9\\-]/', ' ', urldecode(html_entity_decode(strip_tags($request->product_cost_price)))));
            $retail_price = preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9\\-]/', ' ', urldecode(html_entity_decode(strip_tags($request->product_retail_price)))));
            $discount = preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9\\-]/', ' ', urldecode(html_entity_decode(strip_tags($request->product_discount)))));
            $slug = str_slug($name);
            $category = preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9\\-]/', ' ', urldecode(html_entity_decode(strip_tags($request->category)))));
            $company = preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9\\-]/', ' ', urldecode(html_entity_decode(strip_tags($request->company)))));

            $code_check = Product::where('product_code','LIKE',$code)->first();
            if(count($code_check) == 1)
            {
                return redirect()->back()->withErrors(['status'=>"Product Code already exists."]);
            }
            else
            {
                $product = new Product;
                $product->product_code = $code;
                $product->nick = $nick;
                $product->product_name = $name;
                $product->description = $description;
                $product->product_slug = $slug;
                $product->category_id = $category;
                $product->company_id = $company;
                $product->color = $color;
                $product->model = $model;
                $product->quantity = $quantity;
                $product->cost_price = $cost_price;
                $product->retail_price = $retail_price;
                $product->discount = $discount;
                $product->save();
                if($request->ajax())
                {

                }   
                else
                {
                    
                    return redirect()->back()->with("status", "Product added."); 
                }
            }
        }
        else
        {
            return redirect()->to('/home');
        }
    }

    public function edit_product($product_id = "")
    {
        if(Auth::user()->type == "admin")
        {
            if($product_id == "")
            {
                return redirect()->to('/products');
            }
            $product_id = preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9\\-]/', ' ', urldecode(html_entity_decode(strip_tags($product_id)))));
            $product = Product::where('product_id','=',$product_id)
                ->first();

            if(count($product) == 1)
            {
                $companies = Company::all();
                $categories = Category::all();

                return view('home.products.edit', compact('product', 'companies', 'categories', 'product_id'));
            }
            else
            {
                return redirect()->to('/products');
            }
        }
    }

    public function edit_product_post(Request $request)
    {
        if(Auth::user()->type == "admin")
        {
            $product_id = preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9\\-]/', ' ', urldecode(html_entity_decode(strip_tags($request->product_id)))));
            $code = preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9\\-]/', ' ', urldecode(html_entity_decode(strip_tags($request->product_code)))));
            $nick = preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9\\-]/', ' ', urldecode(html_entity_decode(strip_tags($request->product_nick)))));
            $name = preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9\\-]/', ' ', urldecode(html_entity_decode(strip_tags($request->product_name)))));
            $description = preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9\\-]/', ' ', urldecode(html_entity_decode(strip_tags($request->description)))));
            $quantity = preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9\\-]/', ' ', urldecode(html_entity_decode(strip_tags($request->product_quantity)))));
            $color = preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9\\-]/', ' ', urldecode(html_entity_decode(strip_tags($request->product_color)))));
            $model = preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9\\-]/', ' ', urldecode(html_entity_decode(strip_tags($request->product_model)))));
            $cost_price = preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9\\-]/', ' ', urldecode(html_entity_decode(strip_tags($request->product_cost_price)))));
            $retail_price = preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9\\-]/', ' ', urldecode(html_entity_decode(strip_tags($request->product_retail_price)))));
            $discount = preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9\\-]/', ' ', urldecode(html_entity_decode(strip_tags($request->product_discount)))));
            $slug = str_slug($name);
            $category = preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9\\-]/', ' ', urldecode(html_entity_decode(strip_tags($request->category)))));
            $company = preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9\\-]/', ' ', urldecode(html_entity_decode(strip_tags($request->company)))));

            $code_check = Product::where('product_code','LIKE',$code)->first();
            if(count($code_check) == 1)
            {
                return redirect()->back()->withErrors(['status'=>"Product Code already exists."]);
            }
            else
            {
                Product::where('product_id','=',$product_id)
                    ->update(
                        [
                            'product_code' => $code,
                            'nick' => $nick,
                            'product_name' => $name,
                            'description' => $description,
                            'product_slug' => $slug,
                            'category_id' => $category,
                            'company_id' => $company,
                            'color' => $color,
                            'model' => $model,
                            'quantity' => $quantity,
                            'cost_price' => $cost_price,
                            'retail_price' => $retail_price,
                            'discount' => $discount
                        ]);

                if($request->ajax())
                {

                }   
                else
                {
                    return redirect()->back()->with("status", "Product edited."); 
                }
            }
        }
        else
        {
            return redirect()->to('/home');
        }
    }

    public function delete_product($id = "")
    {
        $id = preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9\\-]/', ' ', urldecode(html_entity_decode(strip_tags($id)))));

        $check_product = Product::where("product_id",'=',$id)
            ->first();

        if(count($check_product) == 1)
        {
            Product::where('product_id','=',$id)
                ->update(['is_deleted'=>1]);

            return redirect()->back()->with('status',"Product deleted");
        }
        else
        {
            return redirect()->back()->withErrors(['status'=>"Couldn't delete"]);
        }
    }


    public function categories()
    {
        if(Auth::user()->type == "admin")
        {   
            $categories = Category::all();

            return view('home.products.categories', compact('categories'));
        }
    }

    public function add_categories_post(Request $request)
    {
        $category = preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9\\-]/', ' ', urldecode(html_entity_decode(strip_tags($request->category)))));
        $category_check = Category::where('category_name','LIKE',$category)
            ->first();

        if(count($category_check) == 1)
        {
            return redirect()->back()->withErrors(['status'=>"Category with similary name already exists."]);
            
        }
        else
        {
            $cat = new Category;
            $cat->category_name = $category;
            $cat->save();

            if($request->ajax())
            {

            }
            else
            {
                return redirect()->back()->with("status", "Category saved."); 
            }
        }
    }

    public function edit_categories_post(Request $request)
    {
        $category = preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9\\-]/', ' ', urldecode(html_entity_decode(strip_tags($request->category_name)))));
        $category_id = preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9\\-]/', ' ', urldecode(html_entity_decode(strip_tags($request->cat_id)))));
        $category_check = Category::where('category_name','LIKE',$category)
            ->first();

        if(count($category_check) == 1)
        {
            return redirect()->back()->withErrors(['status2'=>"Category with similary name already exists."]);
            
        }
        else
        {
            Category::where('category_id','=',$category_id)
                ->update(
                    [
                        'category_name'=>$category
                    ]);

            if($request->ajax())
            {

            }
            else
            {
                return redirect()->back()->with("status2", "Category saved."); 
            }
        }
    }

    public function companies()
    {
        if(Auth::user()->type == "admin")
        {   
            $companies = Company::all();

            return view('home.products.companies', compact('companies'));
        }
    }

    public function add_companies_post(Request $request)
    {
        $company = preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9\\-]/', ' ', urldecode(html_entity_decode(strip_tags($request->company)))));
        $company_check = Company::where('company_name','LIKE',$company)
            ->first();

        if(count($company_check) == 1)
        {
            return redirect()->back()->withErrors(['status'=>"Company with similary name already exists."]);
            
        }
        else
        {
            $comp = new Company;
            $comp->company_name = $company;
            $comp->save();

            if($request->ajax())
            {

            }
            else
            {
                return redirect()->back()->with("status", "Company saved."); 
            }
        }
    }

    public function edit_companies_post(Request $request)
    {
        $company = preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9\\-]/', ' ', urldecode(html_entity_decode(strip_tags($request->company_name)))));
        $company_id = preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9\\-]/', ' ', urldecode(html_entity_decode(strip_tags($request->comp_id)))));
        $company_check = Company::where('company_name','LIKE',$company)
            ->first();

        if(count($company_check) == 1)
        {
            return redirect()->back()->withErrors(['status2'=>"Company with similary name already exists."]);
            
        }
        else
        {
            Company::where('company_id','=',$company_id)
                ->update(
                    [
                        'company_name'=>$company
                    ]);

            if($request->ajax())
            {

            }
            else
            {
                return redirect()->back()->with("status2", "Company saved."); 
            }
        }
    }
}
