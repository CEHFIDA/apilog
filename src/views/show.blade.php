@extends('adminamazing::teamplate')

@section('pageTitle', 'API логи')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <div class="table-responsive">
                	<form method="GET">
                		<input value="{{$search}}" type="search" placeholder="Поиск..." name="search" class="form-control form-control-line">
                	</form>
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
	<script src="{{ asset('vendor/adminamazing/assets/plugins/footable/js/footable.all.min.js') }}"></script>
	<script src="{{ asset('vendor/adminamazing/assets/plugins/bootstrap-select/bootstrap-select.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('vendor/adminamazing/js/footable-init.js') }}"></script>
@endpush
@endsection