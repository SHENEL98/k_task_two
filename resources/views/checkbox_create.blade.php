@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <section class="row">
                            <div class="col-9">
                                Add Checkbox
                            </div>
                        </section>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="store" method="post" class="was-validated" id="myForm"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="lable">Checkbox lable</label>
                                    <input type="text" class="form-control is-invalid" id="lable" name="lable"
                                        aria-describedby="lableFeedback" autocomplete="off" required>
                                    <div id="lableFeedback" class="invalid-feedback">
                                        Please provide a checkbox lable.
                                    </div>
                                </div>
                            </div>
                            <button  class="btn btn-primary" type="submit">Save</button>

                        </form>
                    </div>
                </div>
                <br>
                <div class="card">
                    <div class="card-header">
                        <section class="row">
                            <div class="col-9">
                                Checkbox List
                            </div>
                        </section>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($checkbox_lables as $checkbox_lable)
                                <li class="list-group-item"> {{ $loop->index+1}} . {{ $checkbox_lable->lable }} -
                                    {{ date('F j, Y, g:i a', strtotime($checkbox_lable['created_at'])) }} 
                                    <a href="destroy/{{$checkbox_lable->id}}">
                                        <button  type="button" class="btn btn-outline-danger float-right">Remove</button>
                                    </a>
                                </li>
                            @endforeach 
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
