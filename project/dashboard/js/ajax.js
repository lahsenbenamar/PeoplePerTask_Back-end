//delete  data
function deleteRow(id,table) {
    if (confirm("are you sure")) {
        $.ajax({
            url: `http://localhost/test/project/dashboard/delete/deleteItemController.php`,
            method: "post",
            data: {
                id: id,
                table: table 
            },
            success: function(data) {
                location.reload();
                alert('Category Successfully deleted');
                $('form').trigger('reset');
            },
            error: function(xhr, status, error) {
                // Handle errors if needed
                console.error(error);
            }
        });
    }
}

// 
