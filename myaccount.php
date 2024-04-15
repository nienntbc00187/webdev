<?php include "header.php"; ?>

<div class="container" style="padding-top: 160px;">

    <div class="row">

        <div class="row">

            <!-- User Information -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        User Information
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">FullName:</label>
                            <input type="text" class="form-control" id="name" value="John Doe" disabled>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Adress:</label>
                            <input type="email" class="form-control" id="email" value="john.doe@example.com" disabled>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone:</label>
                            <input type="tel" class="form-control" id="phone" value="+1234567890" disabled>
                        </div>
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <input type="text" class="form-control" id="address" value="123 Main St, City, Country" disabled>
                        </div>
                        <br>
                        <button id="editBtn" class="btn btn-primary">Change Password</button>
                        <button id="editBtn" class="btn btn-primary">Edit Informantion</button>
                    </div>
                </div>
            </div>

            <!-- Orders -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        Orders
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">ID Orders</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td class="text-center">ODR123456</td>
                                        <td class="text-center">$50.00</td>
                                        <td class="text-center"><button class="btn btn-primary view-btn" data-order-id="ODR123456"><i class="fas fa-eye"></i></button></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">2</td>
                                        <td class="text-center">ODR789012</td>
                                        <td class="text-center">$30.00</td>
                                        <td class="text-center"><button class="btn btn-primary view-btn" data-order-id="ODR789012"><i class="fas fa-eye"></i></button></td>
                                    </tr>
                                    <!-- More orders can be added here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

<script>
    document.getElementById('editBtn').addEventListener('click', function() {
        var inputs = document.querySelectorAll('.card-body input');
        inputs.forEach(function(input) {
            input.disabled = !input.disabled;
        });
        var btn = document.getElementById('editBtn');
        if (btn.innerText === 'Edit Informantion') {
            btn.innerText = 'Save Changes';
        } else {
            btn.innerText = 'Edit Informantion';
        }
    });
</script>


<?php include "footer.php"; ?>