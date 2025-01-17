<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Management Dashboard</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px; height: 110vh;">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <i class="fas fa-utensils me-2"></i>
                <span class="fs-4">Restaurant Admin</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="#" class="nav-link text-white">
                        <i class="fas fa-home me-2"></i>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link text-white">
                        <i class="fas fa-shopping-cart me-2"></i>
                        Orders
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link text-white">
                        <i class="fas fa-users me-2"></i>
                        Customers
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link text-white">
                        <i class="fas fa-chart-bar me-2"></i>
                        Reports
                    </a>
                </li>
            </ul>
            <hr>
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                    id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="/api/placeholder/32/32" alt="" class="rounded-circle me-2" width="32" height="32">
                    <strong>Admin</strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Sign out</a></li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-grow-1 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Menu Items Management</h2>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addItemModal">
                    <i class="fas fa-plus me-2"></i>Add New Item
                </button>
            </div>

            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-md-3 mx-3">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Total Menu Items</h5>
                            <h2>{{ $totalMenuItems }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mx-5">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Active Items</h5>
                            <h2>{{ $totalMenuItems }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mx-5">
                    <div class="card bg-warning text-dark mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Categories</h5>
                            <h2>{{ $categoryCount }}</h2> <!-- Display the actual count -->
                        </div>
                    </div>
                </div>

            </div>

            <!-- Menu Items Table -->

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($menuItems as $item)
                                <tr id="row-{{ $item->id }}">
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        <img src="{{ $item->image }}" alt="{{ $item->name }}" class="rounded"
                                            width="50">
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->category->name ?? 'Uncategorized' }}</td>
                                    <td>${{ number_format($item->price, 2) }}</td>
                                    <td>

                                        <button class="btn btn-sm btn-primary edit-btn" data-bs-toggle="modal"
                                            data-bs-target="#editItemModal" data-id="{{ $item->id }}"
                                            data-name="{{ $item->name }}"
                                            data-category="{{ $item->category->name ?? 'Uncategorized' }}"
                                            data-price="{{ $item->price }}" data-description="{{ $item->description }}"
                                            data-image="{{ $item->image }}">
                                            <i class="fas fa-edit"></i>
                                        </button>


                                        <button class="btn btn-sm btn-danger delete-btn" data-bs-toggle="modal"
                                            data-bs-target="#deleteItemModal" data-id="{{ $item->id }}"
                                            data-name="{{ $item->name }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Delete Confirmation Modal -->
            <div class="modal fade" id="deleteItemModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Confirm Delete</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete <strong id="deleteItemName"></strong>?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Custom Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="text-muted">
                    Showing <span class="fw-semibold">{{ $menuItems->firstItem() }}</span>
                    to <span class="fw-semibold">{{ $menuItems->lastItem() }}</span>
                    of <span class="fw-semibold">{{ $menuItems->total() }}</span> entries
                </div>
                <nav aria-label="Page navigation">
                    <ul class="pagination mb-0">
                        <!-- Previous Page Link -->
                        @if ($menuItems->onFirstPage())
                        <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                        @else
                        <li class="page-item"><a class="page-link"
                                href="{{ $menuItems->previousPageUrl() }}">Previous</a></li>
                        @endif

                        <!-- Page Number Links -->
                        @foreach ($menuItems->getUrlRange(1, $menuItems->lastPage()) as $page => $url)
                        <li class="page-item {{ $menuItems->currentPage() == $page ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                        @endforeach

                        <!-- Next Page Link -->
                        @if ($menuItems->hasMorePages())
                        <li class="page-item"><a class="page-link" href="{{ $menuItems->nextPageUrl() }}">Next</a></li>
                        @else
                        <li class="page-item disabled"><a class="page-link" href="#">Next</a></li>
                        @endif
                    </ul>
                </nav>
            </div>


        </div>
    </div>

    <!-- Add Item Modal -->
    <div class="modal fade" id="addItemModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Menu Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('save-items') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- CSRF Token -->
                        <div class="mb-3">
                            <label class="form-label">Item Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <input type="text" class="form-control" name="category" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Price</label>
                            <input type="number" step="0.01" class="form-control" name="price" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" rows="3" name="description" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Image</label>
                            <input type="file" class="form-control" name="image">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Item</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <!-- Edit Item Modal -->
    <div class="modal fade" id="editItemModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Menu Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <div class="mb-3">
                            <label class="form-label">Item Name</label>
                            <input type="text" class="form-control" id="editItemName" name="item_name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <input type="text" class="form-control" id="editCategory" name="category" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Price</label>
                            <input type="number" step="0.01" class="form-control" id="editPrice" name="price" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" id="editDescription" name="description" rows="3"
                                required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Image</label>
                            <input type="file" class="form-control" name="image">
                            <img id="editImagePreview" class="img-thumbnail mt-2" width="100">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

</body>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.edit-btn');
    const editForm = document.getElementById('editForm');

    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            // Get data from button
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');
            const category = this.getAttribute('data-category');
            const price = this.getAttribute('data-price');
            const description = this.getAttribute('data-description');
            const image = this.getAttribute('data-image');

            // Populate modal form fields
            document.getElementById('editItemName').value = name;
            document.getElementById('editCategory').value = category;
            document.getElementById('editPrice').value = price;
            document.getElementById('editDescription').value = description;
            document.getElementById('editImagePreview').src = image;
        });
    });
});
</script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.delete-btn');
    const deleteItemName = document.getElementById('deleteItemName');
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');

    let deleteItemId = null; // Store the ID of the item to delete

    // When a delete button is clicked
    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            deleteItemId = this.getAttribute('data-id');
            const itemName = this.getAttribute('data-name');
            deleteItemName.textContent = itemName; // Set item name in modal
        });
    });

    // When the confirm delete button is clicked
    confirmDeleteBtn.addEventListener('click', function () {
        if (deleteItemId) {
            fetch(`/delete-item/${deleteItemId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Remove the row from the table
                    document.getElementById(`row-${deleteItemId}`).remove();
                    // Close the modal
                    const deleteModal = bootstrap.Modal.getInstance(document.getElementById('deleteItemModal'));
                    deleteModal.hide();
                } else {
                    alert('Failed to delete the item.');
                }
            })
            .catch(error => console.error('Error:', error));
        }
    });
});

</script>

</html>