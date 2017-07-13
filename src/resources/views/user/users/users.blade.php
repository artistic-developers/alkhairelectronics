@extends('layouts.app')

@section('title')
Users
@endsection

@section('content')

<div class="">
<nav>
    <div class="nav-wrapper">
      <ul class="hide-on-med-and-down">
        <li><a class="waves-effect waves-light btn" href="/users/">All Users</a></li>
        <li><a class="waves-effect waves-light btn" href="/users/add">Add Users</a></li>

      </ul>
    </div>
  </nav>
  
  <div class="row">
    <div class="col s6">
      
      
      <h5>Admins</h5>
      <table class="highlight striped bordered">
        <thead>
          <tr>
            <th>Name</th>
            <th>Email</th>
            @if(Auth::user()->type == "admin")
            <th>Action</th>
            @endif
          </tr>
        </thead>
        <tbody>
          @forelse($admins as $admin)
          <tr>
            <td>{{ $admin->name }}</td>
            <td>{{ $admin->email }}</td>
            @if(Auth::user()->type == "admin")
            <td><a class="waves-effect waves-light btn" href="/users/edit/{{ $admin->id }}">edit</a></td>
           
            @endif
             </tr>
            @empty
            <tr><td>No admin, yet.</td></tr>
            @endforelse
            
          </tbody>
        </table>
      </div>

      <div class="col s6">
      
      
      <h5>Salesmen</h5>
      <table class="highlight striped bordered">
        <thead>
          <tr>
            <th>Name</th>
            <th>Branch</th>
            <th>Email</th>
            @if(Auth::user()->type == "admin")
            <th>Action</th>
            @endif
          </tr>
        </thead>
        <tbody>
          @forelse($salesmen as $salesman)
          <tr>
            <td>{{ $salesman->name }}</td>
            <td>{{ $salesman->branch_name }}</td>
            <td>{{ $salesman->email }}</td>
            @if(Auth::user()->type == "admin")
            <td><a class="waves-effect waves-light btn" href="/users/edit/{{ $salesman->id }}">edit</a></td>
            @endif
            </tr>
            @empty
            <tr><td>No salesman, yet.</td></tr>
            @endforelse
            
            
          </tbody>
        </table>
      </div>
    </div>

  </div>

@if(isset($user))
<div class="row">
	<div class="col s12">
	@if ($errors->has('status'))
                <div class="alert alert-danger">
                    {{ $errors->first('status') }}
                </div>
                @endif
                @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                @endif
		<form action="/users/edit/" method="POST">
		{{ csrf_field() }}
			<div class="row">
			<?php $check = 1; ?>
				<div class="col s3">
					<h4>{{ $user->name }}</h4>
					<div class="input-field">
						<input type="text" name="name" id="name" value="{{ $user->name }}" required class="validate" />
						<label for="name">Full Name</label>
					</div>
					<div class="input-field">
						<input type="email" name="email" id="email" value="{{ $user->email }}" required class="validate" />
						<label for="email">Email</label>
					</div>
					<div class="input-field">
					<button class="btn waves-effect waves-light" type="submit">Save</button>&nbsp;&nbsp;OR&nbsp;&nbsp;
					<a href="#" data-toggle="collapse" data-target="#reset_password">reset password</a>
				</div>
					
				</div>
				<div class="col s9">
					<h4>User Rights</h4>
					<div class="row">
					
						<div class="col s3">
						<h6>Books</h6>
							<input type="checkbox" id="purchase_book" name="purchase_book" @if($user_rights->purchase_book == $check) checked @endif />
							<label for="purchase_book">Purchase Book</label>

								<input type="checkbox" id="reciept_book" name="reciept_book" @if($user_rights->reciept_book == $check) checked @endif />
							<label for="reciept_book">Receipt Book</label>

						</div>
						<div class="col s3">
							<h6>Vouchers</h6>
							<input type="checkbox" id="payment_voucher" name="payment_voucher" @if($user_rights->payment_voucher == $check) checked @endif />
							<label for="payment_voucher">Payment Voucher</label>

							<input type="checkbox" id="journal_voucher" name="journal_voucher" @if($user_rights->journal_voucher == $check) checked @endif />
							<label for="journal_voucher">Journal Voucher</label>
							
						</div>
						<div class="col s3">
						<h6>Ledgers</h6>
							<input type="checkbox" id="assets_ledger" name="assets_ledger" @if($user_rights->assets_ledger == $check) checked @endif />
							<label for="assets_ledger">Assets Ledger</label>

							<input type="checkbox" id="expenses_ledger" name="expenses_ledger" @if($user_rights->expenses_ledger == $check) checked @endif />
							<label for="expenses_ledger">Expenses Ledger</label>

							<input type="checkbox" id="liabilities_ledger" name="liabilities_ledger" @if($user_rights->liabilities_ledger == $check) checked @endif />
							<label for="liabilities_ledger">Liabilities Ledger</label>

							<input type="checkbox" id="capital_ledger" name="capital_ledger" @if($user_rights->capital_ledger == $check) checked @endif />
							<label for="capital_ledger">Capital Ledger</label>

							<input type="checkbox" id="stock_ledger" name="stock_ledger" @if($user_rights->stock_ledger == $check) checked @endif />
							<label for="stock_ledger">Stock Ledger</label>

							<input type="checkbox" id="account_ledger" name="account_ledger" @if($user_rights->account_ledger == $check) checked @endif />
							<label for="account_ledger">Account Ledger</label>
						</div>
						<div class="col s3">
						<h6>Others</h6>
							<input type="checkbox" id="stock_manager" name="stock_manager" @if($user_rights->stock_manager == $check) checked @endif />
							<label for="stock_manager">Stock Manager</label>

							<input type="checkbox" id="trial_balance" name="trial_balance" @if($user_rights->trial_balance == $check) checked @endif />
							<label for="trial_balance">Trial Balance</label>

							<input type="checkbox" id="income_statement" name="income_statement" @if($user_rights->income_statement == $check) checked @endif />
							<label for="income_statement">Income Statement</label>

							<input type="checkbox" id="trial_balance_ageing" name="trial_balance_ageing" @if($user_rights->trial_balance_ageing == $check) checked @endif />
							<label for="trial_balance_ageing">Trial Balance Ageing</label>

							<input type="checkbox" id="balance_sheet" name="balance_sheet" @if($user_rights->balance_sheet == $check) checked @endif />
							<label for="balance_sheet">Balance Sheet</label>
						</div>

					</div>

				</div>
				
			</div>
		</form>
		<div class="row">
			<div class="col s4">
				<form id="reset_password" class="collapse" action="/users/edit/password/reset" method="POST">
					{{ csrf_field() }}
					<input type="email" class="hidden" name="email" value="{{ $user->email }}"/>
					<div class="input-field">
						<input type="password" name="password" id="password" class="validate" />
						<label for="password">Password</label>
					</div>
					<div class="input-field">
						<input type="password" name="confirm_password" id="confirm_password" class="validate" />
						<label for="confirm_password">Confirm Password</label>
					</div>
					<div class="input-field">
						<button class="btn waves-effect waves-light" type="submit">Reset Password</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
 @endif
@endsection

