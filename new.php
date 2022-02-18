<?php
include_once "init.php";
use ProductModel\ProductModel;
$error = "";

if (!empty($_POST)) {
    $result = ProductModel::Add($_POST);
    echo $result;
}

?>

<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <script
            src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
            crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

	<style>
        body {
            margin: 10px;
        }
        form {
            width: 310px;
        }
        .entry:not(:first-of-type)
        {
            margin-top: 10px;
        }

        .glyphicon
        {
            font-size: 12px;
        }
	</style>

</head>
<body>
<div class="d-flex flex-column min-vh-100 justify-content-center align-items-center">
    <h1>Add new client</h1>
	<form method="post" name="new_product" action="new.php">
		<div class="mb-3">
			<label for="title" class="form-label">Title</label>
			<input type="text" required class="form-control" id="title" name="title" placeholder="Some Product">
		</div>
		<div class="mb-3">
			<label for="price" class="form-label">Price</label>
			<input type="number" step="0.01" required class="form-control" id="price" name="price" placeholder="$100.00">
		</div>
        <div class="mb-3">
            <label for="description" class="form-check-label">Description</label>
            <textarea class="form-control" required name="description" id="description" rows="3"></textarea>
        </div>
		<div class="mb-3">
			<label for="image_url" class="form-label">Product Image URL</label>
			<input type="url" class="form-control" id="image_url" name="image_url" value="">
		</div>
        <div class="mb-3">
            <label for="banner_url" class="form-label">Product Banner URL</label>
            <input type="url" class="form-control" id="banner_url" name="banner_url" value="">
        </div>

        <div class="mb-3">
            <label for="sale" class="form-label">Sale</label>
            <input class="form-check-input" type="checkbox" value="1" id="sale" name="sale">
        </div>
        <div class="mb-3">
            <label for="sale_price" class="form-label">Sale Price</label>
            <input type="number" step="0.01" class="form-control" id="sale_price" name="sale_price" placeholder="$150.00" value="0">
        </div>

        <div class="mb-3 attr_parent">
            <label for="attributes" class="form-label">Attributes:</label>
            <div class="entry input-group">
                <input class="form-control" name="attr_names[]" type="text" placeholder="Name" />&nbsp;=&nbsp;
                <input class="form-control" name="attr_values[]" type="text" placeholder="Value" />
                <span class="input-group-btn">
                    <button class="btn btn-success btn-add" id="add_attribute" type="button">Add</button>
                </span>
            </div>

            <script>
                $(document).ready(function() {
                    $(document).on('click', '#add_attribute.btn-add', function(e) {
                        e.preventDefault();

                        let currentEntry = $(this).parents('.entry:first');
                        let attr_form = $(this).parents('.attr_parent');
                        let newEntry = $(currentEntry.clone()).appendTo(attr_form);

                        newEntry.find('input').val('');
                        attr_form.find('.entry:not(:last) .btn-add')
                            .removeClass('btn-add').addClass('btn-remove')
                            .removeClass('btn-success').addClass('btn-danger')
                            .html('Remove');
                    }).on('click', '#add_attribute.btn-remove', function(e) {
                        $(this).parents('.entry:first').remove();

                        e.preventDefault();
                        return false;
                    });
                });
            </script>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
	</form>
</div>

</body>
</html>


