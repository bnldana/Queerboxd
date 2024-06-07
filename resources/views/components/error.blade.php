@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li><i class="fas fa-times-circle"></i> {!! $error !!}</li>
        @endforeach
    </ul>
</div>
@endif