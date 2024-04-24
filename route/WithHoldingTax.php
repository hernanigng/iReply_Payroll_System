<?php include '../connection/session.php' ?>

<?php include '../template/header.php' ?>

<?php include '../template/sidebar.php' ?>
<style>
        #datatablesSimple th {

            background-color: #BED7DC;
        }
    </style>

<!-- Custom Script -->
<!-- jQuery -->





<script>
    // Function to show the modal for adding/editing positions
    function showModal() {

        $('#itemModal').modal('show');
    }

    // Function to dismiss the modal
    function closeModal() {
        $('#itemModal').modal('hide');
    }
</script>






<div id="layoutSidenav_content">

<main>
                    <div class="container-fluid px-4">
                        <h4 class="mt-4"><i class="fa-solid fa-list"></i> Witholding Tax Settings</h4>
  
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button class="btn btn-primary" type="button" onclick="showModal()">Add New</button>
                        </div>

                        <div class="card mb-4 mt-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Tax List
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Tax Title</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td>Tax 1</td>
                                            <td>
                                                <center>
                                                <button class="btn btn-warning">
                                                    <i class="fa-solid fa-eye" style="color: #ffffff;"></i>
                                                </button>
                                                <button class="btn btn-success">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </button>
                                                <button class="btn btn-danger">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                                </center>
                                            </td>
                                        </tr>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </main>


                <!-- Modal -->
                <div class="modal fade" id="itemModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        
                    <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add New Tax</h5>
                                <button type="button" class="close" aria-label="Close" onclick="closeModal()">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <form id="itemForm" novalidate>

                                <div class="modal-body">
                                <div class="container">
                                    <input type="hidden" id="">

                                    <div class="row">
                                        <div class="col-5 mb-3">
                                            <label for="taxTitle" class="form-label">Tax Title</label>
                                            <input type="text" class="form-control" id="taxTitle" placeholder="" required>
                                        </div>
                                    </div>

                                <div id="additionalRowsContainer">
                                <!-- Initial row -->
                                <div class="row">
                                    <div class="col-5">
                                        <label for="salaryRange" class="form-label">Salary Range</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="salaryRangeMin" placeholder="Min" required>
                                            <div class="input-group-text">-</div>
                                            <input type="text" class="form-control" id="salaryRangeMax" placeholder="Max" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-3 mb-3" style="margin-left:5%;">
                                        <label for="BasedValue" class="form-label">Based Value</label>
                                        <input type="text" class="form-control" id="BasedValue" placeholder="" required>
                                    </div>  

                                    <div class="col-3 mb-3">
                                        <label for="TaxPercentage" class="form-label">Tax Percentage</label>
                                        <input type="text" class="form-control" id="TaxPercentage" placeholder="" required>
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn btn-primary mt-3" onclick="addRow()">Add Range</button>

                            <script>
                            function addRow() {
                                var newRow = `
                                    <div class="row mt-3">
                                        <div class="col-5">
                                            <label for="salaryRange" class="form-label">Salary Range</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Min" required>
                                                <div class="input-group-text">-</div>
                                                <input type="text" class="form-control" placeholder="Max" required>
                                            </div>
                                        </div>
                                        
                                        <div class="col-3 mb-3" style="margin-left:5%;">
                                            <label for="BasedValue" class="form-label">Based Value</label>
                                            <input type="text" class="form-control" placeholder="" required>
                                        </div>  

                                        <div class="col-3 mb-3">
                                            <label for="TaxPercentage" class="form-label">Tax Percentage</label>
                                            <input type="text" class="form-control" placeholder="" required>
                                        </div>
                                    </div>
                                `;
                                document.getElementById('additionalRowsContainer').insertAdjacentHTML('beforeend', newRow);
                            }
                            </script>



                                </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary close" data-dismiss="modal" onclick="closeModal()">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>







                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; iReply Payroll System</div>
                        </div>
                    </div>
                </footer>



</div>
     


<?php include '../template/footer.php' ?>
