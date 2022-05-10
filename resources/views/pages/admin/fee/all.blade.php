@extends('admin')
@section('admin_content')
    <div class="container-fluid px-4 content">
        <h4 class="mt-4">Phí vận chuyển</h4>
        <div class="card my-4">
            <div class="card-header">
                <button data-bs-toggle="modal" data-bs-target="#modalCreate" class="btn btn-primary float-end">Thêm
                    phí</button>
            </div>
            <div class="card-body">

                @if ($fees)
                    <table class="table table-bordered table-striped">
                        <thead class="bg-success text-white">
                            <tr>
                                <th>#</th>
                                <th>Tỉnh</th>
                                <th>Quận huyện</th>
                                <th>Xã</th>
                                <th>Phí ship</th>
                                {{-- <th>Tùy chọn</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fees as $key => $fee)
                                <tr>
                                    <th>{{ ++$key }}</th>
                                    <td>{{ $fee->city->tp_name }}</td>
                                    <td>{{ $fee->province->qh_name }}</td>
                                    <td>{{ $fee->ward->xa_name }}</td>
                                    <td>{{ formatCurrent($fee->price) }}</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- {{ $fees->links('pages.admin.pagination') }} --}}
                @else
                    <h3>Chưa có phí vận chuyển !</h3>
                @endif


            </div>
        </div>
    </div>

    @include('pages.admin.fee.add')
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            // Edit
            //   $(".edit_fee").click(function(e) {
            //     let id = e.target.dataset.id;
            //     let url = `{{ url('/admin/edit-fee/${id}') }}`;
            //     $(`#modalEdit${id}`).remove();
            //     $.ajax({
            //       url,
            //       method: "POST",
            //       data: {
            //         "_token": "{{ csrf_token() }}",
            //       },
            //       success: function(res) {
            //         $(".content").after(res);
            //         $(`#modalEdit${id}`).modal("show");
            //       }
            //     })
            //   })

            //   $(".delete_fee").click(function(e) {

            //     let id = e.target.dataset.id;
            //     let url = `{{ url('/admin/delete-fee/${id}') }}`;
            //     $(`#modalDelete${id}`).remove();
            //     $.ajax({
            //       url,
            //       method: "POST",
            //       data: {
            //         "_token": "{{ csrf_token() }}",
            //       },
            //       success: function(res) {
            //         $(".content").after(res);
            //         $(`#modalDelete${id}`).modal("show");
            //       }
            //     })
            //   })
        });
    </script>
@endpush
