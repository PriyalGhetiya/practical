@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              @include('flash_messages')

                <div class="card-body">
                <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($data))

                    @foreach ($data as $item)
                        <tr>
                            <th scope="row">{{ $item->id  }}</th>
                            <td>{{ $item->name }}</td>
                            <td>
                                <a href="#delete{{ $item->id }}" data-toggle="modal" class="btn btn-danger">
                                    Delete
                                </a>
                                <a href="{{ route('categories.edit',$item->id) }}" class="btn btn-info">Edit</a>
                                <a href="{{ route('categories.create') }}" class="btn btn-success">Create</a>
                            </td>
                        </tr>
                        <div class="modal fade modal-dialog-top " id="delete{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog ">
                                    <div class="modal-content-wrap">
                                        <div class="modal-content">
                                            <div class="modal-header text-left">
                                                <h4 class="modal-title">Message</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            </div>
                                            <div class="modal-body text-left">Are you sure to delete the details?</div>
                                            <div class="modal-footer">
                                                <form action="{{ route('categories.destroy',$item->id) }}" method="POST">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button type="submit" class="btn btn-danger text-white btn-xs">Delete</button>
                                                    <button data-dismiss="modal" class="btn btn-default btn-xs" type="button">Cancel</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    @endforeach
                    @endif
                </tbody>
            </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
