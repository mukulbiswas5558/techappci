$(document).ready(function() {
  const table = $('#countryTable').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
          url: `${base_url}details/fetch_countries`,
          type: "POST"
      },
      columns: [
            {
              "data": null,
              "name": "id",
              "render": function(data, type, row, meta) {
                  var currentPage = table.page.info().page; // Get current page index
                  var pageLength = table.page.info().length; // Get number of rows per page
                  var serialNumber = currentPage * pageLength + meta.row + 1; // Calculate serial number

                  return serialNumber;
              }
          },
          { data: "iso" },
          { data: "name" },
          { data: "nicename" },
          { data: "numcode" },
          { data: "phonecode" },
          { data: "capital" },
          {
              data: null,
              name: "action",
              orderable: false,
              searchable: false,
              render: function (data, type, row) {
                  return `
                      <div style="display: flex; column-gap: 5px; justify-content: center;">
                          <button class="btn btn-primary edit-btn" data-id="${row.id}" data-name="${row.name}" 
                              data-iso="${row.iso}" data-nicename="${row.nicename}" 
                              data-numcode="${row.numcode}" data-phonecode="${row.phonecode}">
                              <i class="fa fa-edit"></i>
                          </button>
                          <button class="btn btn-danger delete-btn" data-id="${row.id}">
                              <i class="fa fa-trash"></i>
                          </button>
                      </div>`;
              }
          }
      ]
  });

  // Edit Button Click
  $('#countryTable').on('click', '.edit-btn', function () {
      const country = $(this).data();
      Swal.fire({
          title: 'Edit Country',
          html: `
              <form id="editCountryForm">
                  <input type="hidden" name="id" value="${country.id}">
                  <div class="mb-3">
                      <label for="name" class="form-label">Name</label>
                      <input type="text" class="form-control" name="name" id="name" value="${country.name}" required>
                  </div>
                  <div class="mb-3">
                      <label for="iso" class="form-label">ISO</label>
                      <input type="text" class="form-control" name="iso" id="iso" value="${country.iso}" required>
                  </div>
                  <div class="mb-3">
                      <label for="nicename" class="form-label">Nicename</label>
                      <input type="text" class="form-control" name="nicename" id="nicename" value="${country.nicename}" required>
                  </div>
                  <div class="mb-3">
                      <label for="numcode" class="form-label">Numcode</label>
                      <input type="number" class="form-control" name="numcode" id="numcode" value="${country.numcode}" required>
                  </div>
                  <div class="mb-3">
                      <label for="phonecode" class="form-label">Phonecode</label>
                      <input type="number" class="form-control" name="phonecode" id="phonecode" value="${country.phonecode}" required>
                  </div>
                  <div class="mb-3">
                      <label for="phonecode" class="form-label">Capital</label>
                      <input type="text" class="form-control" name="capital" id="capital" value="${country.capital}" required>
                  </div>
              </form>
          `,
          showCancelButton: true,
          confirmButtonText: 'Save Changes',
          preConfirm: () => {
              const formData = $('#editCountryForm').serialize();
              return $.ajax({
                  url: `${base_url}details/update`, // Corrected URL
                  type: 'POST',
                  data: formData
              });
          }
      }).then((result) => {
          if (result.isConfirmed) {
              table.ajax.reload();
              Swal.fire('Updated!', 'Country updated successfully.', 'success');
          }
      });
  });

  // Delete Button Click
  $('#countryTable').on('click', '.delete-btn', function () {
      const countryId = $(this).data('id');
      Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
          if (result.isConfirmed) {
              $.ajax({
                  url: `${base_url}details/delete_country/${countryId}`, // Corrected URL
                  type: 'POST',
                  data: { _token: "{{ csrf_token() }}" },
                  success: function () {
                      table.ajax.reload();
                      Swal.fire('Deleted!', 'Country has been deleted.', 'success');
                  }
              });
          }
      });
  });
});