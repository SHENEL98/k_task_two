@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <section class="row">
                            <div class="col-9">
                                {{ __('Dashboard') }}
                            </div>
                            <div class="col-3">
                                <a href="checkbox/create" title="Add New"> <button type="button"
                                        class="btn btn-success float-right">Add Checkboxes</button> </a>
                            </div>
                        </section>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                    </div>
                    <div class="card-body">
                        <ul class="list-group" id="list_checkbox">
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            checkbox_list();
        });

        function checkbox_list() {
            $.ajax({
                url: 'get_checkbox_list',
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                error: function(error) {
                    console.log(error);
                },
                success: function(r) {
                    // console.log(r);
                    let value = '';

                    for (var list in r) {
                        value += '<li class="list-group-item">';

                        if (r[list].status == 1) {
                            value += '<h4><input type="checkbox" name="myCheckbox[]" value="' + r[list].id +
                                '"data-id="' + r[list].id + '" onclick="toggleCheckbox(this)" checked>  ' + r[
                                    list].lable + '</h4>';

                            value += '<span class="badge badge-pill badge-info">Created By : ' + r[list]
                                .created_by +
                                '</span>';

                        } else {
                            value += '<h4><input type="checkbox" name="myCheckbox[]" value="' + r[list].id +
                                '"data-id="' + r[list].id + '" onclick="toggleCheckbox(this)">  ' + r[list]
                                .lable + '</h4>';

                            value += '<span class="badge badge-pill badge-info">Created By : ' + r[list]
                                .created_by +
                                '</span>';

                        }
                        if (r[list].set_status_by != null) {
                            if (r[list].status == 1) {
                                value += '<span class="badge badge-pill badge-success">Checked By : ' + r[list]
                                    .set_status_by +
                                    '</span>';
                            } else {
                                value += '<span class="badge badge-pill badge-danger">Unchecked By : ' + r[list]
                                    .set_status_by +
                                    '</span>';
                            }

                        }

                        value += '</li>';
                    }
                    $('#list_checkbox').html(value);
                }
            });
        }


        function toggleCheckbox(checkbox) {
            var id = $(checkbox).data('id');
            var isChecked = $(checkbox).is(':checked');

            // console.log(id);
            // console.log(isChecked);
            $.ajax({
                url: 'update_checkbox',
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id,
                    isChecked: isChecked,
                },
                dataType: 'json',
                error: function(error) {
                    console.log(error);
                },
                success: function(r) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'CheckBox Updated',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    checkbox_list();
                }
            });
        }
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@endsection
