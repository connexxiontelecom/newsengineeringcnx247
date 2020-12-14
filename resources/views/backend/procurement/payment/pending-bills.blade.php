@if (count($pending_bills) > 0)
	@foreach($pending_bills as $item)
		<tr class="item">
				<td>
						<div class="checkbox-fade fade-in-primary">
								<label>
										<input type="checkbox" value="" data-amount="{{number_format(($item->bill_amount - $item->paid_amount)/$item->exchange_rate, 0, ',', '')}}" class="select-invoice">
										<span class="cr">
								<i class="cr-icon icofont icofont-ui-check txt-primary"></i>
						</span>
										<span></span>
								</label>
						</div>
				</td>
				<td>
						<div class="form-group">
								<p><a target="_blank" href="javascript:void(0);">Bill #{{$item->bill_no}} ({{date( Auth::user()->tenant->dateFormat->format ?? 'd/M/Y', strtotime($item->created_at))}})</a></p>
								<input type="hidden" value="{{$item->id}}" name="bills[]">
								<input type="hidden" value="{{$item->exchange_rate}}" name="exchange_rate[]">
								<input type="hidden" value="{{$item->currency_id}}" name="currency[]">
								<input type="hidden" class="bills" name="billsAmount" value="{{$item->bill_amount/$item->exchange_rate}}">
								<input type="hidden" name="description[]" value="Bill #{{$item->bill_no}} ({{date( Auth::user()->tenant->dateFormat->format ?? 'd/M/Y', strtotime($item->created_at))}})">
						</div>
				</td>
				<td>
						<p>{{date( Auth::user()->tenant->dateFormat->format ?? 'd/M/Y', strtotime($item->bill_date))}}</p>
				</td>
				<td>
						<p>{{$item->getCurrency->symbol ??  Auth::user()->tenant->currency->symbol }}{{number_format($item->bill_amount/$item->exchange_rate,2)}}</p>
				</td>
				<td>
						<p>{{$item->getCurrency->symbol ?? Auth::user()->tenant->currency->symbol }}{{number_format(($item->bill_amount  - $item->paid_amount)/$item->exchange_rate,2)}}</p>
				</td>
				<td><input type="text" class="form-control payment autonumber" name="payment[]" style="width: 120px;"></td>
		</tr>
	@endforeach

@else
		<tr>
			<td colspan="5">
				<p>No record found.</p>
			</td>
		</tr>
@endif
