<x-app-layout>
    <!-- <div class="card h-100">
        <div class="card-header bg-light py-2">
            <div class="row flex-between-center">
                <div class="col-auto">
                    <h6 class="mb-0">Top Products</h6>
                </div>
                <div class="col-auto d-flex"><a class="btn btn-link btn-sm me-2" href="#!">View
                        Details</a>
                    <div class="dropdown font-sans-serif btn-reveal-trigger"><button
                            class="btn btn-link text-600 btn-sm dropdown-toggle dropdown-caret-none btn-reveal"
                            type="button" id="dropdown-top-products" data-bs-toggle="dropdown" data-boundary="viewport"
                            aria-haspopup="true" aria-expanded="false"><span
                                class="fas fa-ellipsis-h fs--2"></span></button>
                        <div class="dropdown-menu dropdown-menu-end border py-2"
                            aria-labelledby="dropdown-top-products"><a class="dropdown-item" href="#!">View</a><a
                                class="dropdown-item" href="#!">Export</a>
                            <div class="dropdown-divider"></div><a class="dropdown-item text-danger"
                                href="#!">Remove</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body h-100"> -->
    <div id="tableExample3" data-list='{"valueNames":["name","email","age"],"page":5,"pagination":true}'>
        <div class="row justify-content-end g-0">
            <div class="col-auto col-sm-5 mb-3">
                <form>
                    <div class="input-group"><input class="form-control form-control-sm shadow-none search"
                            type="search" placeholder="Search..." aria-label="search" />
                        <div class="input-group-text bg-transparent"><span class="fa fa-search fs--1 text-600"></span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="table-responsive scrollbar">
            <table class="table table-bordered table-striped fs--1 mb-0">
                <thead class="bg-200 text-900">
                    <tr>
                        <th class="sort" data-sort="name">نام</th>
                        <th class="sort" data-sort="Position">بست مربوطه</th>
                        <th class="sort" data-sort="Phone Number">شماره تلفن</th>
                    </tr>
                </thead>
                <tbody class="list">
                    @foreach ($employees as $employee) 

                        <tr>
                            <td class="name">{{$employee->name}}</td>
                            <td class="Position">{{ $employee->Position}}</td>
                            <td class="Phone Number">{{ $employee->phone_number }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-3"><button class="btn btn-sm btn-falcon-default me-1" type="button"
                title="Previous" data-list-pagination="prev"><span class="fas fa-chevron-left"></span></button>
            <ul class="pagination mb-0"></ul><button class="btn btn-sm btn-falcon-default ms-1" type="button"
                title="Next" data-list-pagination="next"><span class="fas fa-chevron-right"> </span></button>
        </div>
    </div>
</x-app-layout>