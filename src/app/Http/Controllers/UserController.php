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

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function get_users()
    {
    	$users = User::leftJoin('branches AS b', 'users.branch_id', 'b.branch_id')
    		->where('active','=',1)
    		->get();

    	$admins = array();
    	$salesmen = array();

    	foreach($users as $user)
    	{
    		if($user->type == "admin")
    		{
    			$admins[] = $user;
    		}
    		else if($user->type == "salesman")
    		{
    			$salesmen[] = $user;
    		}
    	}
    	$admins = (object)$admins;
    	$salesmen = (object)$salesmen;

    	return view('user.users.users', compact('admins', 'salesmen'));
    }

    public function add_user()
    {
    	$branches = Branch::all();
    	return view('user.users.add', compact('branches'));
    }

    public function add_user_post(Request $request)
    {
    	$name = preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9\\-]/', ' ', urldecode(html_entity_decode(strip_tags($request->name)))));
    	$branch_id = preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9\\-]/', ' ', urldecode(html_entity_decode(strip_tags($request->branch_id)))));
    	$user_type = preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9\\-]/', ' ', urldecode(html_entity_decode(strip_tags($request->user_type)))));
    	$email = $request->email;
    	$password = $request->password;
    	$confirm_password = $request->confirm_password;

    	$check_email = User::where('email','=',$email)
    		->first();

    	if(count($check_email) == 1)
    	{
    		return redirect()->back()->withErrors(['status' => "Email already exists."]);
    	}
    	else
    	{
    		if($password == $confirm_password)
    		{
    			$password_enc = bcrypt($password);
    			$username = preg_replace('/\s+/', '.', strtolower(preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9\\-]/', ' ', urldecode(html_entity_decode(strip_tags($request->name)))))));
    			$check_username = User::where('username','LIKE',$username)
            		->first();

        		if(count($check_username) == 1)
        		{
        			$last_user = User::orderBy('id', 'DESC')
        				->first();

        			$new_id = $last_user->id + 1;
            		$username = $username.".".$new_id;
        		}
        		
        		$new_user = new User;
        		$new_user->name = $name;
        		$new_user->email = $email;
        		$new_user->password = $password_enc;
        		$new_user->username = $username;
        		$new_user->branch_id = $branch_id;
        		$new_user->type = $user_type;
        		$new_user->save();
        		
        		$new_user_id = $new_user->id;

        		if($request->purchase_book){ $purchase = 1; }elseif(!$request->purchase_book){$purchase = 0;}

		    	if($request->reciept_book){ $reciept = 1; }elseif(!$request->reciept_book){$reciept = 0;}

    			if($request->payment_voucher){ $payment = 1; }elseif(!$request->payment_voucher){$payment = 0;}

    			if($request->journal_voucher){ $journal = 1; }elseif(!$request->journal_voucher){$journal = 0;}

	    		if($request->assets_ledger){ $assets = 1; }elseif(!$request->assets_ledger){$assets = 0;}

	    		if($request->expenses_ledger){ $expenses = 1; }elseif(!$request->expenses_ledger){$expenses = 0;}

    			if($request->liabilities_ledger){ $liabilities = 1; }elseif(!$request->liabilities_ledger){$liabilities = 0;}

	    		if($request->capital_ledger){ $capital = 1; }elseif(!$request->capital_ledger){$capital = 0;}

    			if($request->stock_ledger){ $stock = 1; }elseif(!$request->stock_ledger){$stock = 0;}

	    		if($request->account_ledger){ $account = 1; }elseif(!$request->account_ledger){$account = 0;}

		    	if($request->stock_manager){ $stock_mgr = 1; }elseif(!$request->stock_manager){$stock_mgr = 0;}

    			if($request->trial_balance){ $trial = 1; }elseif(!$request->trial_balance){$trial = 0;}

    			if($request->income_statement){ $income = 1; }elseif(!$request->income_statement){$income = 0;}

		    	if($request->trial_balance_ageing){ $trial_bal = 1; }elseif(!$request->trial_balance_ageing){$trial_bal = 0;}

    			if($request->balance_sheet){ $balance = 1; }elseif(!$request->balance_sheet){$balance = 0;}

    			$user_rights = new User_right;
    			$user_rights->user_id = $new_user_id;
    			$user_rights->purchase_book = $purchase;
    			$user_rights->reciept_book = $reciept;
    			$user_rights->payment_voucher = $payment;
    			$user_rights->journal_voucher = $journal;
    			$user_rights->assets_ledger = $assets;
    			$user_rights->expenses_ledger = $expenses;
    			$user_rights->liabilities_ledger = $liabilities;
    			$user_rights->capital_ledger = $capital;
    			$user_rights->stock_ledger = $stock;
    			$user_rights->account_ledger = $account;
    			$user_rights->stock_manager = $stock_mgr;
    			$user_rights->trial_balance = $trial;
    			$user_rights->income_statement = $income;
    			$user_rights->trial_balance_ageing = $trial_bal;
    			$user_rights->balance_sheet = $balance;
    			$user_rights->save();

    			if($request->ajax())
    			{

    			}
    			else
    			{
    				return redirect()->back()->with('status', "User added");
    			}
    		}
    		else
    		{
    			return redirect()->back()->withErrors(['status' => "Passwords don't match."]);
    		}
    	}
    }

    public function edit_user(Request $request, $id = "")
    {
    	$id = preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9\\-]/', ' ', urldecode(html_entity_decode(strip_tags($id)))));

    	$users = User::leftJoin('branches AS b', 'users.branch_id', 'b.branch_id')
    		->where('active','=',1)
    		->get();

    	$admins = array();
    	$salesmen = array();

    	foreach($users as $user)
    	{
    		if($user->type == "admin")
    		{
    			$admins[] = $user;
    		}
    		else if($user->type == "salesman")
    		{
    			$salesmen[] = $user;
    		}
    	}
    	$admins = (object)$admins;
    	$salesmen = (object)$salesmen;

    	$user = User::where('id','=', $id)
    		->first();

    	if(count($user) == 1)
    	{
    		$user_rights = User_right::where('user_id','=',$id)
    			->first();	
    			//dd($user_rights);
    		if($user->type == "admin")
    		{
    			return view('user.users.users', compact('admins', 'salesmen', 'id', 'user_rights', 'user'));
    		}
    		else if($user->type == "salesman")
    		{
    			$branch = Branch::where('branch_id','=',$user->branch_id)
    				->first();

    			return view('user.users.users', compact('admins', 'salesmen', 'id', 'user_rights', 'user', 'branch'));
    		}
    	}
    	else
    	{
    		return redirect()->to('/users/');
    	}
    }

    public function edit_user_post(Request $request)
    {
    	$check_user = User::where('email','LIKE',$request->email)
    		->where('active','=',1)
    		->first();

    	if(count($check_user) == 1)
    	{
    		$email = $request->email;
    		if($request->purchase_book){ $purchase = 1; }elseif(!$request->purchase_book){$purchase = 0;}

	    	if($request->reciept_book){ $reciept = 1; }elseif(!$request->reciept_book){$reciept = 0;}

    		if($request->payment_voucher){ $payment = 1; }elseif(!$request->payment_voucher){$payment = 0;}

    		if($request->journal_voucher){ $journal = 1; }elseif(!$request->journal_voucher){$journal = 0;}

	    	if($request->assets_ledger){ $assets = 1; }elseif(!$request->assets_ledger){$assets = 0;}

    		if($request->expenses_ledger){ $expenses = 1; }elseif(!$request->expenses_ledger){$expenses = 0;}

    		if($request->liabilities_ledger){ $liabilities = 1; }elseif(!$request->liabilities_ledger){$liabilities = 0;}

	    	if($request->capital_ledger){ $capital = 1; }elseif(!$request->capital_ledger){$capital = 0;}

    		if($request->stock_ledger){ $stock = 1; }elseif(!$request->stock_ledger){$stock = 0;}

    		if($request->account_ledger){ $account = 1; }elseif(!$request->account_ledger){$account = 0;}

	    	if($request->stock_manager){ $stock_mgr = 1; }elseif(!$request->stock_manager){$stock_mgr = 0;}

    		if($request->trial_balance){ $trial = 1; }elseif(!$request->trial_balance){$trial = 0;}

    		if($request->income_statement){ $income = 1; }elseif(!$request->income_statement){$income = 0;}

	    	if($request->trial_balance_ageing){ $trial_bal = 1; }elseif(!$request->trial_balance_ageing){$trial_bal = 0;}

    		if($request->balance_sheet){ $balance = 1; }elseif(!$request->balance_sheet){$balance = 0;}
    	
    		$name = preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9\\-]/', ' ', urldecode(html_entity_decode(strip_tags($request->name)))));
    		$username = preg_replace('/\s+/', '.', strtolower(preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9\\-]/', ' ', urldecode(html_entity_decode(strip_tags($request->name))))))).".".$check_user->id;

    		User::where('id','=',$check_user->id)
    			->update(
    				[
    					'name'=>$name,
    					'email'=>$email
    				]);

    		User_right::where('user_id','=',$check_user->id)
    			->update(
    				[
    					'purchase_book'=>$purchase,
    					'reciept_book'=>$reciept,
    					'payment_voucher'=>$payment,
    					'journal_voucher'=>$journal,
    					'assets_ledger'=>$assets,
    					'expenses_ledger'=>$expenses,
    					'liabilities_ledger'=>$liabilities,
    					'capital_ledger'=>$capital,
    					'stock_ledger'=>$stock,
    					'account_ledger'=>$account,
    					'stock_manager'=>$stock_mgr,
    					'trial_balance'=>$trial,
    					'income_statement'=>$income,
    					'trial_balance_ageing'=>$trial_bal,
    					'balance_sheet'=>$balance
    				]);

    		if($request->ajax())
    		{

    		}
    		else
    		{
    			
    		}
    	}
    	else
    	{
    		return redirect()->back()->withErrors(['status' => "Something went wrong."]);
    	}
    }

    public function edit_user_password_rest_post(Request $request)
    {
    	$check_user = User::where('email','LIKE',$request->email)
    		->first();

    	if(count($check_user) == 1)
    	{
    		$password = $request->password;
    		$confirm_password = $request->confirm_password;

    		if($password == $confirm_password)
    		{
    			$password_enc = bcrypt($password);
    			User::where('id','=',$check_user->id)
    				->update(
    					[
    						'password' => $password
    					]);
    			
    			if($request->ajax())
    			{}
    			else
    			{
    				return redirect()->back()->with('status', "Password changed.");
    			}
    		}
    		else
    		{
    			return redirect()->back()->withErrors(['status'=>"Password didn't match."]);
    		}
    	}
    }
}
