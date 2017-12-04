@extends('adminamazing::teamplate')

@section('pageTitle', 'API логи')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
				<form name="search-form" method="GET">
					<div class="row p-t-20">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Токен</label>
                                <input type="text" class="form-control form-control-line" value="{{$token}}" name="token">
                        	</div>
	                        <div class="form-group">
	                            <label class="control-label">IP</label>
	                            <input type="text" class="form-control form-control-line" value="{{$ip}}" name="ip">
	                    	</div>
	                    </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Путь</label>
                                <input type="text" class="form-control form-control-line" value="{{$url}}" name="url">
                        	</div>
	                        <div class="form-group">
	                            <label class="control-label">Ответ</label>
	                            <textarea rows="4" class="form-control form-control-line" name="answer">{{$answer}}</textarea>
	                    	</div>
	                    </div>
	                    <div class="col-md-2">
	                    	<div class="form-group">
	                    		<label class="control-label">Статус</label>
								<select multiple size="{{count($statusCodes)}}" class="form-control" name="status[]">
								    @foreach($statusCodes as $row)
								    <option value="{{$row->status}}">{{$row->status}}</option>
								    @endforeach
								</select>
	                    	</div>
	                    </div>
	                    <div class="col-md-2">   
	                    	<div class="form-group">
	                    		<label class="control-label">Метод</label>
								<select multiple size="{{count($methods)}}" class="form-control" name="method[]">
								    @foreach($methods as $row)
									<option value="{{$row->method}}">{{$row->method}}</option>
								    @endforeach
								</select>
	                    	</div>
	                    </div>
	                    <div class="col-md-4">
	                    	<button type="submit" class="btn btn-success btn-block">Поиск</button>
	                    </div>
		                <div class="col-md-4">
		                    <button type="button" class="btn btn-info btn-block clearForm">Очистить форму</button>
		                </div>
	                </div>
                </form>
                <div class="table-responsive">
                	@if(count($logs) > 0)
                    <table id="demo-foo-addrow" class="table m-t-30 table-hover no-wrap contact-list" data-page-size="10">
                        <thead>
                            <tr>
                                <th>ID #</th>
                                <th>Токен</th>
                                <th>Метод</th>
                                <th>IP</th>
                                <th>Путь</th>
                                <th>Статус</th>
                                <th>Ответ</th>
                                <th>Дата</th>
                            </tr>
                        </thead>
                        <tbody>
						@foreach($logs as $log)
                        <tr>
                        	<td>{{$log->id}}</td>
                        	<td>{{$log->token}}</td>
                        	<td>{{$log->method}}</td>
                        	<td>{{$log->ip}}</td>
                        	<td>{{$log->url}}</td>
                        	<td>{{$log->status}}</td>
                        	<td>{{$log->answer}}</td>
                        	<td>{{$log->created_at}}</td>
                        </tr>
						@endforeach
                        </tbody>
                	</table>
	                <nav aria-label="Page navigation example" class="m-t-40">
			             {{ $logs->links('vendor.pagination.bootstrap-4') }}
			        </nav>
			        @else
                    <div class="alert text-center">
                        <h3 class="text-info"><i class="fa fa-exclamation-circle"></i> Information</h3> Ничего не найдено
                    </div>			        
			        @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
	<script>
		$(document).on('click', '.clearForm', function(){
			$('form[name=search-form]').trigger('reset');
			window.location.href = '{{route('AdminApiLog')}}';
		});
	</script>
@endpush

@endsection