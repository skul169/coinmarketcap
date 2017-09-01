<!-- Content Header (Page header) -->
<section class="content-header">

    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Have problem!:</strong> <br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if(Session::has('flash_message'))
    <div class="alert alert-success">
        {{ Session::get('flash_message') }}
    </div>
    @endif
</section>