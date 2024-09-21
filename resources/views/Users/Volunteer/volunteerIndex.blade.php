@section('title')
    Volunteer Dashboard
@endsection

@extends('Users.Volunteer.layouts.app')

@section('content')
<br><br><br><br><br><br>
<!-- Start breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('volunteer#index') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Volunteer Dashboard</li>
        </ol>
    </nav>

<!-- END breadcrumb -->

<div class="container">
    <div class="card mt-4 mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped" >

            <thead>
              <tr>
                <th>No.</th>
                <th>User Id</th>
                <th>Partner Id</th>
                <th>Member Id</th>
                <th>Meal Id</th>
                <th>Delivery Address</th>
                <th>Action</th>
              </tr>
            </thead>

            <tbody>
                @foreach ($order as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->user_id }}</td>
                        <td>{{ $item->partner_id }}</td>
                        <td>{{ $item->member_id }}</td>
                        <td>{{ $item->meal_id }}</td>
                        <td>{{ $item->delivery_address }}</td>
                        <td>
                            <a href="{{ route('volunteer#volunteerDetails', $item->id) }}">
                                <button type="button" class="btn btn-outline-primary" > Track Order</button>
                            </a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>


@endsection
