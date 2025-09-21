<?php
    include '../../api/common/consts.php';
    include '../../api/common/sessions.php';
    include '../../api/common/login_check.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Categories - Admin | Shop Management</title>

  <?php
    include '../../api/common/imports.php';
    import_assets($system);
  ?>

  <style>
    .modal .form-control { border-radius: 6px; }
    /* Table adjustments */
    #categoriesTable th, #categoriesTable td {
        vertical-align: middle;
    }
    #categoriesTable th, #categoriesTable td.actions-column {
        white-space: nowrap; /* prevent wrapping */
    }
    #categoriesTable th.id-column, #categoriesTable td.id-column {
        width: 50px; /* small width for ID */
    }
    #categoriesTable td.actions-column {
        width: 1%; /* shrink to fit buttons */
    }
    #categoriesTable td.actions-column .btn {
        margin-right: 5px; /* space between buttons */
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <?php include '../../pages/reusable/admin/navbar.php'; ?>
    <?php include '../../pages/reusable/admin/sidebar.php'; ?>

    <div class="content-wrapper" style="min-height: 600px;">
      <div class="content-header">
        <div class="container-fluid">
          <div class="d-flex justify-content-between align-items-center">
            <h1 class="m-0 text-dark">Categories</h1>
            <div>
              <button id="btnAddCategory" class="btn btn-success">+ Add Category</button>
            </div>
          </div>
        </div>
      </div>

      <section class="content">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <div class="table-responsive">
                <table id="categoriesTable" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                    <tr>
                      <th class="text-center id-column">ID</th>
                      <th>Name</th>
                      <th class="text-center actions-column">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- populated by JS -->
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <?php include '../../pages/reusable/admin/footer.php'; ?>
  </div>

  <!-- Add Category Modal -->
  <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <form id="addCategoryForm">
          <div class="modal-header">
            <h5 class="modal-title">Add Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="add_category_name">Name</label>
              <input type="text" id="add_category_name" name="name" class="form-control" required autofocus>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success">Add</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Edit Category Modal -->
  <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <form id="editCategoryForm">
          <div class="modal-header">
            <h5 class="modal-title">Edit Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="id" id="edit_category_id">
            <div class="form-group">
              <label for="edit_category_name">Name</label>
              <input type="text" id="edit_category_name" name="name" class="form-control" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

<script>
$(document).ready(function() {
  const apiList = "<?php echo $system; ?>/api/admin/list_category.php";
  const apiCreate = "<?php echo $system; ?>/api/admin/create_category.php";
  const apiUpdate = "<?php echo $system; ?>/api/admin/update_category.php";
  const apiDelete = "<?php echo $system; ?>/api/admin/delete_category.php";

  let table = null;

  function loadCategories() {
    $.ajax({
      url: apiList,
      method: 'GET',
      dataType: 'json'
    }).done(function(res) {
      if(res.status !== 'success') {
        Swal.fire('Error', res.message || 'Failed to load categories', 'error');
        return;
      }

      const rows = res.data || [];

      const tbodyHtml = rows.map((r, index) => `
        <tr>
          <td class="text-center id-column">${index + 1}</td>
          <td>${escapeHtml(r.name)}</td>
          <td class="text-center actions-column">
            <button class="btn btn-sm btn-primary btn-edit me-2" data-id="${r.id}" data-name="${escapeHtml(r.name)}">
              <i class="fa fa-edit"></i>
            </button>
            <button class="btn btn-sm btn-danger btn-delete" data-id="${r.id}">
              <i class="fa fa-trash"></i>
            </button>
          </td>
        </tr>
      `).join('');

      const $table = $('#categoriesTable');
      if ($.fn.DataTable.isDataTable('#categoriesTable')) {
        $table.DataTable().clear().destroy();
      }
      $table.find('tbody').html(tbodyHtml);

      table = $table.DataTable({
        responsive: true,
        pageLength: 10,
        ordering: true,
        columnDefs: [{ orderable: false, targets: 2 }]
      });
    }).fail(function() {
      Swal.fire('Error', 'Failed to fetch categories', 'error');
    });
  }

  function escapeHtml(text) {
    return String(text)
      .replace(/&/g, '&amp;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;')
      .replace(/"/g, '&quot;')
      .replace(/'/g, '&#039;');
  }

  $('#btnAddCategory').on('click', function() {
    $('#addCategoryForm')[0].reset();
    $('#addCategoryModal').modal('show');
    $('#add_category_name').focus();
  });

  $('#addCategoryForm').on('submit', function(e) {
    e.preventDefault();
    const form = $(this);
    $.ajax({
      url: apiCreate,
      method: 'POST',
      data: form.serialize(),
      dataType: 'json',
      beforeSend() { form.find('button[type="submit"]').prop('disabled', true); }
    }).done(function(res) {
      if(res.status === 'success') {
        $('#addCategoryModal').modal('hide');
        Swal.fire({ icon: 'success', title: 'Added', text: res.message, timer: 1200, showConfirmButton: false });
        loadCategories();
      } else {
        Swal.fire('Error', res.message || 'Create failed', 'error');
      }
    }).always(function() { form.find('button[type="submit"]').prop('disabled', false); });
  });

  $(document).on('click', '.btn-edit', function() {
    const id = $(this).data('id');
    const name = $(this).data('name');
    $('#edit_category_id').val(id);
    $('#edit_category_name').val(name);
    $('#editCategoryModal').modal('show');
    $('#edit_category_name').focus();
  });

  $('#editCategoryForm').on('submit', function(e) {
    e.preventDefault();
    const form = $(this);
    $.ajax({
      url: apiUpdate,
      method: 'POST',
      data: form.serialize(),
      dataType: 'json',
      beforeSend() { form.find('button[type="submit"]').prop('disabled', true); }
    }).done(function(res) {
      if(res.status === 'success') {
        $('#editCategoryModal').modal('hide');
        Swal.fire({ icon: 'success', title: 'Updated', text: res.message, timer: 1200, showConfirmButton: false });
        loadCategories();
      } else {
        Swal.fire('Error', res.message || 'Update failed', 'error');
      }
    }).always(function() { form.find('button[type="submit"]').prop('disabled', false); });
  });

  $(document).on('click', '.btn-delete', function() {
    const id = $(this).data('id');
    Swal.fire({
      title: 'Delete category?',
      text: 'This action cannot be undone.',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete',
      cancelButtonText: 'Cancel'
    }).then((result) => {
      if(result.isConfirmed) {
        $.ajax({
          url: apiDelete,
          method: 'POST',
          data: { id },
          dataType: 'json'
        }).done(function(res) {
          if(res.status === 'success') {
            Swal.fire({ icon: 'success', title: 'Deleted', text: res.message, timer: 1000, showConfirmButton: false });
            loadCategories();
          } else {
            Swal.fire('Error', res.message || 'Delete failed', 'error');
          }
        });
      }
    });
  });

  loadCategories();
});
</script>
</body>
</html>
