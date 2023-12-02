<?php

// Check if the file was submitted via a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Check if the file was uploaded without errors
  if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
    // Get the path to the uploaded file
    $file_path = $_FILES['file']['tmp_name'];

    // Open the file and read its contents
    $file_contents = file_get_contents($file_path);

    // Find all email addresses in the file using a regular expression
    preg_match_all('/\b[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Z|a-z]{2,}\b/', $file_contents, $matches);

    // Display the email addresses as an array
    echo json_encode($matches[0]);
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Email Extractor</title>
</head>
<body>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
    <label for="file">Select file:</label>
    <input type="file" id="file" name="file">
    <button type="submit">Submit</button>
  </form>
</body>
</html>
