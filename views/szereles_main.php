<form target="_blank" action="<?php echo SITE_ROOT;?>pdfgen" method="post" id="pdfdata">
<div class="container" >
    <div class="row">
        <div class="col-lg-3">
            <select id="varos" name="tel" class="form-select" aria-label="Default select example">
                <option selected>Loading Data...</option>
            </select>
        </div>
        <div class="col-lg-3">
            <select id="utca" name="ut" class="form-select" aria-label="Default select example" style="display: none">
                <option selected>Loading Data...</option>
            </select>
        </div>
        <div class="col-lg-3">
            <select id="javdatum" name="jav" class="form-select" aria-label="Default select example"style="display: none">
                <option selected>Loading Data...</option>
            </select>
        </div>
        <div class="col-lg-3">

            <button class="btn btn-primary" type="submit" id="submitPDF" name = "adat"><span class="fa fa-download">PDF</span></button>
        </div>
    </div>
</div>
</form>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-striped" id="dataTable">
                    <thead class="text-center">
                        <!--<th><span class="fa fa-download"></span></th>-->
                        <th>Beadási dátum</th>
                        <th>Javítási dátum</th>
                        <th>Település</th>
                        <th>Utca/Házszám</th>
                        <th>Szerelő neve</th>
                        <th>Munkaóra</th>
                        <th>Anyagár</th>
                    </thead>
                    <tbody id="response">
                         <tr>
                            <td colspan="7" class="text-center">
                                <div class="spinner-border text-info" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



