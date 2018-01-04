
                <div class="panel-body form-horizontal payment-form">
                    <div class="form-group">
                        <label for="concept" class="col-sm-3 control-label">???</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="program" name="program">
                        </div>
                    </div>
                   
                     <div class="form-group">
                        <label for="description" class="col-sm-3 control-label">??????</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="car_model" name="car_model">
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="description" class="col-sm-3 control-label">???????????</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="license_plate" name="license_plate">
                        </div>
                    </div> 
                    
                    <div class="form-group">
                        <label for="amount" class="col-sm-3 control-label">???????</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="price_unit" name="price_unit" onkeyup="cal_price();">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="amount" class="col-sm-3 control-label">?????</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="num_product" name="num_product" onkeyup="cal_price();">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status" class="col-sm-3 control-label">??????</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="discount" name="discount" onkeyup="cal_price();">
                                <option value="0">---</option>
                                <option value="10">10%</option>
                                <option value="20">20%</option>
                            </select>
                        </div>
                    </div> 
                   <div class="form-group">
                        <label for="amount" class="col-sm-3 control-label">?????????</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="total" name="total" disabled="disabled">
                        </div>
                    </div>
                    
                     <div class="form-group">
                        <label for="status" class="col-sm-3 control-label">??????</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="number" name="number">
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="status" class="col-sm-3 control-label">?????????</label>
                        <div class="col-sm-9">
                           <!--<input type="text" class="form-control" id="prison" name="prison">-->
                           <select class="form-control" id="prison" name="prison">
                                <option value="A">A</option>
                                <option value="B">B</option>
                            </select>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="date" class="col-sm-3 control-label">??????</label>
                        <div class="col-sm-9">
                            <!--<input type="date" class="form-control" id="date" name="date">-->
                            <input type="text" id="datetimepicker4" id="date" name="date" value="<? echo date('Y-m-d'); ?>" class="form-control">
                        </div>
                    </div>   
                    <div class="form-group">
                        <div class="col-sm-12 text-right">
                            <button type="button" class="btn btn-default preview-add-button">
                                <span class="glyphicon glyphicon-plus"></span> Add
                            </button>
                        </div>
                    </div>
                </div>