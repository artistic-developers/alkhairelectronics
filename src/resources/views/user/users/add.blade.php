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


  </div>


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
		<form action="/users/add/" method="POST">
		{{ csrf_field() }}
			<div class="row">
			<?php $check = 1; ?>
				<div class="col s3">
					<h1>Add User</h1>
					<div class="input-field">
						<select name="branch_id" id="branch_id" required>
							<option selected disabled>Select branch</option>
							@forelse($branches as $branch)
							<option value="{{ $branch->branch_id }}">{{ $branch->branch_name }}</option>
							@empty
							<option disabled selected>No branches</option>
							@endforelse
						</select>
						<label for="branch_id">User Type</label>
					</div>
					<div class="input-field">
						<select name="user_type" id="user_type" required>
							<option selected disabled>Select type</option>
							<option value="admin">Administrator</option>
							
							<option value="salesman">Salesman</option>
							
						</select>
						<label for="user_type">Full Name</label>
					</div>
					<div class="input-field">
						<input type="text" name="name" id="name" required class="validate" />
						<label for="name">Full Name</label>
					</div>
					<div class="input-field">
						<input type="email" name="email" id="email" required class="validate" />
						<label for="email">Email</label>
					</div>
					<div class="input-field">
						<input type="password" name="password"  required id="password" class="validate" />
						<label for="password">Password</label>
					</div>
					<div class="input-field">
						<input type="password" name="confirm_password" required id="confirm_password" class="validate" />
						<label for="confirm_password">Confirm Password</label>
					</div>
					
					
				</div>
				<div class="col s9">
					<h4>User Rights</h4>
					<div class="row">
					
						<div class="col s3">
						<h6>Books</h6>
							<input type="checkbox" id="purchase_book" name="purchase_book" />
							<label for="purchase_book">Purchase Book</label>

								<input type="checkbox" id="reciept_book" name="reciept_book" />
							<label for="reciept_book">Receipt Book</label>

						</div>
						<div class="col s3">
							<h6>Vouchers</h6>
							<input type="checkbox" id="payment_voucher" name="payment_voucher" />
							<label for="payment_voucher">Payment Voucher</label>

							<input type="checkbox" id="journal_voucher" name="journal_voucher" />
							<label for="journal_voucher">Journal Voucher</label>
							
						</div>
						<div class="col s3">
						<h6>Ledgers</h6>
							<input type="checkbox" id="assets_ledger" name="assets_ledger"/>
							<label for="assets_ledger">Assets Ledger</label>

							<input type="checkbox" id="expenses_ledger" name="expenses_ledger" />
							<label for="expenses_ledger">Expenses Ledger</label>

							<input type="checkbox" id="liabilities_ledger" name="liabilities_ledger"  />
							<label for="liabilities_ledger">Liabilities Ledger</label>

							<input type="checkbox" id="capital_ledger" name="capital_ledger" />
							<label for="capital_ledger">Capital Ledger</label>

							<input type="checkbox" id="stock_ledger" name="stock_ledger" />
							<label for="stock_ledger">Stock Ledger</label>

							<input type="checkbox" id="account_ledger" name="account_ledger" />
							<label for="account_ledger">Account Ledger</label>
						</div>
						<div class="col s3">
						<h6>Others</h6>
							<input type="checkbox" id="stock_manager" name="stock_manager" />
							<label for="stock_manager">Stock Manager</label>

							<input type="checkbox" id="trial_balance" name="trial_balance" />
							<label for="trial_balance">Trial Balance</label>

							<input type="checkbox" id="income_statement" name="income_statement" />
							<label for="income_statement">Income Statement</label>

							<input type="checkbox" id="trial_balance_ageing" name="trial_balance_ageing" />
							<label for="trial_balance_ageing">Trial Balance Ageing</label>

							<input type="checkbox" id="balance_sheet" name="balance_sheet" />
							<label for="balance_sheet">Balance Sheet</label>
						</div>

					</div>
					<div class="row">
						<div class="col s12">
							<button class="btn waves-effect waves-light pull-right" type="submit">Add</button>
						</div>
					</div>

				</div>
				
			</div>

		</form>
	</div>
</div>
@endsection

