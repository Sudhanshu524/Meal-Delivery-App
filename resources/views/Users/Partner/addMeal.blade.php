@section('title')
    Partner Create Meal
@endsection

@extends('Users.Partner.layouts.app')

@section('content')
<style type="text/css">
    #createm{
        max-width: 500px;
        padding: 50px;
        height: auto;
        width: 100%;
        margin: 50px auto;
        background-color: rgba(136, 135, 135, 0.337);
        border: 1px solid rgba(0,0,0,0.1);
    }
</style>
<br><br><br><br><br><b><b></b></b>
<!-- Start breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('partner#index') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('partner#index') }}">Partner Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create menu</li>
        </ol>
    </nav>

<!-- END breadcrumb -->

<!-- Start content -->
<div class="container">
    <div class="row">
      <div class="col col-sm-6" id="createm">
          <form action="{{ route('partner#createMeal') }}" method="POST" enctype="multipart/form-data">
              @csrf
            <div class="form-foating py-3">
                <h3 class="text-center" ><b> Create Menu </b></h3>
            </div>
            <div class="form-floating mb-3">
                <label for="name">Meal Name</label>
              <input type="text" class="form-control" id="floatingInput" placeholder="name" name="meal_name">
             

                {{-- Validation  --}}
                @if ($errors->has('meal_name'))
                    <p class="text-danger">
                        {{ $errors->first('meal_name') }}
                    </p>
                @endif
                {{-- end of validation  --}}

            </div>

            <div class="form-floating mb-3">
                <label for="name">Meal Type</label>
              <input type="text" class="form-control" id="floatingInput" placeholder="name" name="meal_type">
          

              {{-- Validation  --}}
                @if ($errors->has('meal_type'))
                    <p class="text-danger">
                        {{ $errors->first('meal_type') }}
                    </p>
                @endif
                {{-- end of validation  --}}

            </div>

            <div class="form-floating mb-3">
                <label for="formFile">Meal Image</label>
              <input type="file" class="form-control" id="floatingInput" placeholder="name" name="meal_image">
      

                {{-- Validation  --}}
                @if ($errors->has('meal_image'))
                    <p class="text-danger">
                        {{ $errors->first('meal_image') }}
                    </p>
                @endif
                {{-- end of validation  --}}
            </div>
<br>



            <div class="form-floating mb-3">
                <select name="partner" class="form-control">
                    <option value="">Choose Organization Name</option>
                    @foreach ($partnerData as $partner)
                        <option value="{{ $partner->id }}">{{ $partner->partner_organization }}</option>
                    @endforeach
                </select>
            </div>
            <br>

            <div class="form-floating mb-3">
                <select name="user" class="form-control">
                    <option value="">Choose Address</option>
                    @foreach ($userData as $user)
                        <option value="{{ $user->id }}">
                            @if ($user->role == 'partner')
                                {{ $user->address }}
                            @endif
                        </option>
                    @endforeach
                </select>
            </div>
            <br>

            <button type="submit" class="btn btn-blue" style="float: right;">Create
            </button>
            <button type="reset" class="btn btn-red" style="float: right;margin-right: 20px;">Clear</button>

        </form>

      </div>
    </div>
  </div>

<!-- End content-->
@endsection
