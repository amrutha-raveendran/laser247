@extends('layouts.main')
@section('content')
<div class="main-container">
  <!-- Include Sidebar Component -->
        @include('components.sidebar')
  <!-- Your other content or sections can go here -->
  <main class="main-content">
            <h2>Main Content Area</h2>
            <p>This is where your main content goes.</p>
 </main>
 </div>
@endsection

