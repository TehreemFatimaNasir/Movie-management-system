<?php
session_start();  // Start the session

// Include header and footer files
include 'header.php';  
   

// Database connection
$con = mysqli_connect('localhost', 'root', '', 'dbmovies');
if (!$con) {
    die('Cannot establish DB connection');
}

// Define the ClassManager class
class ClassManager {
    private $conn;

    // Constructor to initialize database connection
    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    // Add a new class
    public function addClass($className) {
        $query = "INSERT INTO classes (classname) VALUES (?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $className);
        return $stmt->execute();
    }

    // Get all classes
    public function getAllClasses() {
        $query = "SELECT * FROM classes";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Update a class
    public function updateClass($classId, $className) {
        $query = "UPDATE classes SET classname = ? WHERE classid = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $className, $classId);
        return $stmt->execute();
    }

    // Delete a class
    public function deleteClass($classId) {
        $query = "DELETE FROM classes WHERE classid = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $classId);
        return $stmt->execute();
    }
}

// Initialize the ClassManager with the established connection
$classManager = new ClassManager($con);

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['addClass'])) {
        $className = $_POST['classname'];
        $classManager->addClass($className);
    }
    if (isset($_POST['updateClass'])) {
        $classId = $_POST['classid'];
        $className = $_POST['classname'];
        $classManager->updateClass($classId, $className);
    }
}

// Handle delete request
if (isset($_GET['delete'])) {
    $classId = $_GET['delete'];
    $classManager->deleteClass($classId);
}

// Fetch all classes
$classes = $classManager->getAllClasses();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Baskervville+SC&family=DM+Serif+Text:ital@0;1&family=Nerko+One&display=swap" rel="stylesheet">
    <title>Manage Seat Categories</title>
    <style>
    body {
        font-family: "Baskervville SC", system-ui;
        background-color: #000 !important; 
        color: #fff !important;
        margin: 0;
        padding: 0;
    }

    h2 {
        font-family: "Baskervville SC", system-ui;
        color:rgb(255, 255, 255); /* Maroon color for the heading */
        text-align: center;
    }
    h3{
        font-family: "Baskervville SC", system-ui;
        color:rgb(255, 255, 255); /* Maroon color for the heading */
        text-align: center;
    }

    form {
        display: flex;
        justify-content: center;
        margin: 20px 0;
    }

    input[type="text"] {
        padding: 10px;
        margin-right: 10px;
        border: 1px solid #800000; /* Maroon border */
        border-radius: 5px;
        background-color: white; /* White input box */
        color: black; /* Black text inside input */
        font-family: "Baskervville SC", system-ui;
    }

    button {
        padding: 10px 20px;
        background-color: rgb(104, 17, 17);
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-family: "Baskervville SC", system-ui;
    }

    button:hover {
        background-color: #a30000; /* Lighter maroon on hover */
    }

    table {
        width: 80%;
        margin: 0 auto;
        border-collapse: collapse;
        margin-top: 20px;
        font-family: "Baskervville SC", system-ui;
        background-color: #000 !important; 
        color: #fff !important;
    }

    table, th, td {
        border: 1px solid #800000; /* Maroon border for table */
    }

     td {
        padding: 10px;
        text-align: center;
        font-family: "Baskervville SC", system-ui;
        background-color: #000 !important; 
        color: #fff !important;
        font-size: 1.0rem;
    }

    th {
        padding: 10px;
        text-align: center;
        background-color: #800000;
        color: white;
    }

    tr:nth-child(even) {
        background-color: #333;
    }

    a {
        color:rgb(255, 255, 255) !important;
        text-decoration: none;
        padding: 5px;
    }

    a:hover {
        color: #a30000; /* Lighter maroon on hover */
    }
</style>

</head>
<body>
<br><br>
<br><br>
<h2>Manage Seat Categories</h2>
<form method="POST">
    <input type="text" name="classname" placeholder="Enter Class Name (e.g., Gold)" required>
    <button type="submit" name="addClass">Add Class</button>
</form>

<h3>All Seat Categories</h3>
<table>
    <tr>
        <th>ID</th>
        <th>Class Name</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($classes as $class): ?>
    <tr>
        <td><?= $class['classid'] ?></td>
        <td><?= $class['classname'] ?></td>
        <td>
            <!-- Update form -->
            <form method="POST" style="display:inline;">
                <input type="hidden" name="classid" value="<?= $class['classid'] ?>">
                <input type="text" name="classname" value="<?= $class['classname'] ?>" required>
                <button type="submit" name="updateClass">Update</button>
            </form>
            <!-- Delete link -->
            <a href="?delete=<?= $class['classid'] ?>" onclick="return confirm('Are you sure you want to delete this class?')">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php include 'footer.php'; ?>
</body>
</html>