<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Auth;

class Bank extends Model
{
    //



	/*
	 * Use-case method
	 */
	public function setNewBank(Request $request){
		$bank = new Bank;
		$bank->bank_gl_code = $request->bank_gl_code;
		$bank->bank_account_number = $request->bank_account_number;
		$bank->bank_name = $request->bank_name;
		$bank->bank_branch = $request->bank_branch;
		$bank->tenant_id = Auth::user()->tenant_id;
		$bank->save();

	}
	public function updateBank(Request $request){
		$bank = Bank::find($request->bank_id);
		$bank->bank_name = $request->bank_name ?? '';
		$bank->bank_gl_code = $request->bank_gl_code ?? '';
		$bank->bank_account_number = $request->bank_account_number ?? '';
		$bank->bank_branch = $request->bank_branch ?? '';
		$bank->save();

	}
}
