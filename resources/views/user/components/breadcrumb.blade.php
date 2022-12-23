<ol class="breadcrumb">
    <li class="breadcrumb-item active"><a href="{{route('user.index')}}">{{$parent}}</a></li>
    <li class="breadcrumb-item active">{{$title}}</li>
    @if ( isset( $active ) )
        <li class="breadcrumb-item active">{{$active}}</li>
    @endif 
</ol>