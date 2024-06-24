@extends('app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="text-left">
                <h2 style="font-size:1rem;">受注入力</h2>
            </div>
            <div class="text-right mb-1">
                @auth
                    <a class="btn btn-success" href="{{ route('juchu.create') }}">新規登録</a>
                @endauth
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-12">
            @if ($message = Session::get('success'))
                <div class="alert alert-success mt-1"><p>{{ $message }}</p></div>
            @endif
        </div>
    </div>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>客先</th>
            <th>文房具</th>
            <th>個数</th>
            <th>状態</th>
            <th></th>
            <th></th>
            <th>編集者</th>
        </tr>
        @foreach ($juchus as $juchu)
            <tr>
                <td style="text-align:right">{{ $juchu->id }}</td>
                <td>{{ $juchu->kyakusaki_name }}</td>
                <td>{{ $juchu->bunbougu_name }}</td>
                <td style="text-align:right">{{ $juchu->kosu }}</td>
                <td style="text-align:center">{{ $juchu->joutai }}</td>
                <td style="text-align:center">
                    @auth
                        <a class="btn btn-sm btn-primary" href="{{ route('juchu.edit',$juchu->id) }}">変更</a>
                    @endauth
                </td>
                <td style="text-align:center">
                    @auth
                        <form action="{{ route('juchu.destroy',$juchu->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick='return confirm("削除しますか？")'>削除</button>
                        </form>
                    @endauth
                </td>
                <td>{{ $juchu->user_name }}</td>
            </tr>
        @endforeach
    </table>

    {!! $juchus->links('pagination::bootstrap-5') !!}
@endsection