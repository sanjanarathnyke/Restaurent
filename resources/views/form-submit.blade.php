<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Menu Item</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card shadow-lg">
          <div class="card-header bg-primary text-white">
            <h2 class="mb-0">Create Menu Item</h2>
          </div>

          <div class="card-body">
            <form method="POST" action="{{ route('menu_items.store') }}" enctype="multipart/form-data">
              @csrf
              <div class="mb-4">
                <h4 class="text-primary mb-3">Category Details</h4>
                <div class="form-group">
                  <label for="categoryName" class="form-label">Category Name</label>
                  <input type="text" 
                         class="form-control"
                         id="categoryName"
                         name="categoryName"
                         placeholder="Enter category name" />
                </div>
              </div>

              <div class="mb-4">
                <h4 class="text-primary mb-3">Menu Item Details</h4>
                
                <div class="form-group mb-3">
                  <label for="menuItemName" class="form-label">Menu Item Name</label>
                  <input type="text"
                         class="form-control"
                         id="menuItemName"
                         name="menuItemName"
                         placeholder="Enter menu item name" />
                </div>

                <div class="form-group mb-3">
                  <label for="description" class="form-label">Description</label>
                  <textarea class="form-control"
                            id="description"
                            name="description"
                            rows="4"
                            placeholder="Enter description"></textarea>
                </div>

                <div class="form-group mb-3">
                  <label for="price" class="form-label">Price</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">$</span>
                    </div>
                    <input type="number"
                           class="form-control"
                           id="price"
                           name="price"
                           placeholder="Enter price" />
                  </div>
                </div>

                <div class="form-group mb-4">
                  <label for="image" class="form-label">Upload Image</label>
                  <input type="file"
                         class="form-control"
                         id="image"
                         name="image" />
                </div>
              </div>

              <button type="submit"
                      class="btn btn-primary w-100 py-2">
                Create Menu Item
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
