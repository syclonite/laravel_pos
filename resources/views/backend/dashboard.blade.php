@extends('backend.layout')

@section('content')

    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
            <meta name="description" content="" />
            <meta name="author" content="" />
            <title>Nowshad Enterprise</title>
            <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
            <link href="css/styles.css" rel="stylesheet" />
            <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        </head>

        <body>
           <div id="layoutSidenav_content">
           <main>
                <div class="container-fluid px-1">
                    <h1 class="mt-4">Messrs Nowshad Enterprise</h1>
                    <ol class="breadcrumb mb-5">
                    <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>

                <div class="row">
                            <div class="col-xl-4 col-md-6">
                               <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Monthly Profit</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6">
                               <div class="card bg-secondary text-white mb-4">
                                    <div class="card-body">Today's Due</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6">
                               <div class="card bg-info text-black mb-4">
                                    <div class="card-body">Total Payable</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-black stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>


                </div>

                <div class="row">
                <div class="col-xl-4 col-md-6">
                               <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Total Purchase Cost</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6">
                               <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Total Sold</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6">
                               <div class="card bg-warning text-black mb-4">
                                    <div class="card-body">Net Profit</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-black stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                    
                </div>

                <div class="row">
                <div class="col-xl-4 col-md-6">
                               <div class="card text-white mb-4" style="background-color:Tomato;" >
                                    <div class="card-body">Total Product</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6">
                               <div class="card text-black mb-4" style="background-color:LightGray;" >
                                    <div class="card-body">Total Receivable</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-black stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6">
                               <div class="card bg-dark text-white mb-4">
                                    <div class="card-body">Total Supplier</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                    
                </div>


            
            </main>
           </div>
            <footer class="py-5 bg-white mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Messrs Nowshad Enterprise 2023</div>
                            <div>
                                <a href="#">Developed By Tumaas Technologies</a>
                            </div>
                        </div>
                    </div>
            </footer>

        </body>

    </html>
@endsection