@extends('layouts.main')
@section('content')
<div class="main-container">
  <!-- Include Sidebar Component -->
        @include('components.sidebar')
  <!-- Your other content or sections can go here -->
  <main class="main-content">
      <div class="row">
            <div class="col-md-8">
            <h2>Main Content Area</h2>
            <p>This is where your main content goes.</p>
            </div>
            <div class="col-md-4">
                  <div class="open-bets">
                        <h2>Open Bets</h2>
                  </div>
            </div>
      </div>
           
 </main>
 </div>
@endsection

