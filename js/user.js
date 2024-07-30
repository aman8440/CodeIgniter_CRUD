$(document).ready(function () {
	$("#editIcon").on("click", function () {
		$("#userfile").click();
	});

	$(document).ready(function () {
		$("#userfile").on("change", function () {
			var formData = new FormData($("#uploadForm")[0]);
			$.ajax({
				url: baseUrl + "designController/profile_data",
				type: "POST",
				data: formData,
				contentType: false,
				processData: false,
				success: function (response) {
					location.reload();
				},
				error: function (xhr, status, error) {
					alert("An error occurred while uploading the file: " + error);
				},
			});
		});
	});

	$("#deleteIcon").on("click", function () {
		var id = $("#id").val();

		if (confirm("Are you sure you want to delete this image?")) {
			$.ajax({
				url: baseUrl + "designController/delete_image",
				type: "POST",
				data: { id: id },
				success: function (response) {
					location.reload();
				},
				error: function (xhr, status, error) {
					alert("An error occurred while deleting the image: " + error);
				},
			});
		}
	});
});
