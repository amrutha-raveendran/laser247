<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <!-- FontAwesome -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


</head>

<body style="background-color: black">
    <div class="container-fluid mt-4 mb-4">

        <div class="card mt-4">
            <div class="card-header">
                <h4 class="mb-0 text-center">Event List</h4>
            </div>
            <div class="card-body">
                @if(!empty($events))
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Event Name</th>
                                <th>Competition</th>
                                <th>Open Date</th>
                                <th>In Play</th>
                                <th>Featured Event</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($events as $event)
                            <tr>
                                <td>{{ $event['event_id'] }}</td>
                                <td>{{ $event['name'] }}</td>
                                <td>{{ $event['competition_name'] }}</td>
                                <td>{{ $event['open_date'] }}</td>
                                <td>{{ $event['in_play'] ? 'Yes' : 'No' }}</td>
                                <td>{{ $event['featured_event'] ? 'Yes' : 'No' }}</td>
                                <td>
                                    <a href="{{ route('eventDetail', $event['event_id']) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i> </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <p>No events found.</p>
                    @endif
                </div>
            </div>
        </div>


    </div>

    <!-- Modal -->
    <!-- <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Product Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" alt="Product Image" class="img-fluid" />
                </div>
            </div>
        </div>
    </div> -->

    <!-- Initialize DataTable -->
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                responsive: true,
                paging: true,
                searching: true,
                ordering: true,
                info: true,
            });
        });

        // document.addEventListener('DOMContentLoaded', function() {
        //     var imageModal = document.getElementById('imageModal');
        //     imageModal.addEventListener('show.bs.modal', function(event) {
        //         var button = event.relatedTarget;
        //         var imageUrl = button.getAttribute('data-bs-image');
        //         var modalImage = imageModal.querySelector('#modalImage');
        //         modalImage.src = imageUrl;
        //     });
        // });
    </script>
</body>

</html>