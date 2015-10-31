<div class="page">
    <section class="panel panel-default">
        <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> Supplier Form</strong></div>
        <div class="panel-body">
            <div class="vertical" data-ui-wizard-form>
                <h1>Supplier info</h1>
                <div>
                    <form method="post" class="form-horizontal" id="form_members" role="form">
                        <legend>Person</legend>
                        <div class="form-group">
                            <label for="firstname" class="col-sm-2">Supplier Code</label>
                            <div class="col-sm-4">
                                <input class="form-control" name="supplier_code" id="sup_code" placeholder="Supplier Code" required="" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="firstname" class="col-sm-2">First Name</label>
                            <div class="col-sm-4">
                                <input class="form-control" name="f_name" id="firstname" placeholder="First Name" required="" type="text">
                            </div>
                            <label for="lastname" class="col-sm-2">Last Name</label>
                            <div class="col-sm-4">
                                <input class="form-control" name="l_name" id="lastname" placeholder="Last Name" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nic-id" class="col-sm-2">NIC</label>
                            <div class="col-sm-4">
                                <input class="form-control" name="nic_no" id="nic" placeholder="NIC" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="gender" class="col-sm-2">Gender</label>
                            <div class="col-sm-4">
                                <label class="radio-inline">
                                    <input name="gender" id="male" value="male" type="radio"> Male
                                </label>
                                <label class="radio-inline">
                                    <input name="gender" id="female" value="female" type="radio"> Female
                                </label>
                            </div>
                            <label for="dob" class="col-sm-2">Date of Birth</label>
                            <div class="col-sm-4">
                                <input class="form-control" name="birth_day" id="dob" placeholder="mm/dd/yyyy" required="" type="date">
                            </div>
                        </div>
                    </form>
                </div>

                <h1>Contact Info</h1>
                <div>
                    <form method="post" class="form-horizontal" id="form_members" role="form">
                        <legend>Address</legend>
                        <div class="form-group">
                            <label for="address" class="col-sm-2">Address 1</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="address_1" id="address" placeholder="Enter Address" required="" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="city" class="col-sm-2">Address 2</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="address_2" id="address" placeholder="Address 2" type="text">
                            </div>
                        </div>
                        <legend>Contact Info</legend>
                        <div class="form-group">
                            <label for="phone" class="col-sm-2">Phone</label>
                            <div class="col-sm-4">
                                <input class="form-control" name="phone_no" id="phone" placeholder="Phone Number" required="" type="tel">
                            </div>
                            <label for="phone" class="col-sm-2">Mobile</label>
                            <div class="col-sm-4">
                                <input class="form-control" name="mobile_no" id="phone" placeholder="Phone Nmber" type="tel">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-2">Email</label>
                            <div class="col-sm-4">
                                <input type="email" class="form-control" name="e_mail" id="email" placeholder="Email">
                            </div>
                        </div>
                    </form>
                </div>

                <h1>Estate Info</h1>
                <div>
                    <legend>Estate Info</legend>
                    <form method="post" class="form-horizontal" id="form_members" role="form">
                        <div class="form-group">
                            <label for="address" class="col-sm-2">Estate Name</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="estate_name" id="text" placeholder="Estate Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Address" class="col-sm-2">Address of the Estate</label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control" name="address_of_estate" id="text" placeholder="Address of the Estate">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reg" class="col-sm-2">Size of the Estate</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="size_of_estate" id="text" placeholder="Size of the Estate">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reg" class="col-sm-2">Reg No</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="reg_no" id="text" placeholder="Estate Registation Number" required>
                            </div>
                        </div>
                    </form>
                </div>
                <h1>Bank Info & Alert</h1>
                <div>
                    <form method="post" class="form-horizontal" id="form_members" role="form">
                        <legend>Bank Account info</legend>
                            <div class="form-group">
                              <label for="Bank" class="col-sm-2">Account name</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="account_name" id="text" placeholder="Account Name">
                                </div>
                                <label for="Bank" class="col-sm-2">Account No</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="bank" id="bank" placeholder="Acc number">
                                </div>
                            </div>
                            <div class="form-group">
                              <label for="Bank" class="col-sm-2">Bank name</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="bank" id="text" placeholder="Bank Name">
                                </div>
                                <label for="Bank" class="col-sm-2">Branch</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="branch" id="bank" placeholder="Branch">
                                </div>
                            </div>
                            <legend>Alert</legend>
                                    <div class="from-group">
                                      <div class="checkbox">
                                        <label for="alert" class="col-sm-2">Send SMS</label>
                                        <div class="col-sm-8">
                                          <input type="checkbox" name="sms_send" value="1" checked>
                                        </div>
                                      </div>
                                      <div class="checkbox">
                                        <label for="alert" class="col-sm-2">Send Email</label>
                                        <div class="col-sm-8">
                                          <input type="checkbox" name="e_mail_send" value="1" checked>
                                        </div>
                                      </div>
                                    </div>
                    </form>
                </div>
            </div>

        </div>
    </section>
</div>