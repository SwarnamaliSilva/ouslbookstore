<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report</title>
    <link rel="stylesheet" href="bootstrap-5.3.3/css/bootstrap.min.css">
    <style>
        .content-center {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 80vh;
            margin-top: 50px;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="storeAdminDashboard.php">OUSLBookStore Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="storeAdminDashboard.php">Display Books</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="addbook.php">Add Book</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="updatebook.php">Update Book</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="removebook.php">Remove Book</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="salesreport.php">Sales Report</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php" onclick="return confirm('Are you sure you want to log out?')">Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="content-center">
        <div class="tab-content w-50 mx-auto p-4 bg-white shadow rounded text-center">
            <h4>OUSL Book Store - Sales Report</h4>
            <hr/>
            <button class="btn btn-primary" onclick="generateReport()">Generate Sales Report</button>
            <div id="reportResult" class="mt-3"></div>
        </div>
    </div>

    <script src="bootstrap-5.3.3/js/bootstrap.bundle.min.js"></script>
    <script>
        function generateReport() {
            document.getElementById('reportResult').innerHTML = '<p>Sales Report: This is a sample report showing sales data.</p>';
        }
    </script>
</body>
</html>
