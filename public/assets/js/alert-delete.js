$('.confirm-delete').click(function (e) {
    var form =  $(this).closest("form");
    var name = $(this).data("name");
    Swal.fire({
        title: `Are you sure want delete "${name}"?`,
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
    e.preventDefault();
});
