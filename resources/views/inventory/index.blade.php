<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inventory Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f5f6fa; }
        .sidebar {
            background: #181c22;
            color: #fff;
            min-height: 100vh;
            width: 240px;
            position: fixed;
            top: 0; left: 0;
            z-index: 100;
            transition: transform 0.3s ease;
        }
        .sidebar.hide {
            transform: translateX(-100%);
        }
        .sidebar .logo {
            font-weight: bold;
            font-size: 22px;
            letter-spacing: 2px;
            margin-bottom: 30px;
            margin-top: 30px;
        }
        .sidebar .nav-link {
            color: #fff;
            font-size: 17px;
            margin-bottom: 14px;
        }
        .sidebar .nav-link.active,
        .sidebar .nav-link:hover {
            background: #23272d;
            border-radius: 7px;
        }
        .main-content {
            margin-left: 240px;
            padding: 30px 30px 0 30px;
            transition: margin-left 0.3s ease;
        }
        .hamburger {
            display: none;
            font-size: 2rem;
            cursor: pointer;
            background: none;
            border: none;
        }
        .inventory-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .profile-section {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .profile-pic {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            object-fit: cover;
            background: #eee;
        }
        .search-box {
            max-width: 340px;
        }
        .table-wrapper {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 3px 24px rgba(0,0,0,0.03);
            padding: 20px;
            margin-top: 20px;
            overflow-x: auto;
        }
        .inventory-table th, .inventory-table td {
            vertical-align: middle;
            white-space: nowrap;
        }
        .status-active {
            background: #e6fff2;
            color: #34c759;
            font-weight: 600;
            padding: 6px 17px;
            border-radius: 12px;
        }
        .status-draft {
            background: #e8f1ff;
            color: #3398fa;
            font-weight: 600;
            padding: 6px 17px;
            border-radius: 12px;
        }
        .product-img {
            width: 42px;
            height: 42px;
            object-fit: contain;
            border-radius: 8px;
            margin-right: 13px;
        }
        .variant-row {
            background: #f7f8fa;
        }
        .variant-dot {
            display: inline-block;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            margin-right: 7px;
            vertical-align: middle;
        }
        .variant-dot.aqua { background: #18a2e8; }
        .variant-dot.blue { background: #0e43d6; }
        .variant-dot.black { background: #222; }
        .variant-dot.white { background: #f7f8fa; border: 1px solid #eee;}
        .variant-dot.green { background: #18e88d; }
        @media (max-width: 991px) {
            .main-content {
                margin-left: 0;
                padding: 18px 5px 0 5px;
            }
            .sidebar {
                width: 220px;
                position: fixed;
                left: 0;
                top: 0;
                height: 100vh;
                transform: translateX(-100%);
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .hamburger {
                display: inline-block;
                position: fixed;
                top: 18px;
                left: 18px;
                z-index: 200;
                color: #181c22;
                background: #fff;
                border-radius: 5px;
                padding: 2px 10px;
                border: 1px solid #eee;
            }
            .inventory-header {
                flex-direction: column;
                align-items: start;
                gap: 8px;
            }
            .table-wrapper {
                padding: 8px;
            }
        }
        @media (max-width: 600px) {
            .table-wrapper {
                padding: 2px;
            }
            .inventory-table th, .inventory-table td {
                font-size: 13px;
                padding: 5px 4px;
            }
        }
    </style>
</head>
<body>
    <!-- Hamburger button for mobile -->
    <button class="hamburger" id="hamburger-toggle">&#9776;</button>

    <div class="sidebar d-flex flex-column align-items-start px-4" id="sidebar-menu">
        <div class="logo mt-2 mb-4">ENCORE <span style="font-family: cursive;">Custom</span><br><span style="font-size:12px; font-weight:normal;">EST. NOW</span></div>
        <nav class="nav flex-column w-100">
            <a class="nav-link active" href="#">Dashboard</a>
            <a class="nav-link" href="#">Orders</a>
            <a class="nav-link" href="#">Inventory</a>
            <a class="nav-link" href="#">Payments</a>
            <a class="nav-link" href="#">Customers</a>
            <a class="nav-link" href="#">Reports</a>
            <a class="nav-link" href="#">Settings</a>
        </nav>
    </div>
    <div class="main-content">
        <div class="inventory-header">
            <h2 class="fw-bold">Inventory</h2>
            <div class="profile-section">
                <span class="me-2 text-muted"><i class="bi bi-bell"></i></span>
                <span class="badge bg-danger rounded-circle" style="position:relative; top:-10px; left:-20px;">12</span>
                <img src="{{ asset('images/profile.png') }}" class="profile-pic" alt="Profile" />
                <span class="fw-semibold">User Name</span>
            </div>
        </div>
        <div class="d-flex mt-3 gap-3 flex-wrap">
            <select class="form-select w-auto">
                <option>Number of Product | All</option>
            </select>
            <select class="form-select w-auto">
                <option>Total Product | All</option>
            </select>
            <div class="btn-group ms-3" role="group">
                <button class="btn btn-light">All</button>
                <button class="btn btn-light">Active</button>
                <button class="btn btn-light">Draft</button>
                <button class="btn btn-light">Achieved</button>
            </div>
            <div class="ms-auto">
                <button class="btn btn-light me-2">Export</button>
                <button class="btn btn-light">Import</button>
            </div>
        </div>
        <div class="table-wrapper mt-3">
            <table class="table inventory-table">
                <thead class="table-light">
                    <tr>
                        <th><input type="checkbox" /></th>
                        <th>Product</th>
                        <th>Status</th>
                        <th>Inventory</th>
                        <th>Sales channels</th>
                        <th>Markets</th>
                        <th>Category</th>
                        <th>Vendor</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td><input type="checkbox" /></td>
                            <td>
                                <img src="{{ asset('images/' . $product['image']) }}" class="product-img" alt="Product" />
                                {{ $product['name'] }}
                            </td>
                            <td>
                                @if($product['status'] === 'Active')
                                    <span class="status-active">Active</span>
                                @else
                                    <span class="status-draft">Draft</span>
                                @endif
                            </td>
                            <td>
                                {!! $product['inventory'] !!}
                                <br><span class="text-muted" style="font-size:12px;">Last Update - {{ $product['last_update'] }}</span>
                            </td>
                            <td>{{ $product['sales_channels'] }}</td>
                            <td>{{ $product['markets'] }}</td>
                            <td>{{ $product['category'] }}</td>
                            <td>{{ $product['vendor'] }}</td>
                            <td>
                                @if(!empty($product['variants']))
                                    <button type="button" class="btn btn-link p-0" data-bs-toggle="collapse" data-bs-target="#row-{{ $product['id'] }}" aria-expanded="false" aria-controls="row-{{ $product['id'] }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="gray" class="bi bi-eye" viewBox="0 0 16 16">
                                          <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zm-8 4a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                        </svg>
                                    </button>
                                @endif
                            </td>
                        </tr>
                        @if(!empty($product['variants']))
                        <tr>
                            <td colspan="9" style="padding:0; border:none;">
                                <div class="collapse variant-row" id="row-{{ $product['id'] }}">
                                    <b>Variants</b>
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th>Color</th>
                                                <th>Stock</th>
                                                <th>Discount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($product['variants'] as $variant)
                                            <tr>
                                                <td>
                                                    <span class="variant-dot {{ strtolower($variant['color']) }}"></span>
                                                    {{ $variant['color'] }}
                                                </td>
                                                <td>
                                                    {{ $variant['stock'] }} In Stock For
                                                    <br><span class="text-muted" style="font-size:12px;">Last Update - {{ $product['last_update'] }}</span>
                                                </td>
                                                <td>{{ $variant['discount'] }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-between align-items-center mt-2">
                <span>Showing 1 - 50 of 931 results</span>
                <nav>
                  <ul class="pagination pagination-sm mb-0">
                    <li class="page-item disabled"><a class="page-link" href="#">‹</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                    <li class="page-item"><a class="page-link" href="#">6</a></li>
                    <li class="page-item"><a class="page-link" href="#">7</a></li>
                    <li class="page-item"><a class="page-link" href="#">›</a></li>
                  </ul>
                </nav>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        var hamburger = document.getElementById('hamburger-toggle');
        var sidebar = document.getElementById('sidebar-menu');
        function toggleSidebar() {
            sidebar.classList.toggle('show');
        }
        hamburger.addEventListener('click', function() {
            toggleSidebar();
        });
        document.addEventListener('click', function(e) {
            if(window.innerWidth <= 991){
                if (!sidebar.contains(e.target) && !hamburger.contains(e.target)) {
                    sidebar.classList.remove('show');
                }
            }
        });
    });
    </script>
</body>
</html>