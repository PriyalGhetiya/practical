@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
            <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered w-100 text-nowrap">
                <thead>
                    <tr>
                        <th class="wd-10p">No</th>
                        <th >Name</th>
                        <th >Description</th>
                        <th class="wd-10p">Image</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $record)
                    <tr>
                        <td>{{ $key }}</td>
                        <td>{{ $record->name }}</td>
                        <td>{{ $record->description }}</td>
                        <td class="text-center">
                               <img src="{{url('/assets/'.$record->image)}}" alt="Image" style="width:100px;height:100px"/>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
