@include('partials.auth.header')

<section class="container-fluid">

    <div class="row">
        <div class="col-md-12 div-result ">
            <table id="my-jobs" class="table table-bordered table-hover zero-configuration">
                <thead>
                    <tr>
                        <th>Site</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Site 1</td>
                        <td>Description 1</td>
                        <td>
                            <i class="fas fa-eye text-warning cursor-pointer"></i>
                            <i class="fas fa-edit text-primary cursor-pointer"></i>
                            <i class="fas fa-trash text-danger cursor-pointer"></i>
                        </td>
                    </tr>
                    <tr>
                        <td>Site 2</td>
                        <td>Description 2</td>
                        <td>
                            <i class="fas fa-eye text-warning cursor-pointer"></i>
                            <i class="fas fa-edit text-primary cursor-pointer"></i>
                            <i class="fas fa-trash text-danger cursor-pointer"></i>
                        </td>
                    </tr>
                    <tr>
                        <td>Site 3</td>
                        <td>Description 3</td>
                        <td>
                            <i class="fas fa-eye text-warning cursor-pointer"></i>
                            <i class="fas fa-edit text-primary cursor-pointer"></i>
                            <i class="fas fa-trash text-danger cursor-pointer"></i>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>


@include('partials.auth.footer')
