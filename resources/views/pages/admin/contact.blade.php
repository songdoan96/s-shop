@extends('admin')
@section('admin_content')
    <div class="container-fluid px-4 content">
        <h4 class="mt-4">Phản hồi</h4>
        <div class="card my-4">
            <div class="card-header">
                Phản hồi
            </div>
            <div class="card-body">
                @if (count($contacts) > 0)
                    <table class="table table-bordered table-striped">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>#</th>
                                <th>Họ tên</th>
                                <th>Email</th>
                                <th>SĐT</th>
                                <th>Tin nhắn</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contacts as $key => $contact)
                                <tr>
                                    <th>{{ ++$key }}</th>
                                    <td>{{ $contact->name }}</td>
                                    <td>{{ $contact->email }}</td>
                                    <td>{{ $contact->phone }}</td>
                                    <td>{{ $contact->comment }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $contacts->links('pages.admin.pagination') }}
                @else
                    <h3>Không tìm thấy phản hồi !</h3>
                @endif

            </div>
        </div>
    </div>
@endsection
