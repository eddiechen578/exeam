<div class="col-md-2 text-center">
    <div class="card">
        <div class="card-header">
            類別
        </div>
        <div class="card-body">
            <ul class="list-group">
                @foreach($categories as $category)
                <li class="list-group-item">
                   <a href="{{route('merchandise.index')}}?category={{$category->slug}}">
                       {{$category->name}}
                   </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@push('style')
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    <style>


    </style>
@endpush